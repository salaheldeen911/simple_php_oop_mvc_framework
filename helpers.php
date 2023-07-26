<?php

use App\config\DB;
use App\Models\User;

if (!function_exists('view')) {

    function view(string $path, $data): void
    {
        $path = str_replace(".", "/", $path);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/views/pages/$path.php")) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
            require_once $_SERVER['DOCUMENT_ROOT'] . "/views/pages/$path.php";
        }
    }
}

if (!function_exists('user')) {

    function user(): null | stdClass
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return null;
    }
}

if (!function_exists('defineUser')) {

    function defineUser(string $ip): void
    {
        try {
            if (userExists($ip)) {
                $_SESSION['user'] = userExists($ip);
                exit;
            }

            $user = (new User)->create([
                "ip" => $ip,
                "name" => "user-" . time()
            ]);
            $_SESSION['user'] = $user;
            exit;
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());
            exit;
        }
    }
}

if (!function_exists('notFound')) {

    function notFound(): void
    {
        header("Location: /notFound");
        exit;
    }
}

if (!function_exists('userExists')) {

    function userExists(string $ip): bool | stdClass
    {
        try {
            $db = DB::connect();
            $stmt = $db->prepare('SELECT * FROM users WHERE ip=?');
            $stmt->bindParam(1, $ip);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row;
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());

            return false;
        }
    }
}

if (!function_exists('createUser')) {

    function createUser(string $ip): void
    {
        try {
            (new User)->create([
                "ip" => $ip,
                "name" => "user-" . time(),
            ]);
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());
        }
    }
}
