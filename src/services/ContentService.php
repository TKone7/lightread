<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 08:55
 */

namespace services;


use domain\Content;

interface ContentService
{
    public function createContent(Content $content);

    public function updateContent(Content $content);
}