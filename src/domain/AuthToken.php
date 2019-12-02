<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 02.12.19
 * Time: 08:16
 */

namespace domain;


use dao\UserDAO;

class AuthToken
{
    /**
     * @AttributeType int
     */
    private $id;
    /**
     * @AttributeType String
     */
    private $selector;
    /**
     * @AttributeType String
     */
    private $validator;
    /**
     * @AttributeType String
     */
    private $expiration;
    /**
     * @AttributeType User
     */
    private $user;
    /**
     * @AttributeType AuthType
     */
    private $type;

    /**
     * @access public
     * @return int
     * @ReturnType int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @access public
     * @param int id
     * @return void
     * @ParamType id int
     * @ReturnType void
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @access public
     * @return String
     * @ReturnType String
     */
    public function getSelector() {
        return $this->selector;
    }

    /**
     * @access public
     * @param String selector
     * @return void
     * @ParamType selector String
     * @ReturnType void
     */
    public function setSelector($selector) {
        $this->selector = $selector;
    }

    /**
     * @access public
     * @return String
     * @ReturnType String
     */
    public function getValidator() {
        return $this->validator;
    }

    /**
     * @access public
     * @param String validator
     * @return void
     * @ParamType validator String
     * @ReturnType void
     */
    public function setValidator($validator) {
        $this->validator = $validator;
    }

    /**
     * @access public
     * @return DateTime
     * @ReturnType DateTime
     */
    public function getExpiration() {
        return $this->expiration;
    }

    /**
     * @access public
     * @param DateTime expiration
     * @return void
     * @ParamType expiration DateTime
     * @ReturnType void
     */
    public function setExpiration($expiration) {
        $this->expiration = $expiration;
    }

    /**
     * @access public
     * @return int
     * @ReturnType int
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @access public
     * @param int agentid
     * @return void
     * @ParamType agentid int
     * @ReturnType void
     */
    public function setUser(User $user) {
        $this->user = $user;
    }

    /**
     * @access public
     * @return int
     * @ReturnType int
     */
    public function getType() : AuthType
    {
        return $this->type;
    }

    /**
     * @access public
     * @param int type
     * @return void
     * @ParamType type int
     * @ReturnType void
     */
    public function setType(AuthType $type) {
        $this->type = $type;
    }

    public function __set($name, $value)
    {
        if ($name=='fld_auth_id') {
            $this->id = $value;
        }elseif ($name=='fld_user_id'){
            $this->user = (new UserDAO())->read($value);
        }elseif ($name=='fld_auth_selector'){
            $this->selector = $value;
        }elseif ($name=='fld_auth_validator'){
            $this->validator = $value;
        }elseif ($name=='fld_auth_expiration'){
            $this->expiration = date_create_from_format('Y-m-d H:i:s',$value);
        }elseif ($name=='fld_auth_type'){
            switch ($value){
                case AuthType::USER_TOKEN:
                    $this->type = AuthType::USER_TOKEN();
                    break;
                case AuthType::RESET_TOKEN:
                    $this->type = AuthType::RESET_TOKEN();
                    break;
                case AuthType::ANONYM_TOKEN:
                    $this->type = AuthType::ANONYM_TOKEN();
                    break;
            }


        }
    }
}