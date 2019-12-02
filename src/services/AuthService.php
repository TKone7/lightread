<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 13:42
 */

namespace services;


use domain\AuthType;

interface AuthService
{
    /**
     * @AttributeType int

    const AGENT_TOKEN = 1;

    const RESET_TOKEN = 2;
     */

    public function verifyUser($ref, $password);

    /**
     * @access public
     * @param String token
     * @return boolean
     * @ParamType token String
     * @ReturnType boolean
     */
    public function validateToken($token);

    /**
     * @access public
     * @param int type
     * @param String email
     * @return String
     * @ParamType type int
     * @ParamType email String
     * @ReturnType String
     */
    public function issueToken(AuthType $type, $email = null);

    /**
     * @access public
     * @return boolean
     * @ReturnType boolean
     */
    public function verifyAuth();

    /**
     * @access public
     * @return User
     * @ReturnType User
     */
    public function readUser();

    /**
     * @access public
     * @return int
     * @ReturnType int
     */
    public function getCurrentUserId();

}
