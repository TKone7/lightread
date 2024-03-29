<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:47
 */

namespace services;


use dao\ContentKeywordDAO;
use dao\KeywordDAO;
use domain\Content;
use domain\ContentKeyword;
use domain\Keyword;

class KeywordServiceImpl implements KeywordService
{
    private static $instance = NULL;

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getAll()
    {
        return (new KeywordDAO())->readAll();
    }

    public function getKeywordByID($id)
    {
        return (new KeywordDAO())->read($id);
    }

    public function getKeywordByName($name)
    {
        return (new KeywordDAO())->readByName($name);
    }

    public function getKeywords(Content $content){
        return (new KeywordDAO())->readAllofContent($content);
    }

    public function syncKeywords($tags){

        //get keyw_ids (create if not exists)
        $kdao = new KeywordDAO();
        $keywords = null;
        if (is_array($tags) || is_object($tags)){
            foreach ($tags as $tag) {
                $t = trim($tag);
                if(strlen($t) > 0){
                    $k = $kdao->readByName($tag);
                    if(empty($k)){
                        //keyword does not yet exist
                        $keyword = new Keyword();
                        $keyword->setName($tag);
                        $k = $kdao->create($keyword);;
                    }
                    $keywords[] = $k;
                }
            }
        }


        return $keywords;
    }


    public function associate(Content $content, $keywords){

        $cokeDAO = new ContentKeywordDAO();

        //clear existing associations
        $cokeDAO->deleteAll($content);

        //create new associations
        if (is_array($keywords) || is_object($keywords)){
            foreach ($keywords as $keyword){
                $coke = new ContentKeyword();
                $coke->setContID($content->getId());
                $coke->setKeywID($keyword->getId());
                $cokeDAO->create($coke);
            }
        }

    }

    public function getSeparated(Content $content, $separation){
        //returns a String in form of "xxx, xxx"
        $keywords = (new KeywordDAO())->readAllofContent($content);
        $cReturn = "";
        foreach ($keywords as $keyword){
            $cReturn .= $keyword->getName() . $separation ;
        }
        $cReturn = substr($cReturn,0, - strlen($separation));
        return $cReturn;
    }

    public function getValues(Content $content){
        //returns a String in form of "xxx, xxx"
        $keywords = (new KeywordDAO())->readAllofContent($content);
        $cReturn = "";
        foreach ($keywords as $keyword){
            $cReturn .= $keyword->getName() .", " ;
        }
        $cReturn = substr($cReturn,0,-2);
        return $cReturn;
    }

    public function getSuggestions(){
        //returns a String in form of "['xxx', 'xxx', 'xxx']"
        $keywords = (new KeywordDAO())->readAll();
        $cReturn = "[ ";
        foreach ($keywords as $keyword){
            $cReturn .=  "'" . $keyword->getName() . "', " ;
        }
        $cReturn = substr($cReturn,0,-2) . " ]";
        return $cReturn;
    }
}