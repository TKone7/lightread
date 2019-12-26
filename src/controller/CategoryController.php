<?php

namespace controller;


use services\CategoryServiceImpl;
use view\LayoutRendering;
use view\TemplateView;



class CategoryController
{

    public static function showCategoryTiles()
    {
        $category = new TemplateView("category.php");
        $categories = CategoryServiceImpl::getInstance()->getAll();
        $category->categories = $categories;
        LayoutRendering::headerLayout($category, "Category", "Find what you are looking for");


    }


}


