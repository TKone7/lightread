<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:47
 */

namespace services;


use domain\Content;
use searcheng\PorterStemmer;

class SearchServiceImpl implements SearchService
{
    private static $instance = NULL;

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getFindings(String $searchterms, array $cont_list)
    { //returns an array of Content objects in descending relevancy order
        $Q = explode(' ', $searchterms);
//        $Q = array("Lorem Ipsum", "World");
        foreach ($cont_list as $c){
            $doc_list[] = $c->getId() . " " . $c->getTitle() . " " . $c->getSubtitle();
        }

        $result = $this->BM25($Q, $doc_list);

        $contsvc = ContentServiceImpl::getInstance();
        $index = 0;
        foreach($result as $key => $val){
            if($val>0.0){
                $return_list[] = $cont_list[$key];
            }
//            $doc = $r[1];
//            $id = substr($doc, 0, strpos($doc, '|'));
//            $return_list[] = $contsvc->readContent($id);
        }

        return $return_list;

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
                    echo "WARNING: Empty query token detected! Check for mis-types or remove term to speed up the process.</br></br>";
                    $spamflag = TRUE;
                }
            }
        }
        for($queryCount=0; $queryCount < $NumOfQueries; $queryCount++){
            if($nq_i[$queryCount] == 0 && $warningCheck == TRUE){
                echo "WARNING: Query token " . ($queryCount+1) . " found no documents containign it. Check for potential spelling mistakes or typos.</br></br>";
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









}