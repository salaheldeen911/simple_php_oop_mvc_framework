<?php

namespace App\config;

use PDO;
use PDOException;

class DB
{
    private static        $db = null;
    private static string $servername  = "localhost";
    private static string $dbname = "mvc_framework";
    private static string $username = "root";
    private static string $password = "";
    private static array  $driver_options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ];

    private static function getConnection(): bool | PDO
    {
        try {
            self::$db = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password, self::$driver_options);

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
