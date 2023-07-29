<?php

namespace App\DB;

use PDO;
use PDOException;
use App\Config\PDOCredentials;

class DB extends PDOCredentials
{
    private static $db;

    private static function getConnection(): bool | PDO
    {
        try {
            self::$db = new PDO("mysql:host=" . parent::$servername . ";dbname=" . parent::$dbname, parent::$username, parent::$password, parent::$driver_options);

            return self::$db;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());

            return false;
        }
    }

    public static function connect(): PDO
    {
        if (self::$db) return self::$db;

        return self::getConnection();
    }
}
