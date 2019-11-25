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
        }
    }

}