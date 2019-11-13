<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\User;

isset($this->user) ? $user = $this->user : $user = new User();
?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <h1>Welcome <?php echo $user->getFirstname() ?></h1>
            <h3 class="profile-title">Your profile</h3>
            <div>
                <span class="earning-title">Name</span>
                <label class="earning-value"><?php echo $user->getFirstname() . " " . $user->getLastname() ?></label>
                <span class="earning-title">Nickname</span>
                <label class="earning-value"><?php echo $user->getUsername() ?></label>
                <span class="earning-title">E-Mail</span>
                <label class="earning-value"><?php echo $user->getEmail() ?></label>
            </div>
            <div
                    class="text-center clearfix"><button class="btn btn-primary" type="submit" value="submit">Edit profile / Change password</button></div>
            <h3 class="profile-title">Your articles -&nbsp;<a href="editor.html"><i class="icon ion-android-add-circle"></i></a></h3><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                <tr>
                    <td><a href="post.html">Man must explore, and this ...</a></td>
                    <td>Published</td>
                    <td>41</td>
                    <td>12 000 sats</td>
                    <td>2011/04/25</td>
                </tr>
                <tr>
                    <td><a href="post-1.html">I believe every human has a finite numb...</a></td>
                    <td>Published</td>
                    <td>2</td>
                    <td>45 sats</td>
                    <td>2011/07/25</td>
                </tr>
                <tr>
                    <td><a href="#">Some article</a></td>
                    <td>Draft</td>
                    <td>0</td>
                    <td>0</td>
                    <td>-</td>
                </tr>
                </tbody>
            </table>
            <h3 class="profile-title">Your earnings</h3>
            <p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                make a type specimen book.</p>
            <div>
                <hr class="earning-hr"><span class="earning-title">Earnings from donations</span><label class="earning-value">2 000 sats</label><span class="earning-title">Earnings from purchases</span><label class="earning-value">45 456 sats</label>
                <hr class="earning-hr"><span class="earning-title">Total earning</span><label class="earning-value">47 456 sats</label><span class="earning-title">Total earning USD ($9,263.59 / BTC)</span><label class="earning-value">4.39 USD</label>
                <hr class="earning-hr"><span class="earning-title">Withdrawals</span><label class="earning-value">- 10 000 sats</label>
                <hr class="earning-hr"><span class="earning-title">Current balance</span><label class="earning-value">37 456 sats</label><span class="earning-title">Current balance USD ($9,263.59 / BTC)</span><label class="earning-value">3.47 USD</label>
                <hr class="earning-hr">
            </div>
            <div class="text-center clearfix"><button class="btn btn-primary" type="button">Transaction Details</button><button class="btn btn-primary" type="button" style="margin-left:10px">Withdraw to your wallet&nbsp;<i class="fa fa-arrow-circle-o-down" style="font-size: 20px;vertical-align: middle;"></i></button></div>
        </div>
    </div>
</div>


