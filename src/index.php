<?php

/**
 * Created by PhpStorm.
 * User: tobias.koller
 * Date: 30.10.2019
 * Time: 17:49
 */

require_once("config/Autoloader.php");


use view\TemplateView;
use router\Router;
use http\HTTPException;

ini_set( 'session.cookie_httponly', 1 );
session_start();

Router::route("GET", "/",  function () {
    $header = new TemplateView("simple_header.php");

    echo $header->render();
    echo (new TemplateView("article.php"))->render();
    echo (new TemplateView("footer.php"))->render();
});
Router::route("GET", "/about",  function () {
    $header = new TemplateView("about_header.php");
    $header->title = "About </br> lightread";
    $header->subtitle = "This is how it works";
    echo $header->render();
    echo (new TemplateView("about.php"))->render();
    echo (new TemplateView("footer.php"))->render();
});
Router::route("GET", "/category",  function () {
    $header = new TemplateView("about_header.php");
    $header->title = "Category";
    $header->subtitle = "Find what you are looking for";
    echo $header->render();
    echo (new TemplateView("category.php"))->render();
    echo (new TemplateView("footer.php"))->render();
});
Router::route("GET", "/login",  function () {
    $header = new TemplateView("about_header.php");
    $header->title = "Login";
    $header->subtitle = "Welcome back";
    echo $header->render();
    echo (new TemplateView("login.php"))->render();
    echo (new TemplateView("footer.php"))->render();
});

try {
    Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
} catch (HTTPException $exception) {
    $exception->getHeader();
    $tv = new TemplateView("about_header.php");
    $tv->title = "404 page not found";
    $tv->subtitle = "please try again or go back home";
    echo $tv->render();
    echo "</body>";
}

