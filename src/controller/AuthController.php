<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 02.12.19
 * Time: 07:37
 */

namespace controller;

use domain\AuthType;
use services\AuthServiceImpl;
use router\Router;
use services\InvoiceServiceImpl;

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
        setcookie("token","",time() - 3600, "/", "",false, true);
        Router::redirect("/");

    }
}