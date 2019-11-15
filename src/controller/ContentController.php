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
        if($_POST["paid"]=="on" AND $sat>0){
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
        $id = $_GET["id"];
        $content = ContentServiceImpl::getInstance()->readContent($id);
        $post = new TemplateView("post.php");

        if (!is_null($content)){
            $Parsedown = new Parsedown();
            $Parsedown->setSafeMode(true);
            $body = $Parsedown->text($content->getBody());
            $post->content = $body;
            $allow = $content->getAuthor()->getId()==AuthServiceImpl::getInstance()->getCurrentUserId();
            LayoutRendering::postLayout($post,$content->getTitle(), $content->getSubtitle(), $content->getAuthor()->getFullName(),$content->getCreationDate(),$allow, $content->getId());
        }else{
            Router::redirect("/article-not-found");
        }

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