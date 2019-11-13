<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 11:27
 */

namespace domain;


class User
{
    /**
     * @AttributeType int
     */
    private $id;
    /**
     * @AttributeType String
     */
    private $firstname;
    /**
     * @AttributeType String
     */
    private $lastname;
    /**
     * @AttributeType String
     */
    private $username;
    /**
     * @AttributeType String
     */
    private $description;

    /**
     * @AttributeType String
     */
    private $email;
    /**
     * @AttributeType String
     */
    private $password;

}