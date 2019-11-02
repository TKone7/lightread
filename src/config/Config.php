<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 01.11.19
 * Time: 17:39
 */

namespace config;


class Config
{
    protected static $iniFile = "config/config.env";
    protected static $config = [];

    public static function init()
    {
        if (file_exists(self::$iniFile)) {
            self::$config = parse_ini_file(self::$iniFile);
        } else if (file_exists("../". self::$iniFile)) {
            self::$config = parse_ini_file("../". self::$iniFile);
        } else {
            self::loadENV();
        }
    }

    public static function get($key)
    {
        if (empty(self::$config))
            self::init();
        return self::$config[$key];
    }
}