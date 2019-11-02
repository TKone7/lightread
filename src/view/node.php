<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 01.11.19
 * Time: 10:55
 */

use Lnrpc\GetInfoResponse;
use view\TemplateView;
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
                    <span class="earning-title">Total wallet balance</span><label class="earning-value"><?php echo $walletbalance->getTotalBalance(); ?> sats</label>
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
                while($itr->valid()) {

                    if ($itr->current()->getActive()):
                        $local = $itr->current()->getLocalBalance();
                        $total = $itr->current()->getCapacity();
                        $localperc = (100/$total)*$local;
                        ?>
                        <span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">
                        Channel Partner:&nbsp;<?php echo $itr->current()->getRemotePubkey(); ?><br>
                        Channel-ID:&nbsp;<?php echo $itr->current()->getChanId(); ?> <br>
                        Capacity: <?php echo $total; ?> sats (l:&nbsp;<?php echo $local; ?> | r:&nbsp;<?php echo $itr->current()->getRemoteBalance(); ?> | c:&nbsp;<?php echo $itr->current()->getCommitFee(); ?>)
                        </span>

                        <div class="progress" style="height: 22px;">
                            <div class="progress-bar" aria-valuenow="<?php echo $localperc; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $localperc; ?>%;"><?php echo $localperc; ?>%</div>
                        </div>
                    <?php endif; ?>
                <?php $itr->next();} ?>

                <span class="earning-title" style="float: none;font-weight: normal;">Inactive</span>
                <?php
                // Reset iterator to loop again
                $itr->rewind();
                while($itr->valid()) {
                if (!($itr->current()->getActive())):
                $local = $itr->current()->getLocalBalance();
                $total = $itr->current()->getCapacity();
                $localperc = (100/$total)*$local;
                ?>
                <span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">
                        Channel Partner:&nbsp;<?php echo $itr->current()->getRemotePubkey(); ?><br>
                        Channel-ID:&nbsp;<?php echo $itr->current()->getChanId(); ?> <br>
                        Capacity: <?php echo $total; ?> sats (l:&nbsp;<?php echo $local; ?> | r:&nbsp;<?php echo $itr->current()->getRemoteBalance(); ?> | c:&nbsp;<?php echo $itr->current()->getCommitFee(); ?>)
                        </span>

                <div class="progress" style="height: 22px;">
                    <div class="progress-bar" aria-valuenow="<?php echo $localperc; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $localperc; ?>%;"><?php echo $localperc; ?>%</div>
                </div>
                <?php endif; ?>
                <?php $itr->next();} ?>


                <span class="earning-title" style="float: none;font-weight: normal;">Pending</span>
                <?php
                $PendingOpen = $PendingChannelsResp->getPendingOpenChannels();

                $itr = $PendingOpen->getIterator();

                // Use iterator to traverse Array
                $itr->rewind();
                while($itr->valid()) {
                        $local = $itr->current()->getChannel()->getLocalBalance();
                        $total = $itr->current()->getChannel()->getCapacity();
                        $localperc = (100/$total)*$local;
                        ?>
                        <span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">
                        Channel Partner:&nbsp;<?php echo $itr->current()->getChannel()->getRemoteNodePub(); ?><br>
                        Channel-ID:&nbsp;123 <br>
                        Capacity: <?php echo $total; ?> sats (l:&nbsp;<?php echo $local; ?> | r:&nbsp;<?php echo $itr->current()->getChannel()->getRemoteBalance(); ?> | c:&nbsp;?)
                        </span>

                        <div class="progress" style="height: 22px;">
                            <div class="progress-bar" aria-valuenow="<?php echo $localperc; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $localperc; ?>%;"><?php echo $localperc; ?>%</div>
                        </div>
                    <?php $itr->next();} ?>
            </div>
        </div>
</div>