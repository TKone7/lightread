<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:45
 */

namespace services;

use domain\Category;

interface KeywordService
{
    public function getAll();

    public function getKeyword($id);

}