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
    public function createPayment(Payment $payment);

    public function checkPayment(Payment $payment) : bool ;

    public function updatePayment();
}