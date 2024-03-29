<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 02.11.19
 * Time: 11:33
 */

isset($this->channel) ? $channel = $this->channel : $channel = new Lnrpc\Channel();

$local = $channel->getLocalBalance();
$remote = $channel->getRemoteBalance();
$commitfee = $channel->getCommitFee();
$total = $channel->getCapacity();
$localperc = (100/$total)*$local;
$pubkey = $channel->getRemotePubkey();
$channelid = $channel->getChanId();
?>

<span class="earning-title" style="float: none;font-weight: normal;font-size: 15px;">
    Channel Partner:&nbsp;<?php echo $pubkey; ?><br>
    Channel-ID:&nbsp;<?php echo $channelid; ?> <br>
    Capacity: <?php echo $total; ?> sats (l:&nbsp;<?php echo $local; ?> | r:&nbsp;<?php echo $remote; ?> | c:&nbsp;<?php echo $commitfee; ?>)
</span>

<div class="progress" style="height: 22px;">
    <div class="progress-bar" aria-valuenow="<?php echo $localperc; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $localperc; ?>%;"><?php echo floor($localperc); ?>%</div>
</div>