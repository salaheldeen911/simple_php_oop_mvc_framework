<?php

namespace App\Controllers;

class Controller
{
    public function view(string $page, $data = [])
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/views/layout.php";
    }
}
