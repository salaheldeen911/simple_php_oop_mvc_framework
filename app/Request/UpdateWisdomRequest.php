<?php

namespace App\Request;


class UpdateWisdomRequest extends Request
{
    protected array $requires = ["content"];
}
