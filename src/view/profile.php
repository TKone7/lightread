<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\Access;
use domain\ContentManager;
use domain\Purpose;
use domain\User;
use Google\Protobuf\NullValue;
use services\MarketDataServiceImpl;

isset($this->user) ? $user = $this->user : $user = new User();
isset($this->mgr) ? $mgr = $this->mgr : $mgr = new ContentManager();
?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <h1>Welcome <?php echo $user->getFirstname() ?></h1>
            <h3 class="profile-title">Your profile</h3>
            <div>
                <span class="earning-title">Name</span>
                <label class="earning-value"><?php echo $user->getFullName() ?></label>
                <span class="earning-title">Nickname</span>
                <label class="earning-value"><?php echo $user->getUsername() ?></label>
                <span class="earning-title">E-Mail</span>
                <label class="earning-value"><?php echo $user->getEmail() ?></label>
            </div>
            <div
                    class="text-center clearfix">
                <button class="btn btn-primary" onclick="window.location.href='<?php echo $GLOBALS["ROOT_URL"]; ?>/edit-profile'">Edit profile / Change password</button>
                <button class="btn btn-light" onclick="window.location.href='<?php echo $GLOBALS["ROOT_URL"]; ?>/logout'">Logout</button>
            </div>
            <h3 class="profile-title">Your articles -&nbsp;<a href="<?php echo $GLOBALS["ROOT_URL"]; ?>/edit"><i class="icon ion-android-add-circle"></i></a></h3><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th style="width:20%">Title</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Turnover</th>
                    <th>Published</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $articles=$mgr->getContent();
                foreach ($articles as $item) { ?>

                    <tr>
                    <td><a href="<?php echo $GLOBALS["ROOT_URL"] . "/edit?id=" . $item->getId(); ?>"><?php echo $item->getTitle(); ?></a></td>
                    <td><?php echo $item->getStatus()->getValue(); ?></td>
                    <td>-</td>
                    <td><?php echo $item->getRevenue(); ?> sats</td>
                    <td><?php echo $item->getCreationDate()->format('d/m/Y'); ?></td>
                    </tr>

                    <?php
                }

                if(sizeof($articles)==0): ?>
                    <tr>
                        <td>No Articles</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><b>Total</b></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $mgr->getRevenue(); ?> sats</td>
                        <td></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <h3 class="profile-title">Your earnings</h3>
            <p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                make a type specimen book.</p>
            <div>
                <hr class="earning-hr"><span class="earning-title">Earnings from donations</span>
                <label class="earning-value"><?php echo $user->getTurnover(Purpose::DONATION()); ?> sats</label>
                <span class="earning-title">Earnings from purchases</span>
                <label class="earning-value"><?php echo $user->getTurnover(Purpose::READ()); ?> sats</label>
                <hr class="earning-hr"><span class="earning-title">Total earning</span>
                <label class="earning-value"><?php echo $user->getTurnover(); ?> sats</label>
                <span class="earning-title">Total earning USD (<?php echo MarketDataServiceImpl::getInstance()->getPrice(); ?> / BTC)</span><label class="earning-value"><?php $to_usd = MarketDataServiceImpl::getInstance()->convertSatToUsd($user->getTurnover()); echo $to_usd['value'] . ' ' . $to_usd['unit']; ?></label>
                <hr class="earning-hr"><span class="earning-title">Withdrawals</span><label class="earning-value">- 10 000 sats</label>
                <hr class="earning-hr"><span class="earning-title">Current balance</span><label class="earning-value">37 456 sats</label><span class="earning-title">Current balance USD ($9,263.59 / BTC)</span><label class="earning-value">3.47 USD</label>
                <hr class="earning-hr">
            </div>
            <div class="text-center clearfix"><button class="btn btn-primary" type="button">Transaction Details</button><button class="btn btn-primary" type="button" style="margin-left:10px">Withdraw to your wallet&nbsp;<i class="fa fa-arrow-circle-o-down" style="font-size: 20px;vertical-align: middle;"></i></button></div>
        </div>
    </div>
</div>


