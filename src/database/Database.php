<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 04.11.19
 * Time: 10:52
 */

namespace database;

use \PDO;
use config\Config;

class Database
{
    private static $pdoInstance = null;

    protected function __construct()
    {
        self::$pdoInstance = new PDO (Config::get("database.dsn"), Config::get("database.user"), Config::get("database.password"));
        self::$pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function connect()
    {
        if (self::$pdoInstance) {
            return self::$pdoInstance;
        }

        new self();

        return self::$pdoInstance;
    }

}