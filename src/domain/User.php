<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 11:27
 */

namespace domain;


use services\UserServiceImpl;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getFullName(){
        if($this->firstname == "" and $this->lastname== ""){
            return $this->username;
        }
        return ltrim(rtrim($this->getFirstname() . " " . $this->getLastname()," ")," ");
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getTurnover(Purpose $purpose = NULL)
    {
        return UserServiceImpl::getInstance()->getTurnover($this, $purpose);
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        if ($name=='fld_user_id'){
            $this->id=$value;
        }elseif ($name=='fld_user_firstname'){
            $this->setFirstname($value);
        }elseif ($name=='fld_user_lastname'){
            $this->setLastname($value);
        }elseif ($name=='fld_user_email'){
            $this->setEmail($value);
        }elseif ($name=='fld_user_nickname'){
            $this->setUsername($value);
        }elseif ($name=='fld_user_pwhash'){
            $this->setPassword($value);
        }elseif ($name=='fld_user_description'){
            $this->setDescription($value);
        }
    }

}