<?php

/**
 * Created by PhpStorm.
 * User: tobias.koller
 * Date: 30.10.2019
 * Time: 17:49
 */

require dirname(__FILE__).'/../vendor/autoload.php';
require_once("config/Autoloader.php");

use services\UserServiceImpl;
use services\AuthServiceImpl;
use view\TemplateView;
use view\LayoutRendering;
use router\Router;
use http\HTTPException;
use rpcclient\RpcClient;
use parsedown\Parsedown;
use domain\User;

ini_set( 'session.cookie_httponly', 1 );
session_start();

$authFunction = function () {
    if (isset($_SESSION["userLogin"])) {
        if(AuthServiceImpl::getInstance()->validateToken($_SESSION["userLogin"]["token"])) {
            return true;
        }
    }
    Router::redirect("/login");
    return false;
};
$softauthFunction = function () {
    if (isset($_SESSION["userLogin"])) {
        if(AuthServiceImpl::getInstance()->validateToken($_SESSION["userLogin"]["token"])) {
            return true;
        }
    }
    return true;
};

Router::route_auth("GET", "/", $softauthFunction, function () {
    LayoutRendering::simpleLayout(new TemplateView("article.php"));

});
Router::route_auth("GET", "/about", $softauthFunction, function () {
    LayoutRendering::headerLayout(new TemplateView("about.php"),"About </br> lightread","This is how it works");
});
Router::route_auth("GET", "/category", $softauthFunction, function () {
    LayoutRendering::headerLayout(new TemplateView("category.php"),"Category","Find what you are looking for");

});
Router::route_auth("GET", "/article", $softauthFunction, function () {
    $post = new TemplateView("post.php");
    $post->content = "This is just an article";
    LayoutRendering::postLayout($post,"I believe every human has a finite number of heartbeats.","Find what you are looking for", "Tobias Koller");
});
Router::route_auth("GET", "/pay", $softauthFunction, function () {
    $post = new TemplateView("post-secured.php");
    LayoutRendering::postLayout($post,"I believe every human has a finite number of heartbeats.","Find what you are looking for", "Tobias Koller");
});
Router::route_auth("POST", "/pay", $softauthFunction,  function () {
    $post = new TemplateView("post-secured.php");
    $client = RpcClient::connect();
    $inv = new Lnrpc\Invoice();
    $inv->setMemo("This is automatically generated");
    $inv->setValue(1999);
    list($inv_response, $status) = $client->AddInvoice($inv)->wait();
    $post->paymentrequest = $inv_response->getPaymentRequest();
    LayoutRendering::postLayout($post,"I believe every human has a finite number of heartbeats.","Find what you are looking for", "Tobias Koller");
});
Router::route_auth("GET", "/register", $softauthFunction, function () {
    if(!(AuthServiceImpl::getInstance()->verifyAuth())){
        LayoutRendering::headerLayout(new TemplateView("register.php"),"Register","Create account");
    }
    Router::redirect("/profile");

});
Router::route_auth("POST", "/register", $softauthFunction, function () {
    $nu = new User();
    $nu->setUsername($_POST["username"]);
    $nu->setEmail($_POST["email"]);
    $nu->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
    $res = (new UserServiceImpl())->createUser($nu);
    LayoutRendering::headerLayout(new TemplateView("register.php"),"Success","Your ID: ".$res->getId());
});
Router::route_auth("GET", "/login", $softauthFunction, function () {
    if(!(AuthServiceImpl::getInstance()->verifyAuth())) {
        LayoutRendering::headerLayout(new TemplateView("login.php"), "Login", "Welcome back");
    }
    Router::redirect("/profile");

});
Router::route_auth("POST", "/login", $softauthFunction, function () {
    $authservice = AuthServiceImpl::getInstance();
    if($authservice->verifyUser($_POST["email"], $_POST["password"])){
        session_regenerate_id(true);
        $_SESSION["userLogin"]["token"] = $authservice->issueToken();
        Router::redirect("/profile");
    }else {
        LayoutRendering::headerLayout(new TemplateView("login.php"), "Login", "Welcome back");
    }
});
Router::route_auth("GET", "/profile", $authFunction, function () {
    $authservice = AuthServiceImpl::getInstance();
    $content = new TemplateView("profile.php");
    $content->user=$authservice->readUser();
    LayoutRendering::simpleLayout($content);

});
Router::route_auth("GET", "/logout", $softauthFunction, function () {
    session_destroy();
    Router::redirect("/login");

});
Router::route_auth("GET", "/edit", $softauthFunction, function () {
    LayoutRendering::simpleLayout(new TemplateView("editor.php"));
});
Router::route_auth("POST", "/preview", $softauthFunction, function () {
    $title = $_POST["title"];
    $subtitle = $_POST["subtitle"];
    $md = $_POST["editordata"];
    $Parsedown = new Parsedown();
    $Parsedown->setSafeMode(true);
    $content = $Parsedown->text($md);
    $post = new TemplateView("post.php");
    $post->content = $content;
    LayoutRendering::postLayout($post,$title, $subtitle, "Tobias Koller");
});
Router::route_auth("GET", "/node", $softauthFunction, function () {
    $client = RpcClient::connect();
    $getInfoRequest = new Lnrpc\GetInfoRequest();
    $WalletbalanceRequest = new Lnrpc\WalletBalanceRequest();
    $ChannelbalanceRequest = new Lnrpc\ChannelBalanceRequest();
    $channelreq = new Lnrpc\ListChannelsRequest();
    $pendchannelreq = new Lnrpc\PendingChannelsRequest();
    list($reply, $status) = $client->GetInfo($getInfoRequest)->wait();
    list($wallet_bal, $status) = $client->WalletBalance($WalletbalanceRequest)->wait();
    list($channel_bal, $status) = $client->ChannelBalance($ChannelbalanceRequest)->wait();
    list($ListChannelsResp, $status) = $client->ListChannels($channelreq)->wait();
    list($PendingChannelsResp, $status) = $client->PendingChannels($pendchannelreq)->wait();

    $node_content = new TemplateView("node.php");
    $node_content->getinforesponse = $reply;
    $node_content->walletbalance = $wallet_bal;
    $node_content->channelbalance = $channel_bal;
    $node_content->ListChannelsResp = $ListChannelsResp;
    $node_content->PendingChannelsResp = $PendingChannelsResp;
    LayoutRendering::headerLayout($node_content,"Your Node","See if it's healthy");
});

try {
    Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
} catch (HTTPException $exception) {
    $exception->getHeader();
    LayoutRendering::headerLayout(new TemplateView("404.php"),"404","page not found");

}
