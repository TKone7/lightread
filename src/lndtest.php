<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 31.10.19
 * Time: 20:33
 */

require dirname(__FILE__).'/../vendor/autoload.php';

use config\Config;
use Lnrpc\AddInvoiceResponse;
use Lnrpc\LightningClient;
use GPBMetadata\Lnd;
use view\ChannelFormatter;
use rpcclient\RpcClient;

$client = RpcClient::connect();


var_dump($client);
$getInfoRequest = new Lnrpc\GetInfoRequest();

list($reply, $status) = $client->GetInfo($getInfoRequest)->wait();
echo $reply->getIdentityPubkey() . "\n";
echo $reply->getAlias() ."\n";
echo $reply->getBlockHeight() ."\n";

$chain_array = $reply->getChains();
$itr = $chain_array->getIterator();

// Use iterator to traverse Array
while($itr->valid()) {
    echo $itr->key().' => '.$itr->current()->getNetwork() .$itr->current()->getChain()."\n";

    $itr->next();
}
$WalletbalanceRequest = new Lnrpc\WalletBalanceRequest();
list($wallet, $status) = $client->WalletBalance($WalletbalanceRequest)->wait();
echo $wallet->getTotalBalance();

//print $rf.count();
/*$inv = new Lnrpc\Invoice(['memo' => 'this is freaking awesome', 'value' => 8554]);
list($reply, $status) = $client->AddInvoice($inv)->wait();
var_dump($reply);*/

$pendchannelreq = new Lnrpc\PendingChannelsRequest();
list($PendingChannelsResp, $status) = $client->PendingChannels($pendchannelreq)->wait();
$WaitingClose = $PendingChannelsResp->getWaitingCloseChannels();
$itr = $WaitingClose->getIterator();
$itr->rewind();


$output = '';
echo "size: ". count($WaitingClose);
while($itr->valid()) {
    echo "closechannel: ";
    $output.= ChannelFormatter::formatPendingChannel($itr->current());
    $itr->next();
}
echo $output;

/*
$listinvreq = new \Lnrpc\ListInvoiceRequest();
list($reply, $status) = $client->ListInvoices($listinvreq)->wait();
$invoices = $reply->getInvoices();
foreach ($invoices as $i)
    echo $i->getMemo() . " created " . $i->getCreationDate(). " state: " . $i->getState() . " value ". $i->getValue() ."\n";
*/