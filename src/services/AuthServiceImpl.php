<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:48
 */

namespace services;

use dao\AuthTokenDAO;
use dao\UserDAO;
use domain\AuthToken;
use domain\AuthType;
use domain\User;

class AuthServiceImpl implements AuthService
{
    private static $instance = NULL;
    private $currentUserId;
    private $currentAnonymId;

    public static function getInstance(){
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
                if (password_needs_rehash($user->getPassword(), PASSWORD_DEFAULT)) {
                    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                    $userdao->update($user);
                }
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
    public function issueToken(AuthType $type, $email = null) {
        $token = new AuthToken();
        $validator = random_bytes(20);
        $token->setValidator(hash('sha256', $validator));
        $token->setSelector(bin2hex(random_bytes(5)));
        $token->setType($type);

        if($type == AuthType::USER_TOKEN()){
            $token->setUser($this->readUser());
            $timestamp = (new \DateTime('now'))->modify('+30 days');
        }elseif($type == AuthType::ANONYM_TOKEN()){
            $timestamp = (new \DateTime('now'))->modify('+365 days');
        }
        $token->setExpiration($timestamp);
        $authTokenDAO = new AuthTokenDAO();
        $authTokenDAO->create($token);
        return $token->getSelector() .":". bin2hex($validator);
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
        $authTokenDAO = new AuthTokenDAO();
        $authToken = $authTokenDAO->findBySelector($tokenArray[0]);
        if(!empty($authToken)) {
            if(time()<=$authToken->getExpiration()->getTimestamp()){
                if (hash_equals(hash('sha256', hex2bin($tokenArray[1])), $authToken->getValidator())) {
                    if($authToken->getType()==AuthType::USER_TOKEN()){
                        $this->currentUserId = $authToken->getUser()->getId();
                    }elseif($authToken->getType()==AuthType::ANONYM_TOKEN()){
                        $this->currentAnonymId = $authToken->getId();
                    }
                    return true;
                }
            }
            $authTokenDAO->delete($authToken);
        }
        return false;
    }

    public function readToken($token){
        $tokenArray = explode(":", $token);
        $authTokenDAO = new AuthTokenDAO();
        $authToken = $authTokenDAO->findBySelector($tokenArray[0]);
        return $authToken;
    }

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
    public function readUser() //: User
    {
        if ($this->verifyAuth()) {
            $userdao = new UserDAO;
            return $userdao->read($this->currentUserId);
        }
        throw new HTTPException(HTTPStatusCode::HTTP_401_UNAUTHORIZED);

    }

    /**
     * @access public
     * @return int
     * @ReturnType int
     */
    public function getCurrentUserId()
    {
        return $this->currentUserId;
    }
}