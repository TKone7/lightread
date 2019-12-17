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

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getCategory($id)
    {
        return (new CategoryDAO())->read($id);
    }
}