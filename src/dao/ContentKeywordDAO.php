<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:42
 */

namespace dao;


use domain\ContentKeyword;
use domain\Content;

class ContentKeywordDAO extends BasicDAO
{


    public function read($coke_id){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_contentkeyword WHERE fld_coke_id = :id;');
        $stmt->bindValue(':id', $coke_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\ContentKeyword")[0];
        }
        return null;
    }



    public function delete(ContentKeyword $coke){
        $stmt = $this->pdoInstance->prepare('
        DELETE FROM tbl_contentkeyword
          WHERE fld_coke_id = :coke_id');
        $stmt->bindValue(':coke_id', $coke->getId());
        $stmt->execute();
    }

    public function deleteAll(Content $content){
        $stmt = $this->pdoInstance->prepare('
        DELETE FROM tbl_contentkeyword
          WHERE fld_cont_id = :cont_id');
        $stmt->bindValue(':cont_id', $content->getId());
        $stmt->execute();
    }

    public function create(ContentKeyword $coke){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_contentkeyword (fld_cont_id, fld_keyw_id)
          VALUES (:cont_id, :keyw_id)');
        $stmt->bindValue(':cont_id', $coke->getContID());
        $stmt->bindValue(':keyw_id', $coke->getKeywID());
        $stmt->execute();
        return $this->read($this->pdoInstance->lastInsertId());
    }





}