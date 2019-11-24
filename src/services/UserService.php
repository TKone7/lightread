<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:04
 */

namespace services;

use domain\User;

interface UserService
{
    public function createUser(User $user);

    public function updateUser(User $user);

    public function readUser($id);

}