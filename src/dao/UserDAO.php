<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 11:42
 */

namespace dao;

use domain\User;

class UserDAO extends BasicDAO
{
    public function create(User $user)
    {
        $withemail= !is_null($user->getEmail());
        $sqlstmt = '
        INSERT INTO tbl_user (fld_user_firstname, fld_user_lastname,fld_user_email, fld_user_pwhash, fld_user_nickname,fld_user_locked, fld_user_creationpit,fld_user_verified)
          SELECT :firstname,:lastname,:email,:password,:username,:locked,:creation,:verified
        WHERE NOT EXISTS (
        SELECT fld_user_nickname FROM tbl_user WHERE fld_user_nickname = :usercheck';
        if($withemail){
            $sqlstmt .= ' or fld_user_email = :emailcheck';
        }
        $sqlstmt.=');';
        $stmt = $this->pdoInstance->prepare($sqlstmt);
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':lastname', $user->getLastname());
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':usercheck', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        date_default_timezone_set('Europe/Zurich');
        $stmt->bindValue(':creation', $timestamp = date('Y-m-d H:i:s'));
        $stmt->bindValue(':locked', 0);
        $stmt->bindValue(':verified', 0);
        $stmt->bindValue(':email', $user->getEmail());

        if($withemail){
            $stmt->bindValue(':emailcheck', $user->getEmail());
        }
        $stmt->execute();
        return $this->read($this->pdoInstance->lastInsertId());
    }
    public function update(User $user){
        $stmt = $this->pdoInstance->prepare('
        UPDATE tbl_user set fld_user_firstname = :firstname, fld_user_lastname = :lastname, fld_user_email = :email
         where 	fld_user_id	 = :id;');
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':lastname', $user->getLastname());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();
        return $this->read($user->getId());
    }
    public function updatePassword(User $user){
        $stmt = $this->pdoInstance->prepare('
        UPDATE tbl_user set fld_user_pwhash = :password
         where 	fld_user_id	 = :id;');
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->execute();
    }
    public function read($userid){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_user WHERE fld_user_id = :id;');
        $stmt->bindValue(':id', $userid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\User")[0];
        }
        return null;
    }

    public function findByEmail($email){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_user WHERE fld_user_email = :email;');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\User")[0];
        }
        return null;
    }
    public function findByUser($username){
        $stmt = $this->pdoInstance->prepare('
            SELECT * FROM tbl_user WHERE fld_user_nickname = :username;');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, "domain\User")[0];
        }
        return null;
    }
}

