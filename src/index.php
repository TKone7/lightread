<?php

/**
 * Created by PhpStorm.
 * User: tobias.koller
 * Date: 30.10.2019
 * Time: 17:49
 */
require dirname(__FILE__).'/../vendor/autoload.php';
require_once("config/Autoloader.php");
// @todo should maybe not be hard-coded but be defined by the server config
date_default_timezone_set("Europe/Zurich");

use controller\AuthController;
use controller\CategoryController;
use controller\ContentController;
use controller\InvoiceController;
use controller\NodeController;
use controller\UserController;
use controller\WithdrawalController;


use domain\Category;
use domain\Status;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use services\AuthServiceImpl;
use view\TemplateView;
use view\LayoutRendering;
use router\Router;
use http\HTTPException;

ini_set( 'session.cookie_httponly', 1 );
session_start();

$router = Router::getInstance();

// Authentication filters
$router->filter('authadmin', function(){
    if (!AuthController::authenticateAdmin()) {
        Router::redirect('/login');
        return false;
    }
});
$router->filter('auth', function(){
    if (!AuthController::authenticate()) {
        Router::redirect('/login');
        return false;
    }
});
$router->filter('noauth', function(){
    AuthController::authenticate();
});

// Admin
$router->group(['before' => 'authadmin'], function($router){
    $router->get('/node',function () {
        NodeController::showNodeinfo();
    });
});
// Auth
$router->group(['before' => 'auth'], function($router){
    $router->get('profile', function () {
        UserController::showProfile();
    });
    $router->get('/edit-profile', function () {
        UserController::loadProfile();
    });
    $router->post('/edit-profile', function () {
        UserController::editProfile();
    });
    $router->get(['/edit/{slug}', 'edit_slug'], function ($slug) {
        ContentController::editContent($slug);
    });
    $router->get('/new', function () {
        ContentController::newContent();
    });
    $router->post('/publish', function () {
        ContentController::store(Status::PUBLISHED());
    });
    $router->post('/preview', function () {
        ContentController::store(Status::DRAFT());
    });
    $router->get('/transactions', function () {
        $wdrw_view = new TemplateView("transactions.php");
        $wdrw_view->user = $auth = AuthServiceImpl::getInstance()->readUser();
        LayoutRendering::simpleLayout($wdrw_view);
    });
    $router->get('/withdraw', function () {
        $wdrw_view = new TemplateView("withdraw.php");
        $wdrw_view->user = $auth = AuthServiceImpl::getInstance()->readUser();
        LayoutRendering::simpleLayout($wdrw_view);
    });
    $router->post('/withdraw', function () {
        WithdrawalController::withdraw();;
    });
});
$router->group(['before' => 'noauth'], function($router){

    $router->get('/',function (){
        ContentController::showContentList();
    });
    $router->post('/', function () {
        ContentController::showContentList();
    });
    // named route for reverse routing. See https://github.com/mrjgreen/phroute#named-routes-for-reverse-routing
    $router->get(['/article/{slug}', 'article_slug'],function ($slug){
        ContentController::showContent($slug);
    });
    $router->get('/article-not-found', function () {
        LayoutRendering::headerLayout(new TemplateView("404.php"), "404", "page not found");
    });
    $router->get(['/author/{author}', 'article_author'],function ($author){
        ContentController::showContentListByAuthor($author);
    });
    $router->post(['/author/{author}', 'article_author'],function ($author){
        ContentController::showContentListByAuthor($author);
    });
    $router->get(['/category/{category}', 'article_category'],function ($category){
        ContentController::showContentListByCategory($category);
    });
    $router->post(['/category/{category}', 'article_category'],function ($category){
        ContentController::showContentListByCategory($category);
    });
    $router->get(['/tag/{keyword}', 'article_keyword'],function ($keyword){
        ContentController::showContentListByKeyword($keyword);
    });
    $router->post(['/tag/{keyword}', 'article_keyword'],function ($keyword){
        ContentController::showContentListByKeyword($keyword);
    });
    $router->get('/about', function () {
        LayoutRendering::headerLayout(new TemplateView("about.php"),"About </br> lightread","This is how it works");
    });
    $router->get('/category', function () {
        //LayoutRendering::headerLayout(new TemplateView("category.php"),"Category","Find what you are looking for");
        CategoryController::showCategoryTiles();
    });
    $router->get('/register', function () {
        UserController::register();
    });
    $router->post('/register', function () {
        UserController::submit_register();
    });
    $router->get('/confirm_mail', function () {
        UserController::confirmmail();
    });
    $router->get('/password/request-form', function () {
        AuthController::pwRequestView();
    });
    $router->post('/password/request', function () {
        AuthController::pwResetRequest();
    });
    $router->get('/password/reset', function () {
        AuthController::pwResetView();
    });
    $router->post('/password/reset', function () {
        AuthController::pwReset();
    });
    $router->get('/logout', function () {
        AuthController::logout();
    });
    $router->post('/checkinvoice', function () {
        InvoiceController::checkInvoice();
    });
    $router->get('/lnurl/withdraw', function () {
        WithdrawalController::lnUrlPaymentRequest();
    });
    $router->get('/lnurl/info_request', function () {
        WithdrawalController::lnUrlInfoRequest();
    });
    $router->post('/geninvoice', function () {
        InvoiceController::generateInvoice();
    });
    $router->get('/login', function () {
        if(!(AuthServiceImpl::getInstance()->verifyAuth())) {
            LayoutRendering::headerLayout(new TemplateView("login.php"), "Login", "Welcome back");
        }else{
            Router::redirect('/profile');
        }
    });
    $router->post('/login', function () {
        AuthController::login();
    });
});

try {
    Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
} catch (HttpRouteNotFoundException $exception) {
    LayoutRendering::headerLayout(new TemplateView("404.php"), "404", "page not found");
}

/*

Router::route_auth("GET", "/admin", $authFunction, function () {
        $admin_view = new TemplateView("admin.php");
        LayoutRendering::simpleLayout($admin_view);

});
*/