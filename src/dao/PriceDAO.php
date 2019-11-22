<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:21
 */

namespace dao;

class PriceDAO extends BasicDAO
{
    public function insert($price, $sym1, $sym2, $update){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_price (fld_price_sym1,fld_price_sym2,fld_price_value,fld_price_update)
          values(:sym1, :sym2, :value, :update )');
        $stmt->bindValue(':sym1', $sym1);
        $stmt->bindValue(':sym2', $sym2);
        $stmt->bindValue(':value', $price);
        $stmt->bindValue(':update', $update->format('Y-m-d H:i:s'));

        $stmt->execute();
        return $this->pdoInstance->lastInsertId();
    }

    public function readLast($sym1, $sym2){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_price 
              WHERE fld_price_sym1 = :sym1 AND fld_price_sym2 = :sym2 order by fld_price_update DESC;');
        $stmt->bindValue(':sym1', $sym1);
        $stmt->bindValue(':sym2', $sym2);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];
        }
        return null;
    }
}