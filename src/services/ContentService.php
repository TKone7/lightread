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

    public function editContent($content_id);

    public function readContent($content_id);

    public function readBySlug($slug); //: Content;

    public function getContentMgr($verified_only = false, array $keyword = NULL, array $category = NULL, array $author = NULL ) : ContentManager;

    public function calcSlug(Content $content);
}