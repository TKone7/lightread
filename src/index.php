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

use controller\ContentController;
use controller\UserController;

use domain\Payment;
use domain\Purpose;
use domain\Status;

use services\ContentServiceImpl;
use services\InvoiceServiceImpl;
use services\AuthServiceImpl;
use view\TemplateView;
use view\LayoutRendering;
use router\Router;
use http\HTTPException;
use rpcclient\RpcClient;

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
        AuthServiceImpl::getInstance()->validateToken($_SESSION["userLogin"]["token"]);
    }
    return true;
};

Router::route_auth("GET", "/", $softauthFunction, function () {
    $home = new TemplateView("home.php");
    $mgr = ContentServiceImpl::getInstance()->getContentMgr();
    $home->mgr=$mgr;
    LayoutRendering::simpleLayout($home);

});
// Static pages
Router::route_auth("GET", "/about", $softauthFunction, function () {
    LayoutRendering::headerLayout(new TemplateView("about.php"),"About </br> lightread","This is how it works");
});
Router::route_auth("GET", "/category", $softauthFunction, function () {
    LayoutRendering::headerLayout(new TemplateView("category.php"),"Category","Find what you are looking for");
});
/*
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
});*/
// Login / registering

Router::route_auth("GET", "/register", $softauthFunction, function () {
    if(!(AuthServiceImpl::getInstance()->verifyAuth())){
        LayoutRendering::headerLayout(new TemplateView("register.php"),"Register","Create account");
    }
    Router::redirect("/profile");
});
Router::route_auth("POST", "/register", $softauthFunction, function () {
    (new UserController())->register();
});
Router::route_auth("GET", "/login", $softauthFunction, function () {
    if(!(AuthServiceImpl::getInstance()->verifyAuth())) {
        LayoutRendering::headerLayout(new TemplateView("login.php"), "Login", "Welcome back");
    }
    Router::redirect("/profile");
});
Router::route_auth("POST", "/login", $softauthFunction, function () {
    (new UserController())->login();
});
Router::route_auth("GET", "/profile", $authFunction, function () {
    (new UserController())->showProfile();
});
Router::route_auth("GET", "/edit-profile", $authFunction, function () {
    (new UserController())->loadProfile();
});
Router::route_auth("POST", "/edit-profile", $authFunction, function () {
    (new UserController())->editProfile();
});
Router::route_auth("GET", "/logout", $softauthFunction, function () {
    session_destroy();
    Router::redirect("/");
});
Router::route_auth("GET", "/article", $softauthFunction, function () {
    (new ContentController())->showContent();
});
Router::route_auth("GET", "/edit", $authFunction, function () {
    (new ContentController())->editContent();
});
Router::route_auth("POST", "/publish", $authFunction, function () {
    (new ContentController())->store(Status::PUBLISHED());
});
Router::route_auth("POST", "/checkinvoice", $softauthFunction, function () {
    if( isset($_POST['ajax']) && isset($_POST['pay_req']) ){
        $inv_svc = InvoiceServiceImpl::getInstance();

        if($inv_svc->checkPayment($_POST["pay_req"])){
            echo "paid";
        }
        else{
            echo "not paid";
        }
        exit;
    }

    });

Router::route_auth("POST", "/geninvoice", $softauthFunction, function () {
    if( isset($_POST['ajax']) && isset($_POST['content_id']) ){
        // get content
        $content = ContentServiceImpl::getInstance()->readContent($_POST['content_id']);
        // get user if any
        $auth = AuthServiceImpl::getInstance();
        if($auth->verifyAuth()){
            $user = $auth->readUser();
        }else {
            $user=NULL;
        }
        $payment = new Payment();
        $payment->setValue($content->getPrice());
        $payment->setPurpose(Purpose::READ());
        $payment->setPayer($user);
        $payment->setContent($content);
        $memo = "Payment for article: '" . $content->getTitle() ;
        if(!is_null($user)){
            $memo .= "' by user " . $user->getFullName() . " ("  . $user->getId() . ")";
        }else{
            $memo .= "' by an anonymous user :-)";
        }
        $payment->setMemo($memo);
        $payment = InvoiceServiceImpl::getInstance()->createPayment($payment);

        $inv->id = $payment->getId();
        $inv->payreq = $payment->getPayReq();
        $myJSON = json_encode($inv);
        echo $myJSON;
        exit;
    }
});
Router::route_auth("POST", "/preview", $authFunction, function () {
    (new ContentController())->store(Status::DRAFT());
});
Router::route_auth("GET", "/node", $authFunction, function () {
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
