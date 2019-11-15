<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 08:55
 */

namespace services;


use domain\Content;
use domain\ContentManager;

interface ContentService
{
    public function createContent(Content $content);

    public function updateContent(Content $content);

    public function getContentMgr(array $keyword = NULL, array $category = NULL, array $author = NULL ) : ContentManager;
}