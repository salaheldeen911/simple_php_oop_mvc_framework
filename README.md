# simple_php_oop_mvc_framework
**This is an MVC structure in OOP using pure PHP 8.1.**
<br>
**This framework is not a tutorial on the internet.**
<br>
**This framework has a ```routes.php``` file where you can define your routes like the next example.**
<be>
```
$router = new Router();

$router
    ->get("/wisdoms", [WisdomController::class, 'index'])
    ->get('/wisdoms/create', [WisdomController::class, 'create'])
    ->post('/wisdoms', [WisdomController::class, 'store'])
    ->get('/wisdoms/{id}/edit', [WisdomController::class, 'edit'])
    ->put('/wisdoms/{id}', [WisdomController::class, 'update'])
    ->delete('/wisdoms/{id}', [WisdomController::class, 'delete'])
```

