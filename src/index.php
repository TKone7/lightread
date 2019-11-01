<?php

/**
 * Created by PhpStorm.
 * User: tobias.koller
 * Date: 30.10.2019
 * Time: 17:49
 */

require dirname(__FILE__).'/../vendor/autoload.php';
require_once("config/Autoloader.php");


use Lnrpc\LightningClient;
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
Router::route("GET", "/node",  function () {
    $header = new TemplateView("about_header.php");
    $header->title = "Your Node";
    $header->subtitle = "See if it's healthy";
    $header->headerheight=250;
    // @todo These lines will be outsourced in a configuration file
    //$lndIp = 'localhost:10003';
    $lndIp = '10.10.10.41:10009';
    putenv('GRPC_SSL_CIPHER_SUITES=HIGH+ECDSA');
    //$sslCert = file_get_contents('/home/tobias/.lnd/tls.cert');
    //$macaroon = file_get_contents('/home/tobias/gocode/dev/charlie/data/chain/bitcoin/regtest/admin.macaroon');
    $sslCert = file_get_contents('/home/tobias/Lnd/tls.cert');
    $macaroon = file_get_contents('/home/tobias/Lnd/data/chain/bitcoin/mainnet/admin.macaroon');
    $metadataCallback = function ($metadata) use ($macaroon) {
        return ['macaroon' => [bin2hex($macaroon)]];
    };
    try{
        $client = new LightningClient($lndIp, [
            'credentials' => Grpc\ChannelCredentials::createSsl($sslCert),
            'update_metadata' => $metadataCallback
        ]);
    } catch (Exception $e) {
    throw new Exception($e->getMessage());
    echo "something went wrong";
    }
    $getInfoRequest = new Lnrpc\GetInfoRequest();
    list($reply, $status) = $client->GetInfo($getInfoRequest)->wait();
    echo $header->render();
    $node_template = new TemplateView("node.php");
    $node_template->getinforesponse = $reply;
    echo $node_template->render();
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

