<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:16
 */

namespace services;


use domain\Content;
use domain\Payment;
use domain\User;
use domain\Withdrawal;
use Lnrpc\PayReq;

interface InvoiceService
{
    public function createPayment(Payment $payment) : Payment;

    public function createWithdrawal(Withdrawal $withdrawal) : Withdrawal;

    public function payOut(Withdrawal $withdrawal):array ;

    public function checkPayment($pay_req) : bool;

    public function getUpdateFromNode(Payment $payment) : Payment;

    public function lookupInvoice($r_hash);

    public function decodePayReq($pay_req) :PayReq;

    public function userPaidContent(User $user, Content $content): bool;


    public function updatePayment(Payment $payment) : Payment;
    public function updateWithdrawal(Withdrawal $withdrawal) : Withdrawal;
}