<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 01.11.19
 * Time: 16:57
 */

namespace view;

use Google\Protobuf\NullValue;
use view\TemplateView;

class LayoutRendering
{
    public static function simpleLayout(TemplateView $content){
        $navigation = new TemplateView('navigation.php');
        $navigation->simple = true;
        self::LayoutRender($navigation, $content);
    }
    public static function headerLayout(TemplateView $content, $title = Null, $subtitle = Null){
        $navigation = new TemplateView('navigation.php');
        $header = new TemplateView('header.php');
        // set the tile if they are specified
        $header->title = $title;
        $header->subtitle = $subtitle;
        self::LayoutRender($navigation, $content, $header);
    }
    public static function postLayout(TemplateView $content, $title, $subtitle, $author){
        $navigation = new TemplateView('navigation.php');
        $header = new TemplateView('post_header.php');
        // set the tile if they are specified
        $header->title = $title;
        $header->subtitle = $subtitle;
        $header->author = $author;
        self::LayoutRender($navigation, $content, $header);
    }
    private static function LayoutRender(TemplateView $navigation, TemplateView $content, TemplateView $header=Null){
        $page = new TemplateView('layout.php');
        $page->navigation = $navigation->render();
        if (isset($header)){
            $page->header = $header->render();
        }
        $page->content = $content->render();
        $page->footer = (new TemplateView('footer.php'))->render();
        echo $page->render();
    }

}