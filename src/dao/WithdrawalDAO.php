<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:21
 */

namespace dao;

use domain\InvStatus;
use domain\Purpose;
use domain\User;
use domain\Withdrawal;

class WithdrawalDAO extends BasicDAO
{
    public function create(Withdrawal $withdrawal){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_invoice (
        fld_user_id1,
        fld_purp_id,
        fld_sinv_id,
        fld_invc_rhash,
        fld_invc_payreq,
        fld_invc_memo,
        fld_invc_satoshis,
        fld_invc_creationpit,
        fld_invc_settlepit,
        fld_invc_expiry
        ) select :user_id, :purp_id, :sinv_id, :rhash, :payreq, :memo, :sats, :create, :settle, :expiry
        WHERE NOT EXISTS (
        SELECT fld_invc_rhash FROM tbl_invoice WHERE fld_invc_rhash = :rhashcheck);');
        $receiver = !is_null($withdrawal->getReceiver()->getId()) ? $withdrawal->getReceiver()->getId() : NULL;
        $stmt->bindValue(':user_id', $receiver);
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId($withdrawal->getStatus()->getKey()));
        $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId($withdrawal->getPurpose()->getKey()));
        $stmt->bindValue(':rhash', $withdrawal->getRhash());
        $stmt->bindValue(':rhashcheck', $withdrawal->getRhash());

        $stmt->bindValue(':payreq', $withdrawal->getPayReq());
        $stmt->bindValue(':memo', $withdrawal->getMemo());
        $stmt->bindValue(':sats', $withdrawal->getValue());
        $stmt->bindValue(':settle',(!is_null($withdrawal->getSettleDate())) ? $withdrawal->getSettleDate()->format('Y-m-d H:i:s') : NULL);
        $stmt->bindValue(':create', $withdrawal->getCreationDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':expiry', $withdrawal->getExpiry());
        $stmt->execute();
        return $this->read($this->pdoInstance->lastInsertId());
    }
    public function read($withdrawalid){
        $stmt = $this->pdoInstance->prepare('
            SELECT inv.*, p.fld_purp_key, s.fld_sinv_key FROM tbl_invoice inv
            inner join tbl_purpose p
              on inv.fld_purp_id = p.fld_purp_id
            inner join tbl_statusinvoice s
              on inv.fld_sinv_id = s.fld_sinv_id
              WHERE inv.fld_invc_id = :id;');
        $stmt->bindValue(':id', $withdrawalid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Withdrawal")[0];
        }
        return null;
    }
    public function update(Withdrawal $withdrawal){
        $stmt = $this->pdoInstance->prepare('
        UPDATE tbl_invoice set 
        fld_user_id1=:user_id,
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
        $stmt->bindValue(':id', $withdrawal->getId());
        $receiver = !is_null($withdrawal->getReceiver()->getId()) ? $withdrawal->getReceiver()->getId() : NULL;
        $stmt->bindValue(':user_id', $receiver);
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId($withdrawal->getStatus()->getKey()));
        $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId($withdrawal->getPurpose()->getKey()));
        $stmt->bindValue(':rhash', $withdrawal->getRhash());
        $stmt->bindValue(':payreq', $withdrawal->getPayReq());
        $stmt->bindValue(':memo', $withdrawal->getMemo());
        $stmt->bindValue(':sats', $withdrawal->getValue());
        $stmt->bindValue(':settle',(!is_null($withdrawal->getSettleDate())) ? $withdrawal->getSettleDate()->format('Y-m-d H:i:s') : NULL);
        $stmt->bindValue(':create', $withdrawal->getCreationDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':expiry', $withdrawal->getExpiry());
        $stmt->execute();
        return $this->read($withdrawal->getId());
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
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Withdrawal")[0];
        }
        return null;
    }

    public function selectUserWithdrawal(User $user){
        $basic ='SELECT sum(inv.fld_invc_satoshis) from tbl_invoice inv 
              where inv.fld_user_id1=:user_id AND inv.fld_sinv_id=:sinv_id AND fld_purp_id=:purp_id';

        $stmt = $this->pdoInstance->prepare($basic);
        $stmt->bindValue(':user_id', $user->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey()));
        $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId(Purpose::WITHDRAWAL()->getKey()));
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC)['sum'];
        return $res ?? 0;
    }
    public function selectByWithdrawer(User $user){
        $basic ='SELECT inv.*, p.fld_purp_key, s.fld_sinv_key FROM tbl_invoice inv
            inner join tbl_purpose p
              on inv.fld_purp_id = p.fld_purp_id
            inner join tbl_statusinvoice s
              on inv.fld_sinv_id = s.fld_sinv_id 
              where inv.fld_user_id1=:user_id AND inv.fld_sinv_id=:sinv_id AND inv.fld_purp_id=:purp_id';

        $stmt = $this->pdoInstance->prepare($basic);
        $stmt->bindValue(':user_id', $user->getId());
        $stmt->bindValue(':sinv_id', (new InvoiceDAO())->readInvStatusId(InvStatus::SETTLED()->getKey()));
        $stmt->bindValue(':purp_id', (new InvoiceDAO())->readPurposeId(Purpose::WITHDRAWAL()->getKey()));
        $stmt->execute();
        $res = $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Withdrawal");
        return $res;
    }

}