<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.12.19
 * Time: 13:42
 */

namespace dao;


use domain\Category;

class CategoryDAO extends BasicDAO
{
    /**
     * @return Category|null
     */
    public function read($cat_id){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_category WHERE fld_cate_id = :id;');
        $stmt->bindValue(':id', $cat_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Category")[0];
        }
        return null;
    }

    /**
     * @return Category[]|null
     */
    public function readAll(){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_category;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\Category");
        }
        return null;
    }

}