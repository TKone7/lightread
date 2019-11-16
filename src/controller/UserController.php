<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 16.11.19
 * Time: 20:45
 */

namespace controller;


use domain\User;
use router\Router;
use services\AuthServiceImpl;
use services\ContentServiceImpl;
use services\UserServiceImpl;
use view\LayoutRendering;
use view\TemplateView;

class UserController
{

    public function register()
    {
        $nu = new User();
        $nu->setUsername($_POST["username"]);
        $nu->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
        $nu->setEmail(($_POST["email"]!=="")?$_POST["email"]:NULL);

        $res = UserServiceImpl::getInstance()->createUser($nu);
        if(!(is_null($res->getId()))){
            LayoutRendering::headerLayout(new TemplateView("login.php"),"Success","Your ID: ".$res->getId());
        }
        Router::redirect("/");
    }

    public function login()
    {
        $authservice = AuthServiceImpl::getInstance();
        if($authservice->verifyUser($_POST["email"], $_POST["password"])){
            session_regenerate_id(true);
            $_SESSION["userLogin"]["token"] = $authservice->issueToken();
            Router::redirect("/profile");
        }else {
            LayoutRendering::headerLayout(new TemplateView("login.php"), "Login", "Welcome back");
        }
    }

    public function showProfile()
    {
        $authservice = AuthServiceImpl::getInstance();
        $content = new TemplateView("profile.php");
        $user = $authservice->readUser();
        $mgr = (ContentServiceImpl::getInstance())->getContentMgr(NULL, NULL,array($user));
        $content->user=$user;
        $content->mgr=$mgr;
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
        $user = new User();
        $user->setId($_POST["id"]);
        // cannot change username afterwards
        // $user->setUsername($_POST["username"]);
        $user->setEmail(($_POST["email"]!=="")?$_POST["email"]:NULL);
        $user->setFirstname(($_POST["firstname"]!=="")?$_POST["firstname"]:NULL);
        $user->setLastname(($_POST["lastname"]!=="")?$_POST["lastname"]:NULL);
        if($_POST["password"] !== "")
            $user->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
        $res = UserServiceImpl::getInstance()->updateUser($user);
        Router::redirect("/profile");
    }
}