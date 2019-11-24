<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 16.11.19
 * Time: 20:45
 */

namespace controller;


use domain\User;
use domain\Role;
use router\Router;
use services\AuthServiceImpl;
use services\ContentServiceImpl;
use services\UserServiceImpl;
use validator\UserRegisterValidator;
use validator\UserUpdateValidator;
use validator\UserValidator;
use view\LayoutRendering;
use view\TemplateView;

class UserController
{

    public function register()
    {
        $nu = new User();
        $nu->setUsername($_POST["username"]);
        $nu->setPassword($_POST["password"]);
        $nu->setEmail(($_POST["email"]!=="")?$_POST["email"]:NULL);
        $nu->setRole(Role::USER());

        $registerValid = new UserRegisterValidator($nu);
        if ($registerValid->isValid()){
            $nu->setPassword(password_hash($nu->getPassword(), PASSWORD_DEFAULT));
            $res = UserServiceImpl::getInstance()->createUser($nu);
            if(!is_null($res->getId())){
                if(!is_null($res->getEmail())){
                    LayoutRendering::headerLayout(new TemplateView("login.php"),"Verify E-mail","You will receive an e-mail shortly");
                }else{
                    LayoutRendering::headerLayout(new TemplateView("login.php"),"Thank you","You can login now");
                }
            }
            Router::redirect("/");
        }else{
            // remove password to send back
            $nu->setPassword(null);
            $registerView = new TemplateView("register.php");
            $registerView->user=$nu;
            $registerView->userValidator=$registerValid;
            LayoutRendering::headerLayout($registerView,"Register","Create account");

        }

    }

    public function login()
    {
        $authservice = AuthServiceImpl::getInstance();
        if($authservice->verifyUser($_POST["email"], $_POST["password"])){
            session_regenerate_id(true);
            $_SESSION["userLogin"]["token"] = $authservice->issueToken();
            Router::redirect("/profile");
        }else {
            $loginview = new TemplateView("login.php");
            $loginview->failed=true;
            LayoutRendering::headerLayout($loginview, "Login", "Welcome back");
        }
    }

    public function showProfile()
    {
        $authservice = AuthServiceImpl::getInstance();
        $content = new TemplateView("profile.php");
        $user = $authservice->readUser();
        $mgr = (ContentServiceImpl::getInstance())->getContentMgr(false,NULL, NULL,array($user));
        $uservalid = new UserValidator($user);
        $content->user=$user;
        $content->mgr=$mgr;
        $content->userValidator =$uservalid;
        LayoutRendering::simpleLayout($content);

    }

    public function loadProfile()
    {
        $authservice = AuthServiceImpl::getInstance();
        $content = new TemplateView("edit-profile.php");
        $content->user=$authservice->readUser();
        LayoutRendering::simpleLayout($content);
    }
    public function editProfile()
    {
        $authservice = AuthServiceImpl::getInstance();
        $orig_user =UserServiceImpl::getInstance()->readUser($_POST["id"]);

        $user = new User();
        $user->setId($_POST["id"]);
        $user->setUsername($_POST["username"]);
        $user->setEmail(($_POST["email"]!=="")?$_POST["email"]:NULL);
        $user->setFirstname(($_POST["firstname"]!=="")?$_POST["firstname"]:NULL);
        $user->setLastname(($_POST["lastname"]!=="")?$_POST["lastname"]:NULL);
        $user->setPassword(($_POST["password"]!=="")?$_POST["password"]:NULL);
        $user->setVerfied($orig_user->getVerfied());
        $userValid = new UserUpdateValidator($orig_user,$user);


        if($userValid->isValid()){
            if(!empty($_POST["password"])){
                $user->setPassword(password_hash($user->getPassword(),PASSWORD_DEFAULT));
            }
            $res = UserServiceImpl::getInstance()->updateUser($orig_user,$user);
            Router::redirect("/profile");
        }else{
            $content = new TemplateView("edit-profile.php");
            $content->user=$user;
            $content->userValidator=$userValid;
            LayoutRendering::simpleLayout($content);
        }


    }
}