<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 00:21
 */

namespace dao;

class NodeDAO extends BasicDAO
{
    public function create($ssl, $macaroon, $ip){
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_nodes (fld_node_tls,fld_node_macaroon,fld_node_ip, fld_active)
          values(:tls, :macaroon, :ip, :active)');
        $stmt->bindValue(':tls', $ssl);
        $stmt->bindValue(':macaroon', $macaroon);
        $stmt->bindValue(':ip', $ip);
        $stmt->bindValue(':active', true);

        $stmt->execute();
        return $this->pdoInstance->lastInsertId();
    }
    public function readActive(){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_nodes 
              WHERE fld_active;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        return null;
    }


}