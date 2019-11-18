<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:21
 */

namespace dao;



use domain\Payment;

class PaymentDAO extends BasicDAO
{
    public function create(Payment $payment){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_invoice (
        fld_user_id1,
        fld_cont_id,
        fld_purp_id,
        fld_sinv_id,
        fld_invc_rhash,
        fld_invc_payreq,
        fld_invc_memo,
        fld_invc_satoshis,
        fld_invc_creationpit,
        fld_invc_settlepit,
        fld_invc_expiry
        )
          values(:user_id, :cont_id, :purp_id, :sinv_id, :rhash, :payreq, :memo, :sats, :create, :settle, :expiry)');

        $stmt->bindValue(':user_id', $payment->getPayer()->getId());
        $stmt->bindValue(':cont_id', $payment->getContent()->getId());
        $stmt->bindValue(':sinv_id', $this->readInvStatusId($payment->getStatus()->getKey()));
        $stmt->bindValue(':purp_id', $this->readPurposeId($payment->getPurpose()->getKey()));
        $stmt->bindValue(':rhash', $payment->getRhash());
        $stmt->bindValue(':payreq', $payment->getPayReq());
        $stmt->bindValue(':memo', $payment->getMemo());
        $stmt->bindValue(':sats', $payment->getValue());
        $stmt->bindValue(':create', date('Y-m-d H:i:s',$payment->getCreationDate()));
        $stmt->bindValue(':settle', ($payment->getSettleDate()>0)?date('Y-m-d H:i:s',$payment->getSettleDate()):NULL);
        $stmt->bindValue(':expiry', $payment->getExpiry());
        $stmt->execute();
        return $this->pdoInstance->lastInsertId();//$this->read($this->pdoInstance->lastInsertId());
    }
    public function read($paymentid){
        $stmt = $this->pdoInstance->prepare('
            SELECT inv.* FROM tbl_invoice inv
            inner join tbl_purpose p
              on inv.fld_purp_id = p.fld_purp_id
            inner join tbl_statusinvoice s
              on inv.fld_sinv_id = s.fld_sinv_id
              WHERE inv.fld_invc_id = :id;');
        $stmt->bindValue(':id', $paymentid);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Invoice")[0];
        }
        return null;
    }
/*
    public function update(Payment $payment){
        $stmt = $this->pdoInstance->prepare('
        UPDATE tbl_content set 
        fld_user_id=:user_id,
        fld_cont_title=:title,
        fld_cont_subtitle=:subtitle,
        fld_cont_body=:body,
        fld_cont_satoshis=:sats,
        fld_accc_id=:access,
        fld_scon_id=:status
        where fld_cont_id=:id');
        $stmt->bindValue(':id', $content->getId());

        $stmt->bindValue(':user_id', $content->getAuthor()->getId());

        $stmt->execute();
        return $this->read($content->getId());

    }
*/

    private function readInvStatusId($key){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_statusinvoice WHERE fld_sinv_key = :key;');
        $stmt->bindValue(':key', $key);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC)['fld_sinv_id'];
        }
        return null;
    }
    private function readPurposeId($key){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_purpose WHERE fld_purp_key = :key;');
        $stmt->bindValue(':key', $key);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC)['fld_purp_id'];
        }
        return null;
    }



}