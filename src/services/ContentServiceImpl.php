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

    public function createContent(Content $content)
    {
        $auth = AuthServiceImpl::getInstance();
        if($auth->verifyAuth()){
            $contentdao = new ContentDAO();
            $content->setAuthor($auth->readUser());
            return $contentdao->create($content);
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);
    }

    public function updateContent(Content $content)
    {
        $auth = AuthServiceImpl::getInstance();
        if(AuthServiceImpl::getInstance()->verifyAuth()){
            $contentdao = new ContentDAO();
            $content->setAuthor($auth->readUser());
            return $contentdao->update($content);
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
    public function getTurnover(Content $content, Purpose $purpose = NULL){
        $paym_dao = new PaymentDAO();
        return $paym_dao->selectContentTurnover($content,$purpose);
    }

    public function getContentMgr(array $keyword = NULL, array $category = NULL, array $author = NULL): ContentManager
    {
        $authorslist = NULL;
        $contentdao = new ContentDAO();
        if(!is_null($author)){

            foreach ($author as $a){
                $authorslist .= $a->getId().",";
            }
        }
        $contents = $contentdao->filter(NULL,NULL,$authorslist);
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
}