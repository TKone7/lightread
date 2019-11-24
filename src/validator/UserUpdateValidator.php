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

class UserUpdateValidator
{
    private $valid = true;
    private $duplEmailError = null;
    private $passwordPolicyError = null;


    public function __construct(User $olduser =null, User $newuser=null)
    {
        if (!is_null($olduser) && !is_null($newuser)) {
            $this->validate($olduser, $newuser);
        }
    }

    public function validate(User $olduser, User $newuser)
    {
        if (!is_null($olduser) && !is_null($newuser)) {
            $userdao = new UserDAO();
            /*
             Don't allow change of username at the moment
             if (!empty($user->getUsername()) && !empty($userdao->findByUser($user->getUsername()))) {
                $this->duplUsernameError = 'This username is already chosen.';
                $this->valid = false;
            }
            */
            $emailhaschanged = !($olduser->getEmail()===$newuser->getEmail());
            if ($emailhaschanged &&  !empty($userdao->findByEmail($newuser->getEmail()))) {
                $this->duplEmailError = 'This email is already chosen.';
                $this->valid = false;
            }
            $specialChars = preg_match('@[^\w]@', $newuser->getPassword());
            if (!empty($newuser->getPassword()) && (strlen($newuser->getPassword())<8 || !$specialChars)) {
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

    /*
    public function isDuplUsernameError()
    {
        return isset($this->duplUsernameError);
    }

    public function getDuplUsernameError()
    {
        return $this->duplUsernameError;
    }
    */

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