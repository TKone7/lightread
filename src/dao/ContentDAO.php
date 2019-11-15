<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:21
 */

namespace dao;


use domain\Content;

class ContentDAO extends BasicDAO
{
    public function create(Content $content){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_content (fld_user_id,fld_cont_title,fld_cont_subtitle, fld_cont_body,fld_cont_creationpit,fld_cont_satoshis,fld_accc_id,fld_scon_id)
          values(:user_id, :title, :subtitle, :body, :creation, :sats, :access, :status)');
        $stmt->bindValue(':user_id', $content->getAuthor()->getId());
        $stmt->bindValue(':title', $content->getTitle());
        $stmt->bindValue(':subtitle', $content->getSubtitle());
        $stmt->bindValue(':body', $content->getBody());
        $stmt->bindValue(':sats', $content->getPrice());
        $stmt->bindValue(':access', $this->readAccessId($content->getAccess()->getKey())['fld_accc_id']);
        $stmt->bindValue(':status', $this->readStatusId($content->getStatus()->getKey())['fld_scon_id']);
        date_default_timezone_set('Europe/Zurich');
        $stmt->bindValue(':creation', $timestamp = date('Y-m-d H:i:s'));
        $stmt->execute();
        return $this->read($this->pdoInstance->lastInsertId());
    }
    public function read($contentid){
        $stmt = $this->pdoInstance->prepare('
            SELECT c.*, a.fld_accc_key, s.fld_scon_key FROM tbl_content c 
            inner join tbl_accesscontraint a
              on c.fld_accc_id = a.fld_accc_id
            inner join tbl_statuscontent s
              on c.fld_scon_id = s.fld_scon_id 
              WHERE c.fld_cont_id = :id;');
        $stmt->bindValue(':id', $contentid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Content")[0];
        }
        return null;
    }
    public function update(Content $content){
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
        $stmt->bindValue(':title', $content->getTitle());
        $stmt->bindValue(':subtitle', $content->getSubtitle());
        $stmt->bindValue(':body', $content->getBody());
        $stmt->bindValue(':sats', $content->getPrice());
        $stmt->bindValue(':access', $this->readAccessId($content->getAccess()->getKey())['fld_accc_id']);
        $stmt->bindValue(':status', $this->readStatusId($content->getStatus()->getKey())['fld_scon_id']);
        $stmt->execute();
        return $this->read($content->getId());

    }

    private function readStatusId($key){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_statuscontent WHERE fld_scon_key = :key;');
        $stmt->bindValue(':key', $key);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        return null;
    }
    private function readAccessId($key){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_accesscontraint WHERE fld_accc_key = :key;');
        $stmt->bindValue(':key', $key);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        return null;
    }



}