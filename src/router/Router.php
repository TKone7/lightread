<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 31.10.19
 * Time: 11:07
 */

namespace router;

use http\Exception;
use http\HTTPException;
use http\HTTPStatusCode;
use http\HTTPHeader;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\RouteCollector;

class Router
{
    private static $instance = NULL;
    /**
     * @return RouteCollector
     */
    public static function getInstance()
    {
        $protocol = isset($_SERVER['HTTPS']) || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === "https") ? 'https' : 'http';
        $_SERVER['SERVER_PORT'] === "80" ? $serverPort = "" : $serverPort = ":" . $_SERVER['SERVER_PORT'];
        $GLOBALS["ROOT_URL"] = $protocol . "://" . $_SERVER['SERVER_NAME'] . $serverPort . strstr($_SERVER['PHP_SELF'], $_SERVER['ORIGINAL_PATH'], true);


        if (!empty($_SERVER['REDIRECT_ORIGINAL_PATH'])) {
            $_SERVER['PATH_INFO'] = $_SERVER['REDIRECT_ORIGINAL_PATH'];
        } else {
            $_SERVER['PATH_INFO'] = "/";
        }
        if(!isset(self::$instance)){
            self::$instance = new RouteCollector();
        }
        return self::$instance;
    }

    public static function redirect($redirect_path)
    {
        HTTPHeader::redirect($redirect_path);
    }

    public static function call_route($method, $path)
    {
        $dispatcher = new Dispatcher(self::$instance->getData());

        $response = $dispatcher->dispatch($method, $path);

        echo $response;

    }
/*
    public static function route($method, $path, $routeFunction)
    {
        self::route_auth($method, $path, null, $routeFunction);
    }

    public static function route_auth($method, $path, $authFunction, $routeFunction)
    {
        if (empty(self::$routes))
            self::init();
        $path = trim($path, '/');
        self::$routes[$method][$path] = array("authFunction" => $authFunction, "routeFunction" => $routeFunction);
    }



    public static function errorHeader()
    {
        HTTPHeader::setStatusHeader(HTTPStatusCode::HTTP_404_NOT_FOUND);
    }


*/
}