<?php

namespace App\Controllers;

class NotFound extends Controller
{
    public function index()
    {
        return $this->view("not_found");
    }
}
