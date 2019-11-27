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
use dao\WithdrawalDAO;
use domain\Content;
use domain\InvStatus;
use domain\Payment;
use domain\Purpose;
use domain\User;
use domain\Withdrawal;
use Google\Protobuf\Enum;
use Lnrpc\Invoice;
use Lnrpc\Invoice_InvoiceState;
use \Lnrpc\PaymentHash;
use Lnrpc\PayReq;
use Lnrpc\PayReqString;
use Lnrpc\SendRequest;
use rpcclient\RpcClient;
use DateTime;
use validator\WithdrawalValidator;

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
        $ln_inv = new Invoice();
        $ln_inv->setMemo($payment->getMemo());
        $ln_inv->setValue($payment->getValue());
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
    public function createLnUrlRequest(Withdrawal $withdrawal) : Withdrawal
    {

    }
    public function createWithdrawal(Withdrawal $withdrawal) : Withdrawal
    {
        $pay_req = $this->decodePayReq($withdrawal->getPayReq());
        $withdrawal->setValue($pay_req->getNumSatoshis());
        $withdrawal->setMemo($pay_req->getDescription());
        $withdrawal->setRhash($pay_req->getPaymentHash());
        $withdrawal->setExpiry($pay_req->getExpiry());
        $withdrawal->setPurpose(Purpose::WITHDRAWAL());
        $withdrawal->setStatus(InvStatus::OPEN());
        $withdrawal->setCreationDate((new DateTime('@' .$pay_req->getTimestamp()))->setTimezone(new \DateTimeZone(date_default_timezone_get())));

        $withdrw_dao = new WithdrawalDAO();
        $existing = $withdrw_dao->findByPayReq($withdrawal->getPayReq());
        if (empty($existing)){
            $withdrawal = $withdrw_dao->create($withdrawal);
        }else{
            $withdrawal = $existing;
        }



        return $withdrawal;
    }

    public function payOut(Withdrawal $withdrawal):array
    {
        // check if balance is sufficient
        if($withdrawal->getValue() > $withdrawal->getReceiver()->getBalance()){
            return array('result' => false, 'msg' => '');
        }

        // try payout
        $client = RpcClient::connect();
        $send_req = new SendRequest();
        $send_req->setPaymentRequest($withdrawal->getPayReq());
        list($result, $status) = $client->SendPaymentSync($send_req)->wait();
        if(!empty($status->details)){
            $error = $status->details;
        }elseif (!empty($result->getPaymentError())){
            $error = $result->getPaymentError();
        }
        if(!isset($error))
        {
            $withdrawal->setStatus(InvStatus::SETTLED());
            $withdrawal->setSettleDate((new DateTime(now))->setTimezone(new \DateTimeZone(date_default_timezone_get())));
            (new WithdrawalDAO())->update($withdrawal);
            return array('result' => true, 'msg' => 'successfully payed');
        }
        return array('result' => false, 'msg' => $error);
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
        $s = $reply->getState();

        //@todo ugly but not possible because of open issue https://github.com/grpc/grpc/issues/21081
        switch ($s){
            case Invoice_InvoiceState::OPEN: {
                $payment->setStatus(InvStatus::OPEN());
                break;
            }
            case Invoice_InvoiceState::SETTLED: {
                $payment->setStatus(InvStatus::SETTLED());
                break;
            }
            case Invoice_InvoiceState::CANCELED: {
                $payment->setStatus(InvStatus::CANCELED());
                break;
            }
            case Invoice_InvoiceState::ACCEPTED: {
                $payment->setStatus(InvStatus::ACCEPTED());
                break;
            }
        }


        if($reply->getSettleDate()>0){
            $settl_date = (new DateTime('@' .$reply->getSettleDate()))->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        }else{
            $settl_date = NULL;
        }
        if($reply->getCreationDate()>0){
            $creation_date = (new DateTime('@' .$reply->getCreationDate()))->setTimezone(new \DateTimeZone(date_default_timezone_get()));
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
    public function updateWithdrawal(Withdrawal $withdrawal) : Withdrawal
    {
        $wdrw_dao = new WithdrawalDAO();
        $updated_wdrw = $wdrw_dao->update($withdrawal);
        return $updated_wdrw;
    }
    public function lookupInvoice($r_hash)
    {
        $client = RpcClient::connect();
        $ph = new PaymentHash();
        $ph->setRHashStr($r_hash);
        list($reply, $status) = $client->LookupInvoice($ph)->wait();
        return $reply;
    }
    public function decodePayReq($pay_req):PayReq
    {
        $client = RpcClient::connect();
        $payreqstr = new PayReqString();
        $payreqstr->setPayReq($pay_req);
        list($dec_pay_req, $status) = $client->DecodePayReq($payreqstr)->wait();
        return $dec_pay_req ?? new PayReq();

    }
    public function userPaidContent(User $user, Content $content): bool
    {
        $pay_dao = new PaymentDAO();
        return $pay_dao->paymentExists($user,$content);

    }

}