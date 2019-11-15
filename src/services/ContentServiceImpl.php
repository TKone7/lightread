<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 08:57
 */

namespace services;


use dao\ContentDAO;
use domain\Content;
use domain\ContentManager;
use http\HTTPException;
use http\HTTPStatusCode;

class ContentServiceImpl implements ContentService
{

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
}