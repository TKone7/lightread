<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 31.10.19
 * Time: 10:08
 */

namespace config;


class Autoloader
{
    public static function autoload($className) {
        //replace namespace backslash to directory separator of the current operating system
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $fileName = $className . '.php';

        if (file_exists($fileName)) {
            include_once($fileName);
        }
    }
}
spl_autoload_register('config\Autoloader::autoload');
