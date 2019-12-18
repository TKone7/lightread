<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 18.12.19
 * Time: 15:41
 */

namespace controller;


use Lnrpc\ChannelBalanceRequest;
use Lnrpc\GetInfoRequest;
use Lnrpc\ListChannelsRequest;
use Lnrpc\PendingChannelsRequest;
use Lnrpc\WalletBalanceRequest;
use rpcclient\RpcClient;
use view\LayoutRendering;
use view\TemplateView;

class NodeController
{
    public static function showNodeinfo()
    {
        $client = RpcClient::connect();
        $getInfoRequest = new GetInfoRequest();
        $WalletbalanceRequest = new WalletBalanceRequest();
        $ChannelbalanceRequest = new ChannelBalanceRequest();
        $channelreq = new ListChannelsRequest();
        $pendchannelreq = new PendingChannelsRequest();
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
    }

}