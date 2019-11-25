<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:05
 */

namespace services;


use dao\PaymentDAO;
use dao\WithdrawalDAO;
use domain\Purpose;
use domain\User;
use dao\UserDAO;
use http\HTTPException;
use http\HTTPStatusCode;

class UserServiceImpl implements UserService
{
    private static $instance = NULL;

    protected function __construct()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function createUser(User $user) {
        $userdao = new UserDAO();
        return $userdao->create($user);
    }

    public function updateUser(User $olduser, User $user)
    {
        if(AuthServiceImpl::getInstance()->verifyAuth()){
            $userdao = new UserDAO();
            if($user->getId()==(AuthServiceImpl::getInstance())->getCurrentUserId()){
                if(!is_null($user->getPassword())){
                    $userdao->updatePassword($user);
                }
                if(empty($user->getEmail())){
                    // cannot be verified without email address
                    $user->setVerfied(false);
                }else{
                    if($olduser->getEmail() !== $user->getEmail()){
                        // email has changed and triggers re-verification
                        $user->setVerfied(false);
                        // sendout email here
                    }
                }
                return $userdao->update($user);
            }
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);
    }
    public function readUser($id)
    {
        $userdao = new UserDAO();
        return $userdao->read($id);
    }

    public function getTurnover(User $user, Purpose $purpose = NULL){
        $paym_dao = new PaymentDAO();
        return $paym_dao->selectUserTurnover($user,$purpose);
    }

    public function getAggrWithdrawal(User $user){
        $wdrw_dao = new WithdrawalDAO();
        return $wdrw_dao->selectUserWithdrawal($user);
    }
}