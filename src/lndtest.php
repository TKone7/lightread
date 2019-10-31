<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 31.10.19
 * Time: 20:33
 */

require dirname(__FILE__).'/../vendor/autoload.php';

use Lnrpc\AddInvoiceResponse;
use Lnrpc\LightningClient;
use GPBMetadata\Lnd;



$lndIp = 'localhost:10003';
putenv('GRPC_SSL_CIPHER_SUITES=HIGH+ECDSA');
$sslCert = file_get_contents('/home/tobias/.lnd/tls.cert');
$macaroon = file_get_contents('/home/tobias/gocode/dev/charlie/data/chain/bitcoin/regtest/admin.macaroon');
$metadataCallback = function ($metadata) use ($macaroon) {
    return ['macaroon' => [bin2hex($macaroon)]];
};

$client = new LightningClient($lndIp, [
    'credentials' => Grpc\ChannelCredentials::createSsl($sslCert),
    'update_metadata' => $metadataCallback
]);


var_dump($client);
$getInfoRequest = new Lnrpc\GetInfoRequest();

list($reply, $status) = $client->GetInfo($getInfoRequest)->wait();
echo $reply->getIdentityPubkey() . "\n";
echo $reply->getAlias() ."\n";
echo $reply->getBlockHeight() ."\n";

$inv = new Lnrpc\Invoice(['memo' => 'this is freaking awesome', 'value' => 8554]);
list($reply, $status) = $client->AddInvoice($inv)->wait();
var_dump($reply);

$listinvreq = new \Lnrpc\ListInvoiceRequest();
list($reply, $status) = $client->ListInvoices($listinvreq)->wait();
$invoices = $reply->getInvoices();
foreach ($invoices as $i)
    echo $i->getMemo() . " created " . $i->getCreationDate(). " state: " . $i->getState() . " value ". $i->getValue() ."\n";