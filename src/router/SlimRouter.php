<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 22.12.19
 * Time: 10:34
 */

namespace router;


use Slim\App;
use view\LayoutRendering;
use view\TemplateView;

class SlimRouter
{
    /**
     * @return App
     */
    public static function init() : App
    {
        $protocol = isset($_SERVER['HTTPS']) || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === "https") ? 'https' : 'http';
        $_SERVER['SERVER_PORT'] === "80" ? $serverPort = "" : $serverPort = ":" . $_SERVER['SERVER_PORT'];
        $GLOBALS["ROOT_URL"] = $protocol . "://" . $_SERVER['SERVER_NAME'] . $serverPort . strstr($_SERVER['PHP_SELF'], $_SERVER['ORIGINAL_PATH'], true);


        if (!empty($_SERVER['REDIRECT_ORIGINAL_PATH'])) {
            $_SERVER['PATH_INFO'] = $_SERVER['REDIRECT_ORIGINAL_PATH'];
        } else {
            $_SERVER['PATH_INFO'] = "/";
        }

        //Override the default Not Found Handler before creating App
        $c['notFoundHandler'] = function ($c) {
            return function ($request, $response) use ($c) {
                LayoutRendering::headerLayout(new TemplateView("404.php"),"404","page not found");
                return $response->withStatus(404)
                    ->withHeader('Content-Type', 'text/html');

            };
        };

        return new App($c);
    }

}