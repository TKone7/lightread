<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:48
 */

namespace services;
use dao\UserDAO;
use domain\User;

class AuthServiceImpl implements AuthService
{
    private static $instance = NULL;
    private $currentUserId;

    public function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function verifyUser($ref, $password){
        $userdao = new UserDAO();
        $user = $userdao->findByEmail($ref) ?? $username = $userdao->findByUser($ref);
        if(isset($user)){
            if(password_verify($password, $user->getPassword())){
                $this->currentUserId = $user->getId();
                return true;
            }
        }
        return false;
    }


    /**
     * @access public
     * @param int type
     * @param String email
     * @return String
     * @ParamType type int
     * @ParamType email String
     * @ReturnType String
     */
    public function issueToken($type = self::AGENT_TOKEN, $email = null) {
        return $this->currentUserId .":". bin2hex(random_bytes(20));
    }

    /**
     * @access public
     * @param String token
     * @return boolean
     * @ParamType token String
     * @ReturnType boolean
     */
    public function validateToken($token)
    {
        $tokenArray = explode(":", $token);
        if(count($tokenArray)>1) {
            $this->currentUserId = $tokenArray[0];
            return true;
        }
        return false;    }

    /**
     * @access public
     * @return boolean
     * @ReturnType boolean
     */
    public function verifyAuth()
    {
        if(isset($this->currentUserId))
            return true;
        return false;
    }

    /**
     * @access public
     * @return User
     * @ReturnType User
     */
    public function readUser()
    {
        if ($this->verifyAuth()) {
            $userdao = new UserDAO;
            return $userdao->read($this->currentUserId);
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);

    }
}