<?php

/**
 * Created by PhpStorm.
 * User: tobias.koller
 * Date: 30.10.2019
 * Time: 17:49
 */

require dirname(__FILE__).'/../vendor/autoload.php';
require_once("config/Autoloader.php");

use config\Config;
use Lnrpc\LightningClient;
use view\TemplateView;
use view\LayoutRendering;
use router\Router;
use http\HTTPException;
use rpcclient\RpcClient;

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
    LayoutRendering::postLayout(new TemplateView("post.php"),"I believe every human has a finite number of heartbeats.","Find what you are looking for", "Tobias Koller");

});
Router::route("GET", "/login",  function () {
    LayoutRendering::headerLayout(new TemplateView("login.php"),"Login","Welcome back");

});
Router::route("GET", "/edit",  function () {
    LayoutRendering::simpleLayout(new TemplateView("editor.php"));
});
Router::route("GET", "/node",  function () {
    // @todo later outsource the whole node gRPC client configuration
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
