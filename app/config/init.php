<?php

define("APP_NAME", 'OOP MVC SIMPLE FRAMEWORK');

if (!user()) {
    defineUser($_SERVER["REMOTE_ADDR"]);
}
