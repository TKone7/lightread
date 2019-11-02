<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 01.11.19
 * Time: 10:55
 */

use Lnrpc\GetInfoResponse;
use view\TemplateView;
use view\ChannelFormatter;
$connected = isset($this->getinforesponse);
isset($this->getinforesponse) ? $getinforesponse = $this->getinforesponse : $getinforesponse = new Lnrpc\GetInfoResponse();
isset($this->walletbalance) ? $walletbalance = $this->walletbalance : $walletbalance = new Lnrpc\WalletBalanceResponse();
isset($this->channelbalance) ? $channelbalance = $this->channelbalance : $channelbalance = new Lnrpc\ChannelBalanceResponse();
isset($this->ListChannelsResp) ? $ListChannelsResp = $this->ListChannelsResp : $ListChannelsResp = new Lnrpc\ListChannelsResponse();
isset($this->PendingChannelsResp) ? $PendingChannelsResp = $this->PendingChannelsResp : $PendingChannelsResp = new Lnrpc\PendingChannelsResponse();
// echo $getinforesponse->getIdentityPubkey();

?>

<div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div>
                    <hr class="earning-hr">
                    <span class="earning-title" style="float: none;font-weight: bold;">Node Info</span>
                    <span class="earning-title">Status</span><label class="earning-value"><?php echo $connected ? "Online" : "not connected" ?></label>
                    <span class="earning-title">Alias</span><label class="earning-value"><?php echo $getinforesponse->getAlias(); ?></label>
                    <span
                        class="earning-title">Pub-Key</span><label class="earning-value"><?php echo $getinforesponse->getIdentityPubkey(); ?></label>
                    <span class="earning-title">LND versoin</span><label class="earning-value">
                        <?php
                        $version = $getinforesponse->getVersion();
                        $end = strpos($version, "commit");
                        echo substr($version, 0, $end); ?>
                    </label>
                    <span class="earning-title">Chain</span><label class="earning-value">
                        <?php $chain_array = $getinforesponse->getChains();
                        $itr = $chain_array->getIterator();

                        // Use iterator to traverse Array
                        $itr->rewind();
                        while($itr->valid()) {
                            echo $itr->current()->getChain().' - '.$itr->current()->getNetwork() ."\n";
                            $itr->next();
                        }
                        ?>
                    </label>
                    <span class="earning-title">Block height</span><label class="earning-value"><?php echo $getinforesponse->getBlockHeight(); ?></label>
                            <hr class="earning-hr"><span class="earning-title" style="float: none;font-weight: bold;">Balance</span>
                    <span class="earning-title">Total wallet balance</span><label class="earning-value"><?php echo number_format($walletbalance->getTotalBalance(), 0, "." , " ") ; ?> sats</label>
                    <span class="earning-title">Total channel balance</span>  <label class="earning-value"><?php echo number_format($channelbalance->getBalance(), 0, "." , " " ); ?> sats</label>
                    <?php if ($channelbalance->getPendingOpenBalance()>0): ?>
                        <label class="earning-value">(pending <?php echo $channelbalance->getPendingOpenBalance(); ?> sats)</label>
                    <?php endif;?>
                    <hr class="earning-hr"><span class="earning-title">Total balance</span><label class="earning-value"><?php echo number_format($channelbalance->getBalance() + $walletbalance->getTotalBalance(), 0, "." , " " ); ?> sats</label>
                                <hr class="earning-hr">
                </div>
                <span class="earning-title" style="float: none;font-weight: bold;">Channels</span>

                <span class="earning-title">Pending channels</span><label class="earning-value"><?php echo $getinforesponse->getNumPendingChannels(); ?></label>
                <span class="earning-title">Active channels</span><label class="earning-value"><?php echo $getinforesponse->getNumActiveChannels(); ?></label>
                <span class="earning-title">Inactive channels</span><label class="earning-value"><?php echo $getinforesponse->getNumInactiveChannels(); ?></label>
                    <hr class="earning-hr">
                <span class="earning-title">Total channels</span><label class="earning-value"><?php echo $getinforesponse->getNumPendingChannels() + $getinforesponse->getNumActiveChannels() +$getinforesponse->getNumInactiveChannels(); ?></label>

                <span class="earning-title" style="float: none;font-weight: normal;">Active</span>
                <?php
                $ChannelList = $ListChannelsResp->getChannels();
                $itr = $ChannelList->getIterator();
                // Use iterator to traverse Array
                $itr->rewind();
                $output = '';
                while($itr->valid()) {
                    if ($itr->current()->getActive()):
                        $output.= ChannelFormatter::formatChannel($itr->current());
                    endif;
                    $itr->next();
                }
                echo $output;
                ?>
                <hr class="earning-hr">
                <span class="earning-title" style="float: none;font-weight: normal;">Inactive</span>
                <?php
                // Reset iterator to loop again
                $itr->rewind();
                $output = '';
                while($itr->valid()) {
                    if (!($itr->current()->getActive())):
                        $output.= ChannelFormatter::formatChannel($itr->current());
                    endif;
                    $itr->next();
                }
                echo $output;
                ?>

                <?php
                $PendingOpen = $PendingChannelsResp->getPendingOpenChannels();
                if (count($PendingOpen)>0):
                ?>
                    <hr class="earning-hr">
                    <span class="earning-title" style="float: none;font-weight: normal;">Pending open</span>
                <?php
                endif;
                $itr = $PendingOpen->getIterator();
                // Use iterator to traverse Array
                $itr->rewind();
                $output = '';
                while($itr->valid()) {
                    $output.= ChannelFormatter::formatPendingChannel($itr->current()->getChannel());
                    $itr->next();
                }
                echo $output;

                $WaitingClose = $PendingChannelsResp->getWaitingCloseChannels();
                if (count($WaitingClose)>0):
                    ?>
                    <hr class="earning-hr">
                    <span class="earning-title" style="float: none;font-weight: normal;">Waiting close</span>
                <?php
                endif;
                $itr = $WaitingClose->getIterator();

                // Use iterator to traverse Array
                $itr->rewind();
                $output = '';
                while($itr->valid()) {
                    $output.= ChannelFormatter::formatPendingChannel($itr->current()->getChannel());
                    $itr->next();
                }
                echo $output;
                ?>
            </div>
        </div>
</div>