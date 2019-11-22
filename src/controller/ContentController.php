<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 10:44
 */

namespace controller;


use domain\Access;
use domain\Content;
use domain\Status;
use parsedown\Parsedown;
use router\Router;
use services\AuthServiceImpl;
use services\ContentServiceImpl;
use services\InvoiceServiceImpl;
use view\LayoutRendering;
use view\TemplateView;

class ContentController
{
    public function store(Status $new_status){
        $cont = new Content();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $cont->setTitle($_POST["title"]);
        $cont->setSubtitle($_POST["subtitle"]);
        $cont->setBody($_POST["editordata"]);
        $cont->setStatus($new_status);
        $sat = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        if($sat>0){
            $cont->setAccess(Access::PAID());
            $cont->setPrice($sat);
        }else{
            $cont->setAccess(Access::FREE());
            $cont->setPrice(0);
        }

        $contsvc = ContentServiceImpl::getInstance();
        if($id>0){
            // update
            $cont->setId($id);
            $res = $contsvc->updateContent($cont);

        }else{
            // create
            $res = $contsvc->createContent($cont);
        }

        Router::redirect("/article?id=" . $res->getId());

    }
    public function showContent(){
        $restricted = false;
        $id = $_GET["id"];
        $content = ContentServiceImpl::getInstance()->readContent($id);
        $post = new TemplateView("post.php");
        // show not found
        if (is_null($content)) {
            Router::redirect("/article-not-found");
        }

        if ($content->getAccess() == Access::PAID()){
            $auth = AuthServiceImpl::getInstance();

            $userisauthor = false;
            if ($auth->verifyAuth()){
                $userisauthor = $content->getAuthor()->getId() == $auth->readUser()->getId();
                $userhasalreadypaid = InvoiceServiceImpl::getInstance()->userPaidContent($auth->readUser(),$content);
            }
            if (!$userhasalreadypaid and !$userisauthor){
                $restricted = true;
            }
        }
        $body = $content->getHTMLBody();
        if($restricted){
            $body =ContentServiceImpl::getInstance()->trimHTML($body,$_GET["len"]??300);
        }
        $post->content = $content;
        $post->body = $body;
        $post->restricted = $restricted;
        $allow = $content->getAuthor()->getId()==AuthServiceImpl::getInstance()->getCurrentUserId();
        LayoutRendering::postLayout($post,$content->getTitle(), $content->getSubtitle(), $content->getAuthor()->getFullName(),$content->getCreationDate(),$allow, $content->getId());


    }
    public function editContent(){
        // retrieve content
        $id = $_GET["id"];
        $editor = new TemplateView("editor.php");

        if(isset($id)){
            $content = ContentServiceImpl::getInstance()->editContent($id);
            if (!is_null($content)){
                $editor->content=$content;
            }else {
                Router::redirect("/article-not-found");
            }
        }
        LayoutRendering::simpleLayout($editor);

    }

}