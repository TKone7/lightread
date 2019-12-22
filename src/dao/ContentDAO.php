<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:21
 */

namespace dao;


use domain\Content;
use domain\Purpose;

class ContentDAO extends BasicDAO
{
    public function create(Content $content){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_content (fld_user_id,fld_cont_title,fld_cont_subtitle, fld_cont_body,fld_cont_creationpit,fld_cont_satoshis,fld_accc_id,fld_scon_id,fld_cont_slug,fld_cate_id)
          values(:user_id, :title, :subtitle, :body, :creation, :sats, :access, :status, :slug, :category)');
        $stmt->bindValue(':user_id', $content->getAuthor()->getId());
        $stmt->bindValue(':title', $content->getTitle());
        $stmt->bindValue(':subtitle', $content->getSubtitle());
        $stmt->bindValue(':body', $content->getBody());
        $stmt->bindValue(':sats', $content->getPrice());
        $stmt->bindValue(':access', $this->readAccessId($content->getAccess()->getKey())['fld_accc_id']);
        $stmt->bindValue(':status', $this->readStatusId($content->getStatus()->getKey())['fld_scon_id']);
        $stmt->bindValue(':slug', $content->getSlug());
        $stmt->bindValue(':category', $content->getCategory()->getId());
        date_default_timezone_set('Europe/Zurich');
        $stmt->bindValue(':creation', $timestamp = date('Y-m-d H:i:s'));
        $stmt->execute();
        return $this->read($this->pdoInstance->lastInsertId());
    }
    public function read($contentid){
        $stmt = $this->pdoInstance->prepare('
            SELECT c.*, a.fld_accc_key, s.fld_scon_key,cat.fld_cate_id FROM tbl_content c 
            inner join tbl_accesscontraint a
              on c.fld_accc_id = a.fld_accc_id
            inner join tbl_statuscontent s
              on c.fld_scon_id = s.fld_scon_id 
            inner join tbl_category cat
              on c.fld_cate_id = cat.fld_cate_id
            WHERE c.fld_cont_id = :id;');
        $stmt->bindValue(':id', $contentid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Content")[0];
        }
        return null;
    }
    public function findBySlug($slug){
        $stmt = $this->pdoInstance->prepare('
            SELECT c.*, a.fld_accc_key, s.fld_scon_key FROM tbl_content c 
            inner join tbl_accesscontraint a
              on c.fld_accc_id = a.fld_accc_id
            inner join tbl_statuscontent s
              on c.fld_scon_id = s.fld_scon_id 
              WHERE c.fld_cont_slug = :slug;');
        $stmt->bindValue(':slug', $slug);
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
        fld_scon_id=:status,
        fld_cate_id=:category                       
        where fld_cont_id=:id');
        $stmt->bindValue(':id', $content->getId());

        $stmt->bindValue(':user_id', $content->getAuthor()->getId());
        $stmt->bindValue(':title', $content->getTitle());
        $stmt->bindValue(':subtitle', $content->getSubtitle());
        $stmt->bindValue(':body', $content->getBody());
        $stmt->bindValue(':sats', $content->getPrice());
        $stmt->bindValue(':access', $this->readAccessId($content->getAccess()->getKey())['fld_accc_id']);
        $stmt->bindValue(':status', $this->readStatusId($content->getStatus()->getKey())['fld_scon_id']);
        $stmt->bindValue(':category', $content->getCategory()->getId());
        $stmt->execute();
        return $this->read($content->getId());

    }


    public function filter($verified_only, $keyword, $category, $authors)
    {
        $basic = 'SELECT * from tbl_content c 
            inner join tbl_accesscontraint a
              on c.fld_accc_id = a.fld_accc_id
            inner join tbl_statuscontent s
              on c.fld_scon_id = s.fld_scon_id 
            inner join tbl_user u 
              on u.fld_user_id = c.fld_user_id
              where 1=1';
        if(!is_null($authors))
            $basic .= ' AND c.fld_user_id in ('.rtrim($authors, ',').')';
        if(!is_null($category))
            $basic .= ' AND c.fld_cate_id in ('.rtrim($category, ',').')';
        if($verified_only){
            $basic .= ' AND u.fld_user_verified';
        }
        $stmt = $this->pdoInstance->prepare($basic);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Content");
        }
        return null;

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

    public function duplicateSlug($slug)
    {
        $sql = '
            SELECT fld_cont_slug FROM tbl_content WHERE fld_cont_slug LIKE :slug';

        $stmt = $this->pdoInstance->prepare($sql);
        $stmt->bindValue(':slug', $slug . '%');

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_COLUMN, 0);
        }
        return null;
    }



}