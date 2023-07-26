<?php

namespace App\Request;


class StoreWisdomRequest extends Request
{
    protected array $requires = ["content", "user_id"];
}
