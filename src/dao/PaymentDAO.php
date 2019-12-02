<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:21
 */

namespace dao;

use domain\AuthToken;
use domain\Content;
use domain\InvStatus;
use domain\Payment;
use domain\Purpose;
use domain\User;

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
        fld_invc_expiry,
        fld_auth_id
        )
          values(:user_id, :cont_id, :purp_id, :sinv_id, :rhash, :payreq, :memo, :sats, :create, :settle, :expiry, :auth_id)');

        $stmt->bindValue(':auth_id', !empty($payment->getAnonymAuth())?$payment->getAnonymAuth()->getId():NULL);
        $stmt->bindValue(':user_id', !empty($payment->getPayer())?$payment->getPayer()->getId() : NULL);
        $stmt->bindValue(':cont_id', $payment->getContent()->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId($payment->getStatus()->getKey()));
        $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId($payment->getPurpose()->getKey()));
        $stmt->bindValue(':rhash', $payment->getRhash());
        $stmt->bindValue(':payreq', $payment->getPayReq());
        $stmt->bindValue(':memo', $payment->getMemo());
        $stmt->bindValue(':sats', $payment->getValue());
        $stmt->bindValue(':settle',(!is_null($payment->getSettleDate())) ? $payment->getSettleDate()->format('Y-m-d H:i:s') : NULL);
        $stmt->bindValue(':create', $payment->getCreationDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':expiry', $payment->getExpiry());
        $stmt->execute();
        return $this->read($this->pdoInstance->lastInsertId());
    }
    public function read($paymentid){
        $stmt = $this->pdoInstance->prepare('
            SELECT inv.*, p.fld_purp_key, s.fld_sinv_key FROM tbl_invoice inv
            inner join tbl_purpose p
              on inv.fld_purp_id = p.fld_purp_id
            inner join tbl_statusinvoice s
              on inv.fld_sinv_id = s.fld_sinv_id
              WHERE inv.fld_invc_id = :id;');
        $stmt->bindValue(':id', $paymentid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Payment")[0];
        }
        return null;
    }
    public function update(Payment $payment){
        $stmt = $this->pdoInstance->prepare('
        UPDATE tbl_invoice set 
        fld_user_id1=:user_id,
        fld_cont_id=:cont_id,
        fld_purp_id=:purp_id,
        fld_sinv_id=:sinv_id,
        fld_invc_rhash=:rhash,
        fld_invc_payreq=:payreq,
        fld_invc_memo=:memo,
        fld_invc_satoshis=:sats,
        fld_invc_creationpit=:create,
        fld_invc_settlepit=:settle,
        fld_invc_expiry=:expiry
        WHERE fld_invc_id=:id');
        $stmt->bindValue(':id', $payment->getId());
        $payer = !is_null($payment->getPayer()->getId()) ? $payment->getPayer()->getId() : NULL;
        $stmt->bindValue(':user_id', $payer);
        $stmt->bindValue(':cont_id', $payment->getContent()->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId($payment->getStatus()->getKey()));
        $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId($payment->getPurpose()->getKey()));
        $stmt->bindValue(':rhash', $payment->getRhash());
        $stmt->bindValue(':payreq', $payment->getPayReq());
        $stmt->bindValue(':memo', $payment->getMemo());
        $stmt->bindValue(':sats', $payment->getValue());
        $stmt->bindValue(':settle',(!is_null($payment->getSettleDate())) ? $payment->getSettleDate()->format('Y-m-d H:i:s') : NULL);
        $stmt->bindValue(':create', $payment->getCreationDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':expiry', $payment->getExpiry());
        $stmt->execute();
        return $this->read($payment->getId());
    }
    public function findByPayReq($pay_req){
        $stmt = $this->pdoInstance->prepare('
            SELECT inv.*, p.fld_purp_key, s.fld_sinv_key FROM tbl_invoice inv
            inner join tbl_purpose p
              on inv.fld_purp_id = p.fld_purp_id
            inner join tbl_statusinvoice s
              on inv.fld_sinv_id = s.fld_sinv_id
              WHERE inv.fld_invc_payreq = :payreq;');
        $stmt->bindValue(':payreq', $pay_req);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Payment")[0];
        }
        return null;
    }

    public function paymentExists(User $user, Content $content): bool
    {
        $stmt = $this->pdoInstance->prepare('
            SELECT inv.* FROM tbl_invoice inv
              WHERE inv.fld_cont_id = :cont_id AND inv.fld_user_id1 = :user_id AND inv.fld_purp_id = :purp_key AND inv.fld_sinv_id = :inv_key;');
        $stmt->bindValue(':cont_id', $content->getId());
        $stmt->bindValue(':user_id', $user->getId());
        $purp_key = (new InvoiceDAO())->readPurposeId(Purpose::READ()->getKey());
        $stmt->bindValue(':purp_key',$purp_key );
        $inv_key = (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey());
        $stmt->bindValue(':inv_key', $inv_key);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;

    }
    public function anonymPaymentExists(AuthToken $authToken, Content $content): bool
    {
        $stmt = $this->pdoInstance->prepare('
            SELECT inv.* FROM tbl_invoice inv
              WHERE inv.fld_cont_id = :cont_id AND inv.fld_auth_id = :auth_id AND inv.fld_purp_id = :purp_key AND inv.fld_sinv_id = :inv_key;');
        $stmt->bindValue(':cont_id', $content->getId());
        $stmt->bindValue(':auth_id', $authToken->getId());
        $purp_key = (new InvoiceDAO())->readPurposeId(Purpose::READ()->getKey());
        $stmt->bindValue(':purp_key',$purp_key );
        $inv_key = (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey());
        $stmt->bindValue(':inv_key', $inv_key);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;

    }

    public function selectContentTurnover(Content $content, Purpose $purpose = NULL){
        $basic ='SELECT sum(fld_invc_satoshis) from tbl_invoice 
              where fld_cont_id=:cont_id AND fld_sinv_id=:sinv_id';
        if(!is_null($purpose)){
            $basic .= ' AND fld_purp_id=:purp_id';
        }
        $stmt = $this->pdoInstance->prepare($basic);
        $stmt->bindValue(':cont_id', $content->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey()));
        if(!is_null($purpose)){
            $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId($purpose->getKey()));
        }
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC)['sum'];
        return $res ?? 0;
    }
    public function selectUserTurnover(User $user, Purpose $purpose = NULL){
        $basic ='SELECT sum(inv.fld_invc_satoshis) from tbl_invoice inv 
                inner join tbl_content c 
                on c.fld_cont_id = inv.fld_cont_id
              where c.fld_user_id=:user_id AND inv.fld_sinv_id=:sinv_id';
        if(!is_null($purpose)){
            // @todo shoudl only select READ and DONATE not the WITHDRAW purpose
            $basic .= ' AND fld_purp_id=:purp_id';
        }
        $stmt = $this->pdoInstance->prepare($basic);
        $stmt->bindValue(':user_id', $user->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey()));
        if(!is_null($purpose)){
            $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId($purpose->getKey()));
        }
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC)['sum'];
        return $res ?? 0;
    }

    public function selectByReceiver(User $user){
        $basic ='SELECT inv.*, p.fld_purp_key, s.fld_sinv_key FROM tbl_invoice inv
            inner join tbl_purpose p
              on inv.fld_purp_id = p.fld_purp_id
            inner join tbl_statusinvoice s
              on inv.fld_sinv_id = s.fld_sinv_id
            inner join tbl_content c 
              on c.fld_cont_id = inv.fld_cont_id
              where c.fld_user_id=:user_id AND inv.fld_sinv_id=:sinv_id';

        //@todo if we allow to donate on user basis, this select must also include this
        $stmt = $this->pdoInstance->prepare($basic);
        $stmt->bindValue(':user_id', $user->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey()));

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Payment");

    }

    public function selectByPayer(User $user){
        $basic ='SELECT inv.*, p.fld_purp_key, s.fld_sinv_key FROM tbl_invoice inv
            inner join tbl_purpose p
              on inv.fld_purp_id = p.fld_purp_id
            inner join tbl_statusinvoice s
              on inv.fld_sinv_id = s.fld_sinv_id
              where inv.fld_sinv_id=:sinv_id AND inv.fld_user_id1=:user_id AND inv.fld_purp_id in (1,2)'; //@todo replace numbers

        //@todo if we allow to donate on user basis, this select must also include this
        $stmt = $this->pdoInstance->prepare($basic);
        $stmt->bindValue(':user_id', $user->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey()));

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Payment");

    }
}