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

class UserServiceImpl
{
    public function createUser(User $user) {
        $userdao = new UserDAO();
        return $userdao->create($user);
            $customerDAO = new CustomerDAO();
    }

}