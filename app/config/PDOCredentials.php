<?php

namespace App\Config;

use PDO;

class PDOCredentials
{
    protected static string $servername  = "localhost";
    protected static string $dbname = "mvc_framework";
    protected static string $username = "root";
    protected static string $password = "";
    protected static array  $driver_options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ];
}
