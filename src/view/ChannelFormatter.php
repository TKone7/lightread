<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 02.11.19
 * Time: 11:14
 */

namespace view;

use Lnrpc\PendingChannelsResponse\PendingChannel;
use Lnrpc\Channel;

class ChannelFormatter
{
    private static $channeltemplate = "view/templates/channel.php";
    private static $pendingchanneltemplate = "view/templates/pendingchannel.php";

    public static function formatChannel(Channel $channel){
        $local = $channel->getLocalBalance();
        $remote = $channel->getRemoteBalance();
        $commitfee = $channel->getCommitFee();
        $total = $channel->getCapacity();
        $localperc = (100/$total)*$local;
        $pubkey = $channel->getRemotePubkey();
        $channelid = $channel->getChanId();

        if ( !file_exists(ChannelFormatter::$channeltemplate) ) {
            return '';
        }

        // buffer the output (including the file is "output")
        ob_start();
        include ChannelFormatter::$channeltemplate;
        return ob_get_clean();
    }
    public static function formatPendingChannel(PendingChannel $channel){

        $local = $channel->getLocalBalance();
        $remote = $channel->getRemoteBalance();
        $total = $channel->getCapacity();
        $localperc = (100/$total)*$local;
        $pubkey = $channel->getRemoteNodePub();
        $channelpoint = $channel->getChannelPoint();



        if ( !file_exists(ChannelFormatter::$pendingchanneltemplate) ) {
            return '';
        }

        // buffer the output (including the file is "output")
        ob_start();
        include ChannelFormatter::$pendingchanneltemplate;
        return ob_get_clean();
    }
}