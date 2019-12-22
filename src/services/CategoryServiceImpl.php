<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:47
 */

namespace services;


use dao\CategoryDAO;

class CategoryServiceImpl implements CategoryService
{
    private static $instance = NULL;

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getAll()
    {
        return (new CategoryDAO())->readAll();
    }

    public function getCategory($id)
    {
        return (new CategoryDAO())->read($id);
    }
    public function getCategoryByKey($key)
    {
        return (new CategoryDAO())->readByKey($key);
    }
}