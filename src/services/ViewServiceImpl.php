<?php


namespace services;


use dao\ViewDAO;
use domain\Content;
use domain\User;
use domain\View;
use Google\Protobuf\StringValue;

class ViewServiceImpl implements ViewService
{

    private static $instance = NULL;

    protected function __construct()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function registerView(Content $content)
    {
        $spy = SpyServiceImpl::getInstance();

        $v = new View();
        $v->setUser($spy->getUser());
        $v->setContent($content);
        $v->setIp($spy->getIP());
        $v->setBrowser($spy->getBrowser());
        $v->setOs($spy->getOS());
        $v->setCountry($spy->getCountry());
        $v->setCity($spy->getCity());

        if(self::isCountable($v)) {
            $view_dao = new ViewDAO();
            $view_dao->register($v);
        }
    }


    private function isCountable(View $v, $minutes = 20){

        $view_dao = new ViewDAO();
        $latest_pit = $view_dao->readLast($v->getUser(), $v->getContent(), $v->getIp(), $v->getCity(),
                                           $v->getCountry(), $v->getOs(), $v->getBrowser());

        $return = false;
        if(!is_null($latest_pit)){

            $now = new \DateTime('now', new \DateTimeZone(date_default_timezone_get()));
            $last_time = date_create_from_format('Y-m-d H:i:s', $latest_pit);
            $diff = $now->diff($last_time);
            $diff_min = $diff->i; //difference in minutes

            if($diff_min > $minutes) {
                //register same viewer again
                $return = true;
            }

        } else {
            //register never seen viewer
            $return = true;
        }

        return $return;
    }












}