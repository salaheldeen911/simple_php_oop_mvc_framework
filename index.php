<?php
session_start();
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/app/config/init.php";
require_once __DIR__ . "/app/config/DB.php";
require_once __DIR__ . "/app/Router/routes.php";

$router->resolve($_SERVER['REQUEST_URI']);
