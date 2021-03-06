<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:36
 */

namespace domain;

use dao\UserDAO;

class Withdrawal extends Invoice
{


    /**
     * @AttributeType User
     */
    private $receiver;

    /**
     * @AttributeType String
     */
    private $lnurl_challenge;

    /**
     * @AttributeType String
     */
    private $lnurl_secret;

    /**
     * @return mixed
     */
    public function getLnurlChallenge()
    {
        return $this->lnurl_challenge;
    }

    /**
     * @param mixed $lnurl_challenge
     */
    public function setLnurlChallenge($lnurl_challenge)
    {
        $this->lnurl_challenge = $lnurl_challenge;
    }

    /**
     * @return mixed
     */
    public function getLnurlSecret()
    {
        return $this->lnurl_secret;
    }

    /**
     * @param mixed $lnurl_secret
     */
    public function setLnurlSecret($lnurl_secret)
    {
        $this->lnurl_secret = $lnurl_secret;
    }

    /**
     * @return mixed
     */
    public function getReceiver() : User
    {
        return $this->receiver ?? new User();;
    }

    /**
     * @param mixed $receiver
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    public function __set($name, $value)
    {
        // first check the parent class
        parent::__set($name, $value);
        // do the specific attributes after
        if ($name=='fld_user_id1'){
            $this->setReceiver((new UserDAO())->read($value));
        }elseif ($name=='fld_invc_lnurl_challenge'){
            $this->setLnurlChallenge($value);
        }elseif ($name=='fld_invc_lnurl_secret'){
            $this->setLnurlSecret($value);
        }
    }

}