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
?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <h1>Transaction overview</h1>
            <h3 class="profile-title">Balance history</h3>

            <div class="divTable greyGridTable">
                <div class="divTableHeading">
                    <div class="divTableRow">
                        <div class="divTableHead">Date</div>
                        <div class="divTableHead">Time</div>
                        <div class="divTableHead">Description</div>
                        <div class="divTableHead">Type</div>
                        <div class="divTableHead" style="text-align:right">Amount</div>
                    </div>
                </div>
                <div class="divTableBody">
                    <?php $txs = $user->getBalanceHistory();
                    usort($txs, function($a, $b) {
                        if ($b->getSettleDate() == $a->getSettleDate()) {
                            return 0;
                        }

                        return $b->getSettleDate() > $a->getSettleDate() ? -1 : 1;
                    });
                    foreach ($txs as $tx) { ?>
                        <div class="divTableRow">
                            <div class="divTableCell"><?php echo $tx->getSettleDate()->format('Y-m-d'); ?></div>
                            <div class="divTableCell"><?php echo $tx->getSettleDate()->format('H:i'); ?></div>
                            <div class="divTableCell">
                                <?php
                                if($tx->getPurpose() == Purpose::READ() OR $tx->getPurpose() == Purpose::DONATION()){
                                    echo $tx->getContent()->getTitle();
                                }elseif ($tx->getPurpose() == Purpose::WITHDRAWAL()){
                                    echo $tx->getMemo();
                                }

                                ?>
                            </div>
                            <div class="divTableCell"><?php echo $tx->getPurpose()->getValue(); ?></div>
                            <div class="divTableCell" style="text-align:right"><?php echo ($tx->getPurpose() == Purpose::WITHDRAWAL())?'-':'+'; echo $tx->getValue(); ?> sats</div>

                        </div>

                    <?php } ?>
                    <div class="divTableRow">
                        <div class="divTableCell">Current balance</div>
                        <div class="divTableCell"></div>
                        <div class="divTableCell"></div>
                        <div class="divTableCell"></div>
                        <div class="divTableCell" style="text-align:right"><?php echo $user->getBalance(); ?> sats</div>

                    </div>

                </div>
            </div>
            <h3 class="profile-title">Purchase history</h3>

            <div class="divTable greyGridTable">
                <div class="divTableHeading">
                    <div class="divTableRow">
                        <div class="divTableHead">Date</div>
                        <div class="divTableHead">Time</div>
                        <div class="divTableHead">Article</div>
                        <div class="divTableHead">Type</div>
                        <div class="divTableHead" style="text-align:right">Amount</div>
                    </div>
                </div>
                <div class="divTableBody">
                    <?php $txs = $user->getPurchaseHistory();
                    usort($txs, function($a, $b) {
                        if ($b->getSettleDate() == $a->getSettleDate()) {
                            return 0;
                        }

                        return $b->getSettleDate() > $a->getSettleDate() ? -1 : 1;
                    });
                    foreach ($txs as $tx) { ?>
                        <div class="divTableRow">
                            <div class="divTableCell"><?php echo $tx->getSettleDate()->format('Y-m-d'); ?></div>
                            <div class="divTableCell"><?php echo $tx->getSettleDate()->format('H:i'); ?></div>
                            <div class="divTableCell">
                                <?php echo $tx->getContent()->getTitle(); ?>
                            </div>
                            <div class="divTableCell"><?php echo $tx->getPurpose()->getValue(); ?></div>
                            <div class="divTableCell" style="text-align:right"><?php echo ($tx->getPurpose() == Purpose::WITHDRAWAL())?'+':'-'; echo $tx->getValue(); ?> sats</div>

                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>


