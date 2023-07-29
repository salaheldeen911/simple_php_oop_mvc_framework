<?php

use App\DB\DB;
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
            $user = userExists($ip);

            if ($user) {
                $_SESSION['user'] = $user;
            } else {
                $user = (new User)->create([
                    "ip" => $ip,
                    "name" => "user-" . time()
                ]);

                $_SESSION['user'] = $user;
            }
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());
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

if (!function_exists('redirectTo')) {

    function redirectTo($path): void
    {
        header("Location: /$path");
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


if (!function_exists('method')) {

    function method(string $method): string
    {
        return "<input name='_method' type='hidden' value='$method'>";
    }
}
