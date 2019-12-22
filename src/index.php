<?php

/**
 * Created by PhpStorm.
 * User: tobias.koller
 * Date: 30.10.2019
 * Time: 17:49
 */
require_once  dirname(__FILE__). '/../c3.php';

require dirname(__FILE__).'/../vendor/autoload.php';
require_once("config/Autoloader.php");

// @todo should maybe not be hard-coded but be defined by the server config
date_default_timezone_set("Europe/Zurich");

use controller\AuthController;
use controller\ContentController;
use controller\InvoiceController;
use controller\NodeController;
use controller\UserController;
use controller\WithdrawalController;

use domain\Status;

use router\SlimRouter;
use services\ContentServiceImpl;
use services\AuthServiceImpl;
use view\TemplateView;
use view\LayoutRendering;
use router\Router;
use http\HTTPException;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use function foo\func;


ini_set( 'session.cookie_httponly', 1 );
session_start();


$app = SlimRouter::init();

$app->get('/',function ($request, $response, $args){

    ContentController::showContentList();
});

$app->get('/article/{slug}',function ($request, $response, $args){
    ContentController::showContent($args['slug']);
});


$app->run();

/*
$authAdmin = function () {
    if (AuthController::authenticateAdmin()) {
        return true;
    }
    Router::redirect("/login");
    return false;
};

$authFunction = function () {
    if (AuthController::authenticate()) {
       return true;
    }
    Router::redirect("/login");
    return false;
};
$softauthFunction = function () {
    //@todo find another solution to make show user name in nav bar
    AuthController::authenticate();
    return true;
};

Router::route_auth("GET", "/", $softauthFunction, function () {
    ContentController::showContentList();

});
// Static pages
Router::route_auth("GET", "/about", $softauthFunction, function () {
    LayoutRendering::headerLayout(new TemplateView("about.php"),"About </br> lightread","This is how it works");
});
Router::route_auth("GET", "/category", $softauthFunction, function () {
    LayoutRendering::headerLayout(new TemplateView("category.php"),"Category","Find what you are looking for");
});
// Login / registering

Router::route_auth("GET", "/register", $softauthFunction, function () {
    UserController::register();
});
Router::route_auth("POST", "/register", $softauthFunction, function () {
    UserController::submit_register();
});
Router::route_auth("GET", "/confirm_mail", $softauthFunction, function () {
    UserController::confirmmail();
});

Router::route_auth("GET", "/login", $softauthFunction, function () {
    if(!(AuthServiceImpl::getInstance()->verifyAuth())) {
        LayoutRendering::headerLayout(new TemplateView("login.php"), "Login", "Welcome back");
    }
    Router::redirect("/profile");
});
Router::route_auth("POST", "/login", $softauthFunction, function () {
    AuthController::login();
});
Router::route_auth("GET", "/password/request-form", $softauthFunction, function () {
    AuthController::pwRequestView();
});
Router::route_auth("POST", "/password/request", $softauthFunction, function () {
    AuthController::pwResetRequest();
});
Router::route_auth("GET", "/password/reset", $softauthFunction, function () {
    AuthController::pwResetView();
});
Router::route_auth("POST", "/password/reset", $softauthFunction, function () {
    AuthController::pwReset();
});
Router::route_auth("GET", "/profile", $authFunction, function () {
    UserController::showProfile();
});
Router::route_auth("GET", "/edit-profile", $authFunction, function () {
    UserController::loadProfile();
});
Router::route_auth("POST", "/edit-profile", $authFunction, function () {
    UserController::editProfile();
});
Router::route_auth("GET", "/logout", $softauthFunction, function () {
    AuthController::logout();
});
Router::route_auth("GET", "/article", $softauthFunction, function () {
    ContentController::showContent();
});
Router::route_auth("POST", "/edit", $authFunction, function () {
    ContentController::editContent();
});
Router::route_auth("GET", "/new", $authFunction, function () {
    ContentController::newContent();
});
Router::route_auth("POST", "/publish", $authFunction, function () {
    ContentController::store(Status::PUBLISHED());
});
Router::route_auth("POST", "/checkinvoice", $softauthFunction, function () {
        InvoiceController::checkInvoice();
    });

Router::route_auth("POST", "/geninvoice", $softauthFunction, function () {
    InvoiceController::generateInvoice();
});
Router::route_auth("POST", "/preview", $authFunction, function () {
    ContentController::store(Status::DRAFT());
});
Router::route_auth("GET", "/node", $authAdmin, function () {
    NodeController::showNodeinfo();
});

Router::route_auth("GET", "/admin", $authFunction, function () {
        $admin_view = new TemplateView("admin.php");
        LayoutRendering::simpleLayout($admin_view);

});

Router::route_auth("GET", "/transactions", $authFunction, function () {
    $wdrw_view = new TemplateView("transactions.php");
    $wdrw_view->user = $auth = AuthServiceImpl::getInstance()->readUser();
    LayoutRendering::simpleLayout($wdrw_view);

});

Router::route_auth("GET", "/withdraw", $authFunction, function () {
    $wdrw_view = new TemplateView("withdraw.php");
    $wdrw_view->user = $auth = AuthServiceImpl::getInstance()->readUser();
    LayoutRendering::simpleLayout($wdrw_view);

});
Router::route_auth("GET", "/lnurl/withdraw", $softauthFunction, function () {
    WithdrawalController::lnUrlPaymentRequest();
});
Router::route_auth("GET", "/lnurl/info_request", $softauthFunction, function () {
    WithdrawalController::lnUrlInfoRequest();
});

Router::route_auth("POST", "/withdraw", $authFunction, function () {
    WithdrawalController::withdraw();;
});

try {
    Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
} catch (HTTPException $exception) {
    $exception->getHeader();
    LayoutRendering::headerLayout(new TemplateView("404.php"),"404","page not found");

}
*/
