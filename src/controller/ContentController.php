<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 10:44
 */

namespace controller;


use dao\UserDAO;
use domain\Access;
use domain\Content;
use domain\Status;
use parsedown\Parsedown;
use router\Router;
use services\AuthServiceImpl;
use services\CategoryServiceImpl;
use services\ContentServiceImpl;
use services\ContentKeywordServiceImpl;
use services\InvoiceServiceImpl;
use services\KeywordServiceImpl;
use services\SearchServiceImpl;
use services\UserServiceImpl;
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

        // read content if id is given
        if($id){
            $cont = ContentServiceImpl::getInstance()->readContent($id);
        }else{
            $cont->setAuthor($auth->readUser());
        }

        //update values
        $cont->setTitle($_POST["title"]);
        $cont->setSubtitle($_POST["subtitle"]);
        $category_id = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
        if(!empty($category_id)){
            $cont->setCategory(CategoryServiceImpl::getInstance()->getCategory($category_id));
        }
        $kws = str_getcsv($_POST["keywords"]);
        if(!$kws[0] == Null){
            $cont->setKeywords(KeywordServiceImpl::getInstance()->syncKeywords($kws));
        }
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


        $validator = new ContentValidator($cont);
        if ($validator->isValid()){
            $contsvc = ContentServiceImpl::getInstance();
            if($id){
                // update
                $res = $contsvc->updateContent($cont);
                SearchServiceImpl::getInstance()->updateInIndex($res);
            }else{
                // create
                $res = $contsvc->createContent($cont);
                SearchServiceImpl::getInstance()->insertInIndex($res);
            }



            $route = '/'.Router::getInstance()->route('article_slug', [$res->getSlug()]);
            Router::redirect($route);
        }else{
            $editorView = new TemplateView("editor.php");
            $editorView->content=$cont;
            $editorView->contentValidator = $validator;
            $categories =  CategoryServiceImpl::getInstance()->getAll();
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
            $body = ContentServiceImpl::getInstance()->trimHTML($body,$_GET["len"]??300);
        }
        $post->content = $content;
        $post->body = $body;
        $post->restricted = $restricted;
        $post->keywords = KeywordServiceImpl::getInstance()->getKeywords($content);
        $allow = $content->getAuthor()->getId()==AuthServiceImpl::getInstance()->getCurrentUserId();
        LayoutRendering::postLayout($post,$content,$allow);


    }
    public static function editContent($slug){
        // retrieve content
        $content = ContentServiceImpl::getInstance()->readBySlug($slug);
        $editor = new TemplateView("editor.php");
        $categories =  CategoryServiceImpl::getInstance()->getAll();
        $editor->categories = $categories;
        $keywsvc = KeywordServiceImpl::getInstance();
        $editor->keywordvalues = $keywsvc->getValues($content);
        $editor->keywordsuggestions = $keywsvc->getSuggestions();
        if(!empty($content) && $content->getAuthor()->getId() === AuthServiceImpl::getInstance()->getCurrentUserId()){
            $editor->content=$content;
        }else {
            Router::redirect("/article-not-found");
        }

        LayoutRendering::simpleLayout($editor);

    }
    public static function newContent(){
        $editor = new TemplateView("editor.php");
        $categories =  CategoryServiceImpl::getInstance()->getAll();
        $editor->categories = $categories;
        $editor->keywordvalues = "";
        $editor->keywordsuggestions = KeywordServiceImpl::getInstance()->getSuggestions();
        LayoutRendering::simpleLayout($editor);

    }

    public static function showContentList()
    {
        $navigation = new TemplateView('navigation.php');
        $navigation->allowSearch = true;
        $navigation->SearchPlaceholder = "search...";
        $home = new TemplateView("home.php");
        $mgr = ContentServiceImpl::getInstance()->getContentMgr(true);
        if(isset($_POST["searchterm"])){
            $findings = SearchServiceImpl::getInstance()->getFindingsTNT($_POST["searchterm"], $mgr->getContent());
            $mgr->updateContentList($findings);
        }
        $home->mgr=$mgr;
        LayoutRendering::simpleLayout($home, $navigation);
    }


    public static function showContentListByAuthor($author)
    {
        $user_author = UserServiceImpl::getInstance()->readUserByUsername($author);
        $navigation = new TemplateView('navigation.php');
        $navigation->allowSearch = true;
        $navigation->SearchPlaceholder = "search by " . $user_author->getFullName()  . " ...";
        $home = new TemplateView("home.php");
        $mgr = ContentServiceImpl::getInstance()->getContentMgr(true,NULL,NULL,[$user_author]);
        if(isset($_POST["searchterm"])){
            $findings = SearchServiceImpl::getInstance()->getFindingsTNT($_POST["searchterm"], $mgr->getContent());
            $mgr->updateContentList($findings);
        }
        $home->mgr=$mgr;
        LayoutRendering::simpleLayout($home, $navigation);
    }

    public static function showContentListByCategory($category_key)
    {
        $category = CategoryServiceImpl::getInstance()->getCategoryByKey($category_key);
        $navigation = new TemplateView('navigation.php');
        $navigation->allowSearch = true;
        $navigation->SearchPlaceholder = "search in " . $category->getName() . " ...";
        $home = new TemplateView("home.php");
        $mgr = ContentServiceImpl::getInstance()->getContentMgr(true,NULL,[$category],NULL);
        if(isset($_POST["searchterm"])){
            $findings = SearchServiceImpl::getInstance()->getFindingsTNT($_POST["searchterm"], $mgr->getContent());
            $mgr->updateContentList($findings);
        }
        $home->mgr=$mgr;
        LayoutRendering::simpleLayout($home, $navigation);
    }


    public static function showContentListByKeyword($keywordname)
    {
        $keyword = KeywordServiceImpl::getInstance()->getKeywordByName($keywordname);
        $navigation = new TemplateView('navigation.php');
        $navigation->allowSearch = true;
        $navigation->SearchPlaceholder = "search with " . $keyword->getName() . " tag ...";
        $home = new TemplateView("home.php");
        $mgr = ContentServiceImpl::getInstance()->getContentMgr(true,[$keyword],NULL,NULL);
        if(isset($_POST["searchterm"])){
            $findings = SearchServiceImpl::getInstance()->getFindingsTNT($_POST["searchterm"], $mgr->getContent());
            $mgr->updateContentList($findings);
        }
        $home->mgr=$mgr;
        LayoutRendering::simpleLayout($home, $navigation);
    }

}
