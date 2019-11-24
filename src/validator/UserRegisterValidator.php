<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 24.11.19
 * Time: 11:40
 */

namespace validator;


use dao\UserDAO;
use domain\User;

class UserRegisterValidator
{
    private $valid = true;
    private $duplUsernameError = null;
    private $duplEmailError = null;
    private $passwordPolicyError = null;


    public function __construct(User $user = null)
    {
        if (!is_null($user)) {
            $this->validate($user);
        }
    }

    public function validate(User $user)
    {
        if (!is_null($user)) {
            $userdao = new UserDAO();
            if (!empty($user->getUsername()) && !empty($userdao->findByUser($user->getUsername()))) {
                $this->duplUsernameError = 'This username is already chosen.';
                $this->valid = false;
            }
            if (!empty($user->getEmail()) &&  !empty($userdao->findByEmail($user->getEmail()))) {
                $this->duplEmailError = 'This email is already chosen.';
                $this->valid = false;
            }
            $specialChars = preg_match('@[^\w]@', $user->getPassword());
            if (!empty($user->getPassword()) && (strlen($user->getPassword())<8 || !$specialChars)) {
                $this->passwordPolicyError = 'The password must be at least 8 characters in length and should include at least one special character.';
                $this->valid = false;
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

    public function isDuplUsernameError()
    {
        return isset($this->duplUsernameError);
    }

    public function getDuplUsernameError()
    {
        return $this->duplUsernameError;
    }

    public function isDuplEmailError()
    {
        return isset($this->duplEmailError);
    }

    public function getDuplEmailError()
    {
        return $this->duplEmailError;
    }

    public function isPasswordPolicyError()
    {
        return isset($this->passwordPolicyError);
    }

    public function getPasswordPolicyError()
    {
        return $this->passwordPolicyError;
    }

}