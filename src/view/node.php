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
                        while($itr->valid()) {
                            echo $itr->current()->getChain().' - '.$itr->current()->getNetwork() ."\n";
                            $itr->next();
                        }
                        ?>
                    </label>
                    <span class="earning-title">Block height</span><label class="earning-value"><?php echo $getinforesponse->getBlockHeight(); ?></label>
                            <hr class="earning-hr"><span class="earning-title" style="float: none;font-weight: bold;">Balance</span>
                    <span class="earning-title">Total wallet balance</span><label class="earning-value">47 456 sats</label>
                    <span class="earning-title">Total channel balance</span>  <label class="earning-value">47 456 sats</label>
                                <hr class="earning-hr"><span class="earning-title">Total balance</span>
                    <label class="earning-value">120 234 sats</label>
                                <hr class="earning-hr">
                </div>
                <span class="earning-title" style="float: none;font-weight: bold;">Channels</span>
                <span class="earning-title">Pending channels</span><label class="earning-value"><?php echo $getinforesponse->getNumPendingChannels(); ?></label>
                <span class="earning-title">Active channels</span><label class="earning-value"><?php echo $getinforesponse->getNumActiveChannels(); ?></label>
                <span class="earning-title">Inactive channels</span><label class="earning-value"><?php echo $getinforesponse->getNumInactiveChannels(); ?></label>
                    <hr class="earning-hr">
                <span class="earning-title">Total channels</span><label class="earning-value">15</label>
                <span class="earning-title" style="float: none;font-weight: normal;">Active</span><span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">Channel Partner:&nbsp;021607cfce19a4c5e7e6e738663dfafbbbac262e4ff76c2c9b30dbeefc35c00643<br>Channel-ID:&nbsp;2127554999812096<br>Capacity: 100000 sats (l:&nbsp;66257 | r:&nbsp;24692 | c:&nbsp;9051)</span>
                    <div
                        class="progress" style="height: 22px;">
                        <div class="progress-bar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
            </div><span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">Channel Partner:&nbsp;021607cfce19a4c5e7e6e738663dfafbbbac262e4ff76c2c9b30dbeefc35c00643<br>Channel-ID:&nbsp;2127554999812096<br>Capacity: 100000 sats (l:&nbsp;66257 | r:&nbsp;24692 | c:&nbsp;9051)</span>
            <div
                class="progress" style="height: 22px;">
                <div class="progress-bar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
        </div><span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">Channel Partner:&nbsp;021607cfce19a4c5e7e6e738663dfafbbbac262e4ff76c2c9b30dbeefc35c00643<br>Channel-ID:&nbsp;2127554999812096<br>Capacity: 100000 sats (l:&nbsp;66257 | r:&nbsp;24692 | c:&nbsp;9051)</span>
        <div
            class="progress" style="height: 22px;">
            <div class="progress-bar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
    </div><span class="earning-title" style="float: none;font-weight: normal;">Pending</span><span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">Channel Partner:&nbsp;021607cfce19a4c5e7e6e738663dfafbbbac262e4ff76c2c9b30dbeefc35c00643<br>Channel-ID:&nbsp;2127554999812096<br>Capacity: 100000 sats (l:&nbsp;66257 | r:&nbsp;24692 | c:&nbsp;9051)</span>
    <div
        class="progress progress-pending" style="height: 22px;">
        <div class="progress-bar progress-pending" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
        </div><span class="earning-title" style="float: none;font-weight: normal;">Inactive</span><span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">Channel Partner:&nbsp;021607cfce19a4c5e7e6e738663dfafbbbac262e4ff76c2c9b30dbeefc35c00643<br>Channel-ID:&nbsp;2127554999812096<br>Capacity: 100000 sats (l:&nbsp;66257 | r:&nbsp;24692 | c:&nbsp;9051)</span>
        <div
            class="progress progress-pending" style="height: 22px;">
            <div class="progress-bar progress-pending" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
            </div>
            </div>
            </div>
            </div>