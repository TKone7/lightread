<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 01.11.19
 * Time: 16:57
 */

namespace view;

use domain\Content;
use Google\Protobuf\NullValue;
use services\AuthServiceImpl;
use view\TemplateView;

class LayoutRendering
{
    public static function simpleLayout(TemplateView $content, TemplateView $navigation = Null){
        if(!(isset($navigation))){
            $navigation = new TemplateView('navigation.php');
            $navigation->allowSearch = false;
        }
        $navigation->simple = true;
        self::LayoutRender($navigation, $content);
    }
    public static function headerLayout(TemplateView $content, $title = Null, $subtitle = Null){
        $navigation = new TemplateView('navigation.php');
        $navigation->allowSearch = false;
        $navigation->simple = false;
        $header = new TemplateView('header.php');
        // set the tile if they are specified
        $header->title = $title;
        $header->subtitle = $subtitle;
        self::LayoutRender($navigation, $content, $header);
    }
    public static function postLayout(TemplateView $content, Content $article, $allowEdit){
        $navigation = new TemplateView('navigation.php');
        $navigation->allowSearch = false;
        $navigation->simple = false;
        $header = new TemplateView('post_header.php');
        // set the tile if they are specified
        //@todo change this whole ugly structure and somehow pass a content into the header directly
        $header->content=$article;
        $header->edit=$allowEdit;
        self::LayoutRender($navigation, $content, $header);
    }
    private static function LayoutRender(TemplateView $navigation, TemplateView $content, TemplateView $header=Null){
        $page = new TemplateView('layout.php');

        if(AuthServiceImpl::getInstance()->verifyAuth()){
            $navigation->loggedin = true;
            $navigation->user = AuthServiceImpl::getInstance()->readUser();
        }

        $page->navigation = $navigation->render();
        $page->header = $header; //if not initiated, error is thrown
        if (isset($header)){
            $page->header = $header->render();
        }
        $page->content = $content->render();
        $page->footer = (new TemplateView('footer.php'))->render();
        echo $page->render();
    }

}