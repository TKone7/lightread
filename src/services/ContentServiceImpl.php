<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 08:57
 */

namespace services;


use dao\ContentDAO;
use dao\PaymentDAO;
use domain\Content;
use domain\ContentManager;
use domain\Purpose;
use http\HTTPException;
use http\HTTPStatusCode;

class ContentServiceImpl implements ContentService
{
    private static $instance = NULL;

    protected function __construct()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param Content $content
     * @return Content|null
     * @throws HTTPException
     */
    public function createContent(Content $content)
    {
        $auth = AuthServiceImpl::getInstance();
        if($auth->verifyAuth()){
            $contentdao = new ContentDAO();
            $content->setAuthor($auth->readUser());
            $content->setSlug($this->calcSlug($content));
            $return = $contentdao->create($content);
            KeywordServiceImpl::getInstance()->associate($return, $content->getKeywords());
            return $return;
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);
    }

    public function updateContent(Content $content)
    {
        $auth = AuthServiceImpl::getInstance();
        if(AuthServiceImpl::getInstance()->verifyAuth()){
            $contentdao = new ContentDAO();
            $return = $contentdao->update($content);
            KeywordServiceImpl::getInstance()->associate($return, $content->getKeywords());
            return $return;
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);
    }
    public function editContent($content_id) : Content
    {
        $auth = AuthServiceImpl::getInstance();
        $contdao = new ContentDAO();
        $content = $contdao->read($content_id);
        if($auth->verifyAuth()     AND  $content->getAuthor()->getId()==$auth->getCurrentUserId()){
            return $content;
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);
    }
    public function readContent($content_id) : Content
    {
        $contdao = new ContentDAO();
        $content = $contdao->read($content_id);
        return $content;
    }

    /**
     * @param $slug
     * @return Content|null
     */
    public function readBySlug($slug) //: Content /*can also be Null*/
    {
        $contdao = new ContentDAO();
        $content = $contdao->findBySlug($slug);
        return $content;
    }
    public function getTurnover(Content $content, Purpose $purpose = NULL){
        $paym_dao = new PaymentDAO();
        return $paym_dao->selectContentTurnover($content,$purpose);
    }

    public function getContentMgr($verified_only = false, array $keyword = NULL, array $category = NULL, array $author = NULL): ContentManager
    {
        $authorslist = NULL;
        $categorylist=NULL;
        $keywordlist=NULL;
        $contentdao = new ContentDAO();
        if(!is_null($author)){

            foreach ($author as $a){
                $authorslist .= $a->getId().",";
            }
        }
        if(!is_null($category)){

            foreach ($category as $c){
                $categorylist .= $c->getId().",";
            }
        }
        if(!is_null($keyword)){

            foreach ($keyword as $k){
                $keywordlist .= $k->getId().",";
            }
        }
        $contents = $contentdao->filter($verified_only,$keywordlist,$categorylist,$authorslist);
        $cm = new ContentManager($contents);
        return $cm;
    }


    public function trimHTML($html, $length){
        $len = strlen($html);
        $restr = $length;

        $intag=false;
        $closingtag=false;
        $currenttag = "";
        $stack = [];
        for($i = 0; $i < $len; $i++){
            if (!$intag AND $html[$i] == "<"){
                $closingtag=false;
                $intag=true;
                $currenttag.=$html[$i];
            }elseif($html[$i] == ">" AND $intag) {
                $intag=false;
                if($closingtag){
                    array_pop($stack);
                }else{
                    $currenttag.=$html[$i];
                    $stack[] = $currenttag;
                }
                $currenttag="";
            }elseif ($intag){
                if($html[$i]=="/"){
                    $closingtag=true;
                }
                $currenttag.=$html[$i];
            }


            if($restr<=$i){
                if($intag){
                    $restr++;
                }else{
                    break;
                }
            }
        }
        $tags = "";
        while (!empty($stack)){
            $tags.= str_replace("<","</",array_pop($stack)) ;
        }
        return substr($html,0,$restr+1).$tags;
    }

    public function calcSlug(Content $content)
    {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($content->getTitle())));
        $dupl_slug = (new ContentDAO())->duplicateSlug($slug);
        if(!empty($dupl_slug) AND in_array($slug, $dupl_slug)){
            $count = 0;
            while( in_array( ($slug . '-' . ++$count ), $dupl_slug) );
            $slug = $slug . '-' . $count;
        }
        return $slug;
    }
}