<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 02.12.19
 * Time: 07:37
 */

namespace controller;

use dao\UserDAO;
use domain\AuthType;
use services\AuthServiceImpl;
use router\Router;
use services\EmailServiceClient;
use services\InvoiceServiceImpl;
use services\UserServiceImpl;
use validator\UserUpdateValidator;
use view\LayoutRendering;
use view\TemplateView;

class AuthController
{

    public static function authenticate(){
        if (isset($_SESSION["userLogin"])) {
            if(AuthServiceImpl::getInstance()->validateToken($_SESSION["userLogin"]["token"])) {
                return true;
            }
        }
        if (isset($_COOKIE["token"])) {
            if(AuthServiceImpl::getInstance()->validateToken($_COOKIE["token"])) {
                return true;
            }
        }
        return false;
    }

    public static function authenticateAdmin()
    {
        if (self::authenticate()){
            if(AuthServiceImpl::getInstance()->readUser()->getIsAdmin()){
                return true;
            }
        }
        return false;
    }

    public static function login()
    {
        if(!empty($_COOKIE["anonym_token"])){
            $anonym_token = AuthServiceImpl::getInstance()->readToken($_COOKIE["anonym_token"]);
        }

        $authservice = AuthServiceImpl::getInstance();
        if($authservice->verifyUser($_POST["email"], $_POST["password"])){
            session_regenerate_id(true);
            $token = $authservice->issueToken(AuthType::USER_TOKEN());
            if(!empty($anonym_token)){
                InvoiceServiceImpl::getInstance()->transferPayments($anonym_token,$authservice->readUser());
                setcookie("anonym_token","",time() - 3600, "/", "",false, true);
            }
            $_SESSION["userLogin"]["token"] = $token;
            if(isset($_POST['remember'])){
                setcookie("token", $token, (new \DateTime('now'))->modify('+30 days')->getTimestamp(), "/", "", false, true);
            }
            Router::redirect("/profile");
        }else {
            $loginview = new TemplateView("login.php");
            $loginview->failed=true;
            LayoutRendering::headerLayout($loginview, "Login", "Welcome back");
        }

    }

    public static function logout()
    {
        session_destroy();
        if (isset($_COOKIE['token'])) {
            unset($_COOKIE['token']);
            setcookie("token",null,time() - 3600, "/", "",false, true);
        }
        Router::redirect("/");

    }
    public static function pwRequestView()
    {
        LayoutRendering::headerLayout(new TemplateView("passwordResetRequest.php"), "Password reset", "We will send you a reset link.");
    }
    public static function pwResetRequest()
    {
        $pwResetView = new TemplateView("passwordResetRequest.php");

        $ref = $_POST["email"];
        $userdao = new UserDAO();
        $user = $userdao->findByEmail($ref) ?? $username = $userdao->findByUser($ref);
        if(isset($user) AND !empty($user->getEmail())){
            $token = AuthServiceImpl::getInstance()->issueToken(AuthType::RESET_TOKEN(), $user->getEmail());
            $emailView = new TemplateView("passwordResetEmail.php");
            $emailView->resetLink = $GLOBALS["ROOT_URL"] . "/password/reset?token=" . $token;
            EmailServiceClient::sendEmail($user->getEmail(), "Password Reset Email", $emailView->render());

            $pwResetView->success = true;

        }else{
            $pwResetView->failed = true;
        }
        LayoutRendering::headerLayout($pwResetView, "Password reset", "We will send you a reset link.");
    }
    public static function pwResetView()
    {
        $pwResetRequestView = new TemplateView("passwordReset.php");
        $pwResetRequestView->token = $_GET["token"];

        LayoutRendering::headerLayout($pwResetRequestView, "Change password", "Please enter your new password.");
    }

    public static function pwReset()
    {
        $invalidtoken = false;

        if(AuthServiceImpl::getInstance()->validateToken($_POST["token"])){
            $olduser = AuthServiceImpl::getInstance()->readUser();
            $newuser = clone $olduser;
            $newuser->setPassword($_POST["password"]);
            $userValidator = new UserUpdateValidator($olduser, $newuser);

            if($userValidator->isValid()){
                $newuser->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
                if(UserServiceImpl::getInstance()->updateUser($olduser,$newuser)){
                    LayoutRendering::headerLayout(new TemplateView("login.php"),"Password changed","You can login with your new password");
                    return true;
                }
            }
            $newuser->setPassword("");



        }else{
            $invalidtoken = true;
        }
        $resetView = new TemplateView("passwordReset.php");
        $resetView->token = $_POST["token"];
        if(!empty($userValidator)){
            $resetView->validator = $userValidator;
        }
        $resetView->invalidtoken = $invalidtoken;
        LayoutRendering::headerLayout($resetView, "Change password", "Please enter your new password.");
        return false;
    }


}