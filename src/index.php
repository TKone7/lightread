<?php

/**
 * Created by PhpStorm.
 * User: tobias.koller
 * Date: 30.10.2019
 * Time: 17:49
 */

require dirname(__FILE__).'/../vendor/autoload.php';
require_once("config/Autoloader.php");

use service\UserServiceImpl;
use view\TemplateView;
use view\LayoutRendering;
use router\Router;
use http\HTTPException;
use rpcclient\RpcClient;
use parsedown\Parsedown;
use domain\User;

ini_set( 'session.cookie_httponly', 1 );
session_start();

Router::route("GET", "/",  function () {
    LayoutRendering::simpleLayout(new TemplateView("article.php"));

});
Router::route("GET", "/about",  function () {
    LayoutRendering::headerLayout(new TemplateView("about.php"),"About </br> lightread","This is how it works");
});
Router::route("GET", "/category",  function () {
    LayoutRendering::headerLayout(new TemplateView("category.php"),"Category","Find what you are looking for");

});
Router::route("GET", "/article",  function () {
    $post = new TemplateView("post.php");
    $post->content = "This is just an article";
    LayoutRendering::postLayout($post,"I believe every human has a finite number of heartbeats.","Find what you are looking for", "Tobias Koller");
});
Router::route("GET", "/pay",  function () {
    $post = new TemplateView("post-secured.php");
    LayoutRendering::postLayout($post,"I believe every human has a finite number of heartbeats.","Find what you are looking for", "Tobias Koller");
});
Router::route("POST", "/pay",  function () {
    $post = new TemplateView("post-secured.php");
    $client = RpcClient::connect();
    $inv = new Lnrpc\Invoice();
    $inv->setMemo("This is automatically generated");
    $inv->setValue(1999);
    list($inv_response, $status) = $client->AddInvoice($inv)->wait();
    $post->paymentrequest = $inv_response->getPaymentRequest();
    LayoutRendering::postLayout($post,"I believe every human has a finite number of heartbeats.","Find what you are looking for", "Tobias Koller");
});
Router::route("GET", "/register",  function () {
    LayoutRendering::headerLayout(new TemplateView("register.php"),"Register","Create account");

});
Router::route("POST", "/register",  function () {
    $nu = new User();
    $nu->setUsername($_POST["username"]);
    $nu->setEmail($_POST["email"]);
    $nu->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
    $res = (new UserServiceImpl())->createUser($nu);
    LayoutRendering::headerLayout(new TemplateView("register.php"),"Success","Your ID: ".$res->getId());

});
Router::route("GET", "/login",  function () {
    LayoutRendering::headerLayout(new TemplateView("login.php"),"Login","Welcome back");

});
Router::route("POST", "/login",  function () {
    $_SESSION["mail"] = $_POST["email"];
    LayoutRendering::headerLayout(new TemplateView("login.php"),"Login","Welcome back");

});
Router::route("GET", "/logout",  function () {
    session_destroy();
    Router::redirect("/login");

});
Router::route("GET", "/edit",  function () {
    LayoutRendering::simpleLayout(new TemplateView("editor.php"));
});
Router::route("POST", "/preview",  function () {
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
Router::route("GET", "/node",  function () {
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
