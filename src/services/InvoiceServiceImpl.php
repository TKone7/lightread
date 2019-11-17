<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:59
 */

namespace services;


use domain\InvStatus;
use domain\Payment;
use Lnrpc\Invoice;
use \Lnrpc\PaymentHash;
use Lnrpc\PayReq;
use Lnrpc\PayReqString;
use rpcclient\RpcClient;

class InvoiceServiceImpl implements InvoiceService
{
    private static $instance = NULL;

    protected function __construct()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function createPayment(Payment $payment)
    {
        $client = RpcClient::connect();
        $ln_inv = new Invoice(['memo' => $payment->getMemo(), 'value' => $payment->getValue()]);
        list($reply, $status) = $client->AddInvoice($ln_inv)->wait();

        $payment->setPayReq($reply->getPaymentRequest());
        $rhash_hex = bin2hex($reply->getRHash());
        $payment->setRhash($rhash_hex);


        $reply = $this->lookupInvoice($payment->getRhash());

        $payment->setCreationDate($reply->getCreationDate());
        $payment->setExpiry($reply->getExpiry());
        $payment->setSettleDate($reply->getSettleDate());
        $s = Invoice\InvoiceState::name($reply->getState());
        $payment->setStatus(InvStatus::$s());
        return $payment;
    }

    public function checkPayment(Payment $payment) :bool
    {
        $reply = $this->lookupInvoice($payment->getRhash());
        $s = Invoice\InvoiceState::name($reply->getState());
        return (InvStatus::$s() == InvStatus::SETTLED());
    }

    public function updatePayment()
    {
        // TODO: Implement updatePayment() method.
    }
    public function lookupInvoice($r_hash)
    {
        $client = RpcClient::connect();
        $ph = new PaymentHash(['r_hash_str' => $r_hash]);
        list($reply, $status) = $client->LookupInvoice($ph)->wait();
        return $reply;
    }
    public function decodePayReq($pay_req) : PayReq
    {
        $client = RpcClient::connect();
        $prs = new PayReqString(['pay_req' => $pay_req]);
        list($reply, $status) = $client->DecodePayReq($prs)->wait();
        return $reply;
    }
}