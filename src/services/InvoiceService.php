<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:16
 */

namespace services;


use domain\Payment;

interface InvoiceService
{
    public function createPayment(Payment $payment) : Payment;

    public function checkPayment($pay_req) : bool;

    public function getUpdateFromNode(Payment $payment) : Payment;

    public function lookupInvoice($r_hash);

    public function updatePayment(Payment $payment) : Payment;
}