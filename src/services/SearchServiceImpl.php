<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:47
 */

namespace services;


use domain\Content;
use searcheng\PorterStemmer; //do not remove (used in Lambda expression)
use TeamTNT\TNTSearch\TNTSearch;
use config\Config;


class SearchServiceImpl implements SearchService
{


    private static $instance = NULL;
    private static $indexlocation = 'searcheng/tntsearch/indexes';
    private static $indexname = 'content.index';

    public $fuzzy_prefix_length   =  2;
    public $fuzzy_max_expansions  = 50;
    public $fuzzy_distance        =  2;  //represents the Levenshtein distance;



    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getFindings(String $searchterms, array $cont_list){
        /*returns an array of Content objects in descending relevancy order*/

        $searchterms = $this->removeStopwords($searchterms);
        $Q = explode(' ', $searchterms);
        $keywsvc = KeywordServiceImpl::getInstance();
        foreach ($cont_list as $c){
            $doc = $c->getTitle() . " " . $c->getSubtitle() . " " . $keywsvc->getValues($c) . " " .
                   $c->getAuthor()->getFullName()  . " " . $c->getCategory()->getKey() ; // . " " . $c->getBody();
            $doc = $this->removeStopwords($doc);
            $doc_list[] = $doc;
        }



        $result = $this->BM25($Q, $doc_list);
        $return_list = [];
        foreach($result as $key => $val){
            if($val>0.0){
                $return_list[] = $cont_list[$key];
            }
        }

        return $return_list;

    }


    public function getFindingsTNT(String $searchterms, array $cont_list){
        /*returns an array of Content objects in descending relevancy order*/

        if(self::initRequired()){
            $this->initIndex();
        }

        $tnt = new TNTSearch;

        $tnt->loadConfig($this->getTNTConfig());
        $tnt->selectIndex(self::$indexname);
        $tnt->fuzziness = true;

        $res = $tnt->search($searchterms);
        $foundIDs = $res[ids];
        $candidateIDs = array_map(function($c){return $c->getId();}, $cont_list);

        $return_list = [];
        foreach($foundIDs as $id){
            if(in_array($id, $candidateIDs)){
                $key = array_keys($candidateIDs, $id)[0];
                $return_list[] = $cont_list[$key];
            }
        }

        return $return_list;

    }


    private function getTNTConfig(){



        // create new directory with 744 permissions if it does not exist yet
        // owner will be the user/group the PHP script is run under
        if ( !file_exists(self::$indexlocation) ) {
            mkdir (self::$indexlocation, 0744,true);
        }

        $config = [     'driver'    => 'pgsql',
                        'host'      => Config::get("database.host"),
                        'port'      => Config::get("database.port"),
                        'database'  => Config::get("database.name"),
                        'username'  => Config::get("database.user"),
                        'password'  => Config::get("database.password"),
                        'storage'   => self::$indexlocation                    ];

        return $config;
    }


    private function initIndex(){

        $tnt = new TNTSearch;

        $tnt->loadConfig($this->getTNTConfig());

        $indexer = $tnt->createIndex(self::$indexname);

        $sql = 'SELECT cont.fld_cont_id as id, REPEAT(CONCAT(cont.fld_cont_title, \' \'), 5) as title,  REPEAT(CONCAT(cont.fld_cont_subtitle, \' \'), 3) as subtitle, cate.fld_cate_key as category, keyw.keyw_name as keywords, cont.fld_cont_body as body
                FROM tbl_content cont
                LEFT JOIN (SELECT coke.fld_cont_id, string_agg(keyw.fld_keyw_name, \' ; \'  ORDER BY keyw.fld_keyw_name) as keyw_name
                           FROM tbl_keyword keyw INNER JOIN tbl_contentkeyword coke on keyw.fld_keyw_id = coke.fld_keyw_id
                           GROUP BY coke.fld_cont_id) keyw on keyw.fld_cont_id = cont.fld_cont_id
                LEFT JOIN tbl_category cate on cont.fld_cate_id = cate.fld_cate_id;'   ;

        $indexer->query($sql);
        //$indexer->setPrimaryKey('fld_cont_id'); /*not needed if PK is named «id»*/
        //$indexer->setLanguage('english'); // default is PorterStemmer
        $indexer->run();
    }


    public function insertInIndex(Content $c){

        $tnt = new TNTSearch;

        $tnt->loadConfig($this->getTNTConfig());
        $tnt->selectIndex(self::$indexname);

        $index = $tnt->getIndex();

        //to insert a new document to the index
        $index->insert([    'id' => $c->getId(),
                            'title'       => $c->getTitle(),
                            'subtitle'    => $c->getSubtitle(),
                            'body'        => $c->getBody(),
                            'category'    => $c->getCategory()->getKey(),
                            'keywords'    =>  KeywordServiceImpl::getInstance()->getSeparated($c," ; ")    ]);

    }

    public function updateInIndex(Content $c){
        $tnt = new TNTSearch;

        $tnt->loadConfig($this->getTNTConfig());
        $tnt->selectIndex(self::$indexname);

        $index = $tnt->getIndex();

        //to update an existing document
        $keyws = KeywordServiceImpl::getInstance()->getSeparated($c," ; ");
        $index->update($c->getId(), [   'id' => $c->getId(),
                                        'title'       => $c->getTitle(),
                                        'subtitle'    => $c->getSubtitle(),
                                        'body'        => $c->getBody(),
                                        'category'    => $c->getCategory()->getKey(),
                                        'keywords'    =>  KeywordServiceImpl::getInstance()->getSeparated($c," ; ")    ]);

    }


    public function deleteInIndex(Content $c){
        $tnt = new TNTSearch;

        $tnt->loadConfig($this->getTNTConfig());
        $tnt->selectIndex(self::$indexname);

        $index = $tnt->getIndex();

        $index->delete($c->getId());

    }

    private static function initRequired(){
        $return = false;
        $file = self::$indexlocation . '/' . self::$indexname;
        if ( !file_exists($file) ) {
            $return = true;
        } else {
            if(time()- filemtime($file) > 43200){  //43200 seconds = 12h
               $return = true;
            }
        }
        return $return;
    }




    // taken from https://github.com/KonstantinosMetallinos/BM25-for-PHP/blob/master/Okapi-BM25.php
    // optimized by RB

    private function IDF($N, $nq_i){
        /*
       $N 	 	Number of documents in our collection.
       $nq_i 	Number of documents that contain query q_i.
       Returns the Inverse Document Frequency (IDF) for given query.
        */
        return log(($N + 0.5 - $nq_i/(0.5 + $nq_i)));
    }

    private function BM25($Q, $docCollection, $k=1.2, $b=0.75, $paramaterCheck=TRUE, $warningCheck=TRUE){
        /*
        $Q 							A set of queries Q = array(q1, q2, ..., qn).
        $docCollection				Collection of all documents we wish to score; docCollection = array("String of doc1", "String of doc2", ...)
        $k 							Tuning paramerter. Recommended values between 1.2 and 2.
        $b   						Tuning parameeter. Recommended value 0.75. For b=1 we get BM11 and b=0 we get BM15.
        $paramaterCheck 			Check if user input correctly given.
        $warningCheck 				Allow warning pop-ups when running the code.
        $N 							Number of Documents in our collection.
        $NumOfQueries 				Number of terms our Query "Q" has.
        $queryFrequencyPerDocument	Frequency at which query term q_i appears in our document collection.
        $scoredDocuments 			The array which the scores of each Document D will be stored.
        $wordsindoc					Number of words (tokens) contained in each document.
        $documentCount				Number of documents our document collection contains.
        $avgld						Average Document Length.
        $nq_i	 					Number of times token q_i appears in our collection of documents.
        $individualScore			The score of the current document D.
        $q_i 						Term "i" from our Query Q.
        $score 						Array containing the score for each document.
        $spamflag 					Used to warn the user if an empty query token has been provided (e.g. space has been given as a token).
        Returns a sorted array of the BM25 score of each document.
        */
        if($paramaterCheck=TRUE){
            if(!is_array($Q)){
                die('Error: Parameter $Q is expected to be an array. Non-array element given.');
            }
            if(!is_array($docCollection)){
                die('Error: Parameter $docCollection is expected to be an array. Non-array element given.');
            }
        }
        $Q = array_map('strtolower', $Q);
        $Q = array_map('searcheng\PorterStemmer::Stem', $Q);
        $docCollection = array_map('strtolower', $docCollection);
//        $docCollection = array_map('searcheng\PorterStemmer::Stem', $docCollection);
        $N = count($docCollection);
        $NumOfQueries = count($Q);
        $queryFrequencyPerDocument = array();
        $scoredDocuments = array();
        $wordsindoc = array();
        // Boolean variable to stop program spamming a warning message.
        $spamflag = FALSE;
        // Initialse array.
        $nq_i = array_fill(0, $NumOfQueries, 0);
        for($documentCount=0; $documentCount < $N; $documentCount++) {
            // Tokenise the document
            $TokeniseddocCollection[$documentCount] = explode(" ", str_replace(array('.', ',', "\t", '!', '\"', '£', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '{', '}', '[', ']', ';', ':', '@', '~', '<', '>', '?', '/', '\\', '\`', '¬', "\n","\r"), ' ', $docCollection[$documentCount]));
            $TokeniseddocCollection[$documentCount] = array_map('searcheng\PorterStemmer::Stem', $TokeniseddocCollection[$documentCount]);
            // Find the number of tokens (words) that exist in the document. This will also give us the average length of documents.
            $wordsindoc[$documentCount] = count($TokeniseddocCollection[$documentCount]);
            // Create a matrix where the rows are the documents and the columns are the query terms. The value of elements (i,j) represents the number of times document i contains query j.
            for($queryCount=0; $queryCount < $NumOfQueries; $queryCount++){
                $tokenisedQuery = explode(" ", $Q[$queryCount]);
                if(count($tokenisedQuery) == 1 && $tokenisedQuery[0] != ""){ // If query term has 1 token.
                    if(in_array($Q[$queryCount], $TokeniseddocCollection[$documentCount]) !== FALSE){
                        $queryFrequencyPerDocument[$documentCount][$queryCount] = array_count_values($TokeniseddocCollection[$documentCount])[$Q[$queryCount]];
                        $nq_i[$queryCount] ++;
                    }else{
                        $queryFrequencyPerDocument[$documentCount][$queryCount] = 0;
                    }
                }elseif(count($tokenisedQuery) >= 2){ // If query term has >= 2 tokens.

                    if(strpos($docCollection[$documentCount], $Q[$queryCount]) !== FALSE){
                        $queryFrequencyPerDocument[$documentCount][$queryCount] = 0;
                        $nq_i[$queryCount] ++;
                        $lastPos = 0;
                        while (($lastPos = strpos($docCollection[$documentCount], $Q[$queryCount], $lastPos))!== false) {
                            $queryFrequencyPerDocument[$documentCount][$queryCount] ++;
                            $lastPos = $lastPos + strlen($Q[$queryCount]);
                        }
                    }else{
                        $queryFrequencyPerDocument[$documentCount][$queryCount] = 0;
                    }
                }elseif($spamflag == FALSE && $warningCheck == TRUE){ // If query token is empty give a warning. User might have mistyped something. Otherwise remove to save computation time.
//                    echo "WARNING: Empty query token detected! Check for mis-types or remove term to speed up the process.</br></br>";
                    $spamflag = TRUE;
                }
            }
        }
        for($queryCount=0; $queryCount < $NumOfQueries; $queryCount++){
            if($nq_i[$queryCount] == 0 && $warningCheck == TRUE){
//                echo "WARNING: Query token " . ($queryCount+1) . " found no documents containign it. Check for potential spelling mistakes or typos.</br></br>";
            }
        }
        // Compute the average length of our document collection.
        $avgld = array_sum($wordsindoc) / count($wordsindoc);
        // Compute the BM25 score.
        for($documentCount=0; $documentCount < $N; $documentCount++) {
            $individualScore = 0;
            for($queryCount=0; $queryCount < $NumOfQueries; $queryCount++){
                // If the token is not empty proceed with the computations. If it is empty, essentially you are adding a constant "0" to all documents, skip to save computation time.
                if($Q[$queryCount] != ""){
                    $individualScore += $this->IDF($N, $nq_i[$queryCount]) * $queryFrequencyPerDocument[$documentCount][$queryCount] * ($k + 1) / ($queryFrequencyPerDocument[$documentCount][$queryCount] + $k*(1-$b + $b*$wordsindoc[$documentCount]/$avgld));
                }
            }
            // Store current documents score.
            $score[$documentCount] = $individualScore;
        }
        // Return the scores in a descending order while maintaining their key values so user can distinuish between them.
        arsort($score);
        return ($score);
    }


    private function removeStopwords(String $string){
        $words = preg_split('/[^-\w\']+/', $string, -1, PREG_SPLIT_NO_EMPTY);
        $stopwords = array("a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all", "almost", "alone", "along", "already", "also","although","always","am","among", "amongst", "amoungst", "amount",  "an", "and", "another", "any","anyhow","anyone","anything","anyway", "anywhere", "are", "around", "as",  "at", "back","be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could", "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven","else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely", "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own","part", "per", "perhaps", "please", "put", "rather", "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thick", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the");
        $return = array_udiff($words, $stopwords, 'strcasecmp');
        return implode(' ', $return);

    }






}