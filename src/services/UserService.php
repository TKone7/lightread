<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:04
 */

namespace service;

use domain\User;

interface UserService
{
    public function createUser(User $user);

}