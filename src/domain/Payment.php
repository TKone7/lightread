<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 17.11.19
 * Time: 13:36
 */

namespace domain;


use dao\ContentDAO;
use dao\UserDAO;

class Payment extends Invoice
{
    /**
     * @AttributeType Content
     */
    private $content;

    /**
     * @AttributeType User
     */
    private $payer;

    /**
     * @return mixed
     */
    public function getContent() : Content
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPayer() : User
    {
        return $this->payer ?? new User();
    }

    /**
     * @param mixed $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    public function __set($name, $value)
    {
        // first check the parent class
        parent::__set($name, $value);

        // do the specific attributes after
        if ($name=='fld_user_id1'){
            $this->setPayer((new UserDAO())->read($value));
        }elseif ($name=='fld_cont_id'){
            $this->setContent((new ContentDAO())->read($value));
        }
    }
}