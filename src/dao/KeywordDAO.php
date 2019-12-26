<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:42
 */

namespace dao;


use domain\Keyword;
use domain\Content;

class KeywordDAO extends BasicDAO
{

    public function read($keyw_id){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_keyword WHERE fld_keyw_id = :id;');
        $stmt->bindValue(':id', $keyw_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Keyword")[0];
        }
        return null;
    }


    public function readByName($name){
        $nReturn = Null;
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_keyword WHERE fld_keyw_name = :key_name;');
        $stmt->bindValue(':key_name', trim(strtolower($name)));
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $nReturn = $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Keyword")[0];
        }

        return $nReturn;
    }

    /**
     * @return Category[]|null
     */
    public function readAll(){
        $stmt = $this->pdoInstance->prepare('
            SELECT k.* FROM tbl_keyword k
            ORDER BY k.fld_keyw_name ASC;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Keyword");
        }
        return null;
    }

    public function readAllofContent(Content $content){
        $stmt = $this->pdoInstance->prepare('
            SELECT k.*  
            FROM tbl_keyword k inner join tbl_contentkeyword ck
              on k.fld_keyw_id = ck.fld_keyw_id
            WHERE ck.fld_cont_id = :cont_id
            ORDER BY k.fld_keyw_name ASC ;');
        $stmt->bindValue(':cont_id', $content->getId());
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Keyword");
        }
        return null;
    }

    public function create(Keyword $keyword){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_keyword (fld_keyw_name)
          VALUES (:key_name)');
        $stmt->bindValue(':key_name', trim(strtolower($keyword->getName())));
        $stmt->execute();
        return $this->read($this->pdoInstance->lastInsertId());
    }

}