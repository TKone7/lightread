<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 10:44
 */

namespace controller;


use dao\CategoryDAO;
use domain\Access;
use domain\Content;
use domain\Status;
use parsedown\Parsedown;
use router\Router;
use services\AuthServiceImpl;
use services\ContentServiceImpl;
use services\InvoiceServiceImpl;
use services\ViewServiceImpl;
use validator\ContentValidator;
use view\LayoutRendering;
use view\TemplateView;

class ContentController
{
    public static function store(Status $new_status){
        $auth = AuthServiceImpl::getInstance();
        $cont = new Content();
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        $cont->setId($id);
        $cont->setTitle($_POST["title"]);
        $cont->setSubtitle($_POST["subtitle"]);
        $category_id = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
        if(!empty($category_id)){
            $cont->setCategory((new CategoryDAO())->read($category_id));
        }
        $cont->setBody($_POST["editordata"]);
        $cont->setStatus($new_status);
        $cont->setAuthor($auth->readUser());
        $sat = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        if($sat>0){
            $cont->setAccess(Access::PAID());
            $cont->setPrice($sat);
        }else{
            $cont->setAccess(Access::FREE());
            $cont->setPrice(0);
        }
        $validator = new ContentValidator($cont);
        if ($validator->isValid()){
            $contsvc = ContentServiceImpl::getInstance();
            if($id>0){
                // update
                $cont->setId($id);
                $res = $contsvc->updateContent($cont);

            }else{
                // create
                $res = $contsvc->createContent($cont);
            }

            $route = '/'.Router::getInstance()->route('article_slug', [$res->getSlug()]);
            Router::redirect($route);
        }else{
            $editorView = new TemplateView("editor.php");
            $editorView->content=$cont;
            $editorView->contentValidator = $validator;
            $categories =  (new CategoryDAO())->readAll();
            $editorView->categories = $categories;
            LayoutRendering::simpleLayout($editorView);
        }


    }
    public static function showContent($slug){
        $restricted = false;
        $content = ContentServiceImpl::getInstance()->readBySlug($slug);
        $post = new TemplateView("post.php");
        // show not found
        if (is_null($content)) {
            Router::redirect("/article-not-found");
        }

        //register a view
        ViewServiceImpl::getInstance()->registerView($content);


        if ($content->getAccess() == Access::PAID()){
            $auth = AuthServiceImpl::getInstance();

            $userisauthor = false;
            $userhasalreadypaid = false;
            $anonymhasalreadypaid = false;
            if ($auth->verifyAuth()){
                $userisauthor = $content->getAuthor()->getId() == $auth->readUser()->getId();
                $userhasalreadypaid = InvoiceServiceImpl::getInstance()->userPaidContent($auth->readUser(),$content);
            }else{
                $anonymhasalreadypaid = InvoiceServiceImpl::getInstance()->anonymPaidContent($content);
            }
            if (!$userhasalreadypaid and !$userisauthor and !$anonymhasalreadypaid){
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
        LayoutRendering::postLayout($post,$content,$allow);


    }
    public static function editContent($slug){
        // retrieve content
        $content = ContentServiceImpl::getInstance()->readBySlug($slug);
        $editor = new TemplateView("editor.php");
        $categories =  (new CategoryDAO())->readAll();
        $editor->categories = $categories;
        if(!empty($content)){
            $editor->content=$content;
        }else {
            Router::redirect("/article-not-found");
        }

        LayoutRendering::simpleLayout($editor);

    }
    public static function newContent(){
        $editor = new TemplateView("editor.php");
        $categories =  (new CategoryDAO())->readAll();
        $editor->categories = $categories;
        LayoutRendering::simpleLayout($editor);

    }

    public static function showContentList()
    {
        $home = new TemplateView("home.php");
        $mgr = ContentServiceImpl::getInstance()->getContentMgr(true);
        $home->mgr=$mgr;
        LayoutRendering::simpleLayout($home);
    }

    public static function showContentListBy()
    {
        $home = new TemplateView("home.php");
        $mgr = ContentServiceImpl::getInstance()->getContentMgr(true);
        $home->mgr=$mgr;
        LayoutRendering::simpleLayout($home);
    }


}
