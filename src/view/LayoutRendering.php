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
        $header = new TemplateView('simple_header.php');
        $footer = new TemplateView('footer.php');
        self::LayoutRender($header, $content, $footer);
    }
    public static function headerLayout(TemplateView $content, $title = Null, $subtitle = Null){
        $header = new TemplateView('header.php');
        // set the tile if they are specified
        $header->title = $title;
        $header->subtitle = $subtitle;
        $footer = new TemplateView('footer.php');
        self::LayoutRender($header, $content, $footer);
    }
    private static function LayoutRender(TemplateView $header, TemplateView $content, TemplateView $footer){
        $page = new TemplateView('layout.php');
        $page->header = $header->render();
        $page->content = $content->render();
        $page->footer = $footer->render();
        echo $page->render();
    }

}