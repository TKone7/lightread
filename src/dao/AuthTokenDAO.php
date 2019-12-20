<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 02.12.19
 * Time: 08:13
 */

namespace dao;


use domain\AuthToken;

class AuthTokenDAO extends BasicDAO
{
    public function create(AuthToken $authToken) {
        $stmt = $this->pdoInstance->prepare('
        INSERT INTO tbl_auth_token (fld_auth_selector, fld_auth_validator, fld_auth_expiration, fld_user_id, fld_auth_type)
          VALUES (:selector,:validator,:expiration, :userid, :type);');
        $stmt->bindValue(':selector', $authToken->getSelector());
        $stmt->bindValue(':validator', $authToken->getValidator());
        $stmt->bindValue(':expiration', $authToken->getExpiration()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':userid', !empty($authToken->getUser()) ? $authToken->getUser()->getId() : NULL);
        $stmt->bindValue(':type', $authToken->getType()->getValue());
        $stmt->execute();
        return $this->findBySelector($authToken->getSelector());
    }

    public function delete(AuthToken $authToken) {
        $stmt = $this->pdoInstance->prepare('
            DELETE FROM tbl_auth_token
            WHERE fld_auth_id = :id
        ');
        $stmt->bindValue(':id', $authToken->getId());
        $stmt->execute();
    }

    public function findBySelector($selector) {
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_auth_token WHERE fld_auth_selector = :selector;');
        $stmt->bindValue(':selector', $selector);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\AuthToken")[0];
        }
        return null;
    }
    public function read($id) {
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_auth_token WHERE fld_auth_id = :id;');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\AuthToken")[0];
        }
        return null;
    }


}