<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 27.11.19
 * Time: 22:10
 */

namespace controller;


use dao\WithdrawalDAO;
use domain\InvStatus;
use domain\Purpose;
use domain\Withdrawal;
use services\AuthServiceImpl;
use services\InvoiceServiceImpl;
use validator\LnURLValidator;
use validator\WithdrawalValidator;

class WithdrawalController
{
    public static function withdraw()
    {
        if(isset($_POST['ajax'])){
            $withdrw = new Withdrawal();
            $withdrw->setReceiver(AuthServiceImpl::getInstance()->readUser());
            // if pay_req provided pay out normally
            if(isset($_POST['pay_req']) ) {
                self::withdrawPayReq($withdrw);;
            }
            // if amount provided check first and then start LNURL process
            elseif (isset($_POST['amount'])){
                self::withdrawLnUrl($withdrw);
            }
        }
    }
    private static function withdrawPayReq(Withdrawal $withdrw){
        // set the payment request
        $withdrw->setPayReq($_POST['pay_req']);
        // validate first
        // 1. invoice has correct format and can be decoded
        // 2. User has sufficient funds
        $wdrw_val = new WithdrawalValidator($withdrw);

        if($wdrw_val->isValid()){
            $withdrw = InvoiceServiceImpl::getInstance()->createWithdrawal($withdrw);
            $result = InvoiceServiceImpl::getInstance()->payOut($withdrw);
            $prc->result = $result['result'];
            $prc->memo = $withdrw->getMemo();
            $prc->amount = $withdrw->getValue();
            $prc->msg = $result['msg'];
        }else{
            $prc->result = false;
            $prc->msg .= $wdrw_val->isInvoiceFormatError() ? $wdrw_val->getInvoiceFormatError() : '';
            $prc->msg .= $wdrw_val->isInsufficientFunds() ? $wdrw_val->getInsufficientFunds() : '';
        }
        $myJSON = json_encode($prc);
        echo $myJSON;
        exit;
    }
    private static function withdrawLnUrl(Withdrawal $withdrw){
        // user wants to withdraw via lnurl
        $withdrw->setValue($_POST['amount']);
        // check if amount is ok
        $lnurl_validator = new LnURLValidator($withdrw);
        if(!$lnurl_validator->isValid()){
            $prc->result = false;
            $prc->msg .= $lnurl_validator->isInsufficientFunds() ? $lnurl_validator->getInsufficientFunds() : '';
            $myJSON = json_encode($prc);
            echo $myJSON;
            exit;
        }
        // creat url
        $lnurl = InvoiceServiceImpl::getInstance()->createLnUrl($withdrw);
        $prc->lnurl = strtoupper($lnurl);
        $prc->result = true;
        $myJSON = json_encode($prc);
        echo $myJSON;
        exit;
    }

    public static function lnUrlInfoRequest()
    {
        if(isset($_GET['challenge'])){
            $challenge = $_GET['challenge'];
            // check if challenge was previously issued
            $withdrw_dao = new WithdrawalDAO();
            $existing = $withdrw_dao->findByChallenge($challenge);
            if (!isset($existing) OR $existing->getStatus() == InvStatus::SETTLED()){
                $prc->status = 'ERROR';
                $prc->reason = 'this challenge was not issued or has already been paid out';
                $myJSON = json_encode($prc);
                echo $myJSON;
                exit;
            }
            $secret = bin2hex(openssl_random_pseudo_bytes(40));

            $existing->setLnurlSecret($secret);
            $withdrw_dao->update($existing);

            // answer to client
            $prc->callback = $GLOBALS["ROOT_URL"] . '/lnurl/withdraw';//string to send invoice to;
            $prc->k1 = $secret;
            $prc->maxWithdrawable = ($existing->getValue() *1000);//in msat
            $prc->defaultDescription = $existing->getMemo();
            $prc->minWithdrawable = 0;//in msat
            $prc->tag = "withdrawRequest";
            $myJSON = json_encode($prc);
            echo $myJSON;
            exit;
        }else{
            $prc->status = 'ERROR';
            $prc->reason = 'No challenge found.';
            $myJSON = json_encode($prc);
            echo $myJSON;
            exit;
        }
    }

    public static function lnUrlPaymentRequest(){
        if(isset($_GET['k1']) AND isset($_GET['pr'])){
            $k1 = $_GET['k1'];
            $pr = $_GET['pr'];
            // check secret k1
            $withdrw_dao = new WithdrawalDAO();
            $existing = $withdrw_dao->findBySecret($k1);
            if(isset($existing)){
                if($existing->getStatus() == InvStatus::SETTLED()){
                    $prc->status ="ERROR";
                    $prc->reason = "This LNURL has already been paid";
                    $myJSON = json_encode($prc);
                    echo $myJSON;
                    exit;
                }
                $pay_req = InvoiceServiceImpl::getInstance()->decodePayReq($pr);
                // check that the requested amount is not higher than offeren in stage before
                if($pay_req->getNumSatoshis() > $existing->getValue()){
                    $prc->status ="ERROR";
                    $prc->reason = "You requested an amount that is too high";
                    $myJSON = json_encode($prc);
                    echo $myJSON;
                    exit;
                }
                $existing->setRhash($pay_req->getPaymentHash());
                $existing->setValue($pay_req->getNumSatoshis());
                $existing->setExpiry($pay_req->getExpiry());
                $existing->setPayReq($pr);
                $result = InvoiceServiceImpl::getInstance()->payOut($existing);
                if($result['result']){
                    // payment went through
                    $prc->status ="OK";
                    $myJSON = json_encode($prc);
                    echo $myJSON;
                    exit;
                }else{
                    // paying invoice had error
                    $prc->status ="ERROR";
                    $prc->reason = $result['msg'];
                    $myJSON = json_encode($prc);
                    echo $myJSON;
                    exit;
                }

            }else{
                $prc->status ="ERROR";
                $prc->reason ="secret is not correct";
                $myJSON = json_encode($prc);
                echo $myJSON;
                exit;
            }

        }else{
            $prc->status ="ERROR";
            $prc->reason ="secret or payment request not delivered";
            $myJSON = json_encode($prc);
            echo $myJSON;
            exit;
        }


    }
}