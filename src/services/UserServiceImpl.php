<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:05
 */

namespace services;


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

    public function updateUser(User $user)
    {
        if(AuthServiceImpl::getInstance()->verifyAuth()){
            $userdao = new UserDAO();
            if($user->getId()==(AuthServiceImpl::getInstance())->getCurrentUserId()){
                if(!is_null($user->getPassword())){
                    $userdao->updatePassword($user);
                }
                return $userdao->update($user);
            }
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);
    }
}