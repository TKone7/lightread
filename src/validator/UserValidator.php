<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 24.11.19
 * Time: 11:19
 */

namespace validator;


use domain\User;

class UserValidator
{
    private $valid = true;
    private $userValidatedWarning = null;

    public function __construct(User $user = null)
    {
        if (!is_null($user)) {
            $this->validate($user);
        }
    }

    public function validate(User $user)
    {
        if (!is_null($user)) {
            if (!$user->getVerfied() AND !empty($user->getEmail())) {
                $this->userValidatedWarning = 'Your e-mail address is unverified. Please check the e-mail we sent you.';
            }
        } else {
            $this->valid = false;
        }
        return $this->valid;

    }

    public function isValid()
    {
        return $this->valid;
    }

    public function isUserVerifiedWarning()
    {
        return isset($this->userValidatedWarning);
    }

    public function getUserVerifiedWarning()
    {
        return $this->userValidatedWarning;
    }

}







