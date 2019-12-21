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
use services\MarketDataServiceImpl;
use validator\UserValidator;

isset($this->user) ? $user = $this->user : $user = new User();
isset($this->mgr) ? $mgr = $this->mgr : $mgr = new ContentManager();
(isset($this->userValidator)) ? $userValidator = $this->userValidator : $userValidator = new UserValidator();
?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <h1>Welcome <?php echo $user->getFirstname() ?></h1>
            <?php if($userValidator->isUserVerifiedWarning()): ?>
                <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $userValidator->getUserVerifiedWarning() ?>
                </div>
            <?php endif; ?>

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
                <a id="edit" class="btn btn-primary" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/edit-profile">Edit profile / Change password</a>
                <a id="logout" class="btn btn-light" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/logout">Logout</a>
            </div>
            <h3 class="profile-title">Your articles -&nbsp;<a href="<?php echo $GLOBALS["ROOT_URL"]; ?>/new"><i class="icon ion-android-add-circle"></i></a></h3><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                    <td>

                        <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/edit">
                            <div style="margin: 0px;">
                                <input type="hidden" name="cont_id" value="<?php echo $item->getId(); ?>">
                                <input type="submit" value="<?php echo $item->getTitle(); ?>" style="background: none; border: none; text-decoration: underline; cursor: pointer;">
                            </div>
                        </form>
                    </td>
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

            <div>
                <hr class="earning-hr"><span class="earning-title">Earnings from donations</span>
                <label class="earning-value"><?php echo $user->getTurnover(Purpose::DONATION()); ?> sats</label>
                <span class="earning-title">Earnings from purchases</span>
                <label class="earning-value"><?php echo $user->getTurnover(Purpose::READ()); ?> sats</label>
                <hr class="earning-hr"><span class="earning-title">Total earning</span>
                <label class="earning-value"><?php echo $user->getTurnover(); ?> sats</label>
                <span class="earning-title">Total earning USD (<?php echo floor(MarketDataServiceImpl::getInstance()->getPrice()); ?> / BTC)</span>
                <label class="earning-value"><?php echo MarketDataServiceImpl::getInstance()->convertSatToUsdFormat($user->getTurnover()); ?></label>
                <hr class="earning-hr"><span class="earning-title">Withdrawals</span><label class="earning-value">- <?php echo $user->getWithdrawal(); ?> sats</label>
                <hr class="earning-hr"><span class="earning-title">Current balance</span><label class="earning-value"><?php echo $user->getBalance(); ?> sats</label>
                <span class="earning-title">Current balance USD (<?php echo floor(MarketDataServiceImpl::getInstance()->getPrice()); ?> / BTC)</span>
                <label class="earning-value"><?php echo MarketDataServiceImpl::getInstance()->convertSatToUsdFormat($user->getBalance()); ?></label>
                <hr class="earning-hr">
            </div>
            <div class="text-center clearfix"><button class="btn btn-primary" onclick="window.location.href='<?php echo $GLOBALS["ROOT_URL"]; ?>/transactions'" type="button">Transaction Details</button><button class="btn btn-primary" type="button" style="margin-left:10px"  onclick="window.location.href='<?php echo $GLOBALS["ROOT_URL"]; ?>/withdraw'">Withdraw to your wallet&nbsp;<i class="fa fa-arrow-circle-o-down" style="font-size: 20px;vertical-align: middle;"></i></button></div>
        </div>
    </div>
</div>


