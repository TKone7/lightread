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
Router::route("GET", "/login",  function () {
    LayoutRendering::headerLayout(new TemplateView("login.php"),"Login","Welcome back");

});
Router::route("GET", "/node",  function () {
    // @todo later outsource the whole node gRPC client configuration
    putenv('GRPC_SSL_CIPHER_SUITES=HIGH+ECDSA');
    $lndIp = Config::get("lndmain.ip");
    $ssl = file_get_contents(Config::get("lndmain.ssl"));
    $macaroon = file_get_contents(Config::get("lndmain.macaroon"));
    $metadataCallback = function ($metadata) use ($macaroon) {
        return ['macaroon' => [bin2hex($macaroon)]];
    };
    try{
        $client = new LightningClient($lndIp, [
            'credentials' => Grpc\ChannelCredentials::createSsl($ssl),
            'update_metadata' => $metadataCallback
        ]);
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
        echo "something went wrong";
    }
    $getInfoRequest = new Lnrpc\GetInfoRequest();
    list($reply, $status) = $client->GetInfo($getInfoRequest)->wait();
    $node_content = new TemplateView("node.php");
    $node_content->getinforesponse = $reply;
    LayoutRendering::headerLayout($node_content,"Your Node","See if it's healthy");
});

try {
    Router::call_route($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
} catch (HTTPException $exception) {
    $exception->getHeader();
    LayoutRendering::headerLayout(new TemplateView("404.php"),"404","page not found");

}

echo Config::get("lndmain.ssl");