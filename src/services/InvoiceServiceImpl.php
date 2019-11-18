<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:59
 */

namespace services;


use dao\ContentDAO;
use dao\PaymentDAO;
use domain\Content;
use domain\InvStatus;
use domain\Payment;
use domain\User;
use Lnrpc\Invoice;
use \Lnrpc\PaymentHash;
use Lnrpc\PayReq;
use Lnrpc\PayReqString;
use rpcclient\RpcClient;
use DateTime;

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

    public function createPayment(Payment $payment) : Payment
    {
        $client = RpcClient::connect();
        $ln_inv = new Invoice(['memo' => $payment->getMemo(), 'value' => $payment->getValue()]);
        list($reply, $status) = $client->AddInvoice($ln_inv)->wait();

        // set payment request from AddInvoice Response
        $payment->setPayReq($reply->getPaymentRequest());
        $rhash_hex = bin2hex($reply->getRHash());
        // set payment hash from AddInvoice Response
        $payment->setRhash($rhash_hex);

        // get additional information from generated invoice
        $payment = $this->getUpdateFromNode($payment);

        $pay_dao = new PaymentDAO();
        $payment = $pay_dao->create($payment);
        return $payment;
    }

    public function checkPayment($pay_req) :bool
    {
        $pay_dao = new PaymentDAO();
        $payment = $pay_dao->findByPayReq($pay_req);
        $payment = $this->getUpdateFromNode($payment);
        //@todo check if payment objects are different and only perform update if so
        $this->updatePayment($payment);
        return ($payment->getStatus() == InvStatus::SETTLED());
    }

    public function getUpdateFromNode(Payment $payment) : Payment
    {
        $reply = $this->lookupInvoice($payment->getRhash());
        $payment->setExpiry($reply->getExpiry());
        $s = Invoice\InvoiceState::name($reply->getState());
        $payment->setStatus(InvStatus::$s());

        if($reply->getSettleDate()>0){
            $settl_date = new DateTime();
            $settl_date->setTimestamp($reply->getSettleDate());
        }else{
            $settl_date = NULL;
        }
        if($reply->getCreationDate()>0){
            $creation_date = new DateTime();
            $creation_date->setTimestamp($reply->getCreationDate());
        }else{
            $creation_date = NULL;
        }
        $payment->setSettleDate($settl_date);
        $payment->setCreationDate($creation_date);
        return $payment;
    }
    public function updatePayment(Payment $payment) : Payment
    {
        $pay_dao = new PaymentDAO();
        $updated_payment = $pay_dao->update($payment);
        return $updated_payment;
    }
    public function lookupInvoice($r_hash)
    {
        $client = RpcClient::connect();
        $ph = new PaymentHash(['r_hash_str' => $r_hash]);
        list($reply, $status) = $client->LookupInvoice($ph)->wait();
        return $reply;
    }
    public function userPaidContent(User $user, Content $content): bool
    {
        $pay_dao = new PaymentDAO();
        return $pay_dao->paymentExists($user,$content);

    }

}