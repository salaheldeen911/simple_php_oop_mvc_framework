<?php

use App\Controllers\HomeController;
use App\Controllers\NotFound;
use App\Controllers\WisdomController;
use App\Router\Router;

$router = new Router();

$router
    ->get('/', [HomeController::class, 'index'])

    ->get("/wisdoms", [WisdomController::class, 'index'])
    ->get('/wisdoms/create', [WisdomController::class, 'create'])
    ->post('/wisdoms', [WisdomController::class, 'store'])
    ->get('/wisdoms/{id}/edit', [WisdomController::class, 'edit'])
    ->post('/wisdoms/{id}/update', [WisdomController::class, 'update'])
    ->post('/wisdoms/{id}/delete', [WisdomController::class, 'delete'])

    ->get('/notFound', [NotFound::class, 'index']);
