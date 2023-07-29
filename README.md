# Welcome
**This is an MVC structure in OOP using pure PHP 8.1. And this project is not a tutorial on the internet.**
## Components
### Initialization
```
// App\Config\init.php

    define("APP_NAME", 'OOP MVC SIMPLE FRAMEWORK');
    
    if (!user()) {
        defineUser($_SERVER["REMOTE_ADDR"]);
    }
```
**As you can see, we are defining the APP_NAME and the user (based on his ip) at the initialization of the app.**
### Database Credentials
**You can declare your own Database Credentials at the ```App\Config\PDOCredentials``` class like this example below.**
```
<?php

namespace App\Config;

use PDO;

class PDOCredentials
{
    protected static string $servername  = "localhost";
    protected static string $dbname = "mvc_framework";
    protected static string $username = "root";
    protected static string $password = "";
    protected static array  $driver_options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ];
}
```
### Routes
**This framework has a ```routes.php``` file where you can define your routes like the next example.**
<br>
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
### Controllers
**You can declare your own controller in the controllers' directory and extends the base ```Controller::class``` like this example controller.**
<br>
```
<?php

namespace App\Controllers;

use App\Models\Wisdom;
use App\QB\QB;
use App\Request\Request;
use App\Request\StoreWisdomRequest;
use App\Request\UpdateWisdomRequest;

class WisdomController extends Controller
{
    private Wisdom $wisdom;
    public function __construct()
    {
        $this->wisdom = new Wisdom();
    }

    public function index(Request $request = null)
    {
        $wisdoms = (new QB())
            ->select(["wisdoms.id", "wisdoms.content", "wisdoms.user_id", "wisdoms.created_at", "users.name"])
            ->from("wisdoms")
            ->join("users", ["wisdoms.user_id=users.id"])
            ->orderBy("wisdoms.id", "DESC")
            ->getAll();

        return $this->view("wisdoms.index", ["wisdoms" => $wisdoms]);
    }

    public function create()
    {
        return $this->view("wisdoms.create");
    }

    public function store(StoreWisdomRequest $request)
    {
        if ($request->errors) return $this->view("wisdoms.create", ["errors" => $request->errors]);

        $this->wisdom->create([
            "content" => $request->content,
            "user_id" => $request->user_id,
        ]);

        header("Location: /wisdoms");
        exit;
    }

    public function edit($id)
    {
        $wisdom = $this->wisdom->exists($id);

        if ($wisdom) return $this->view("wisdoms.edit", ["wisdom" => $wisdom]);

        return notFound();
    }

    public function update(UpdateWisdomRequest $request, $id)
    {
        if ($request->errors) return $this->view("wisdoms.edit", ["errors" => $request->errors, "wisdom" => $this->wisdom->find($id)]);

        if ($this->wisdom->exists($id)) {
            $this->wisdom->update($id, [
                "content" => $request->content,
            ]);

            header("Location: /wisdoms");
            exit;
        }

        return notFound();
    }

    public function delete($id)
    {
        if ($this->wisdom->exists($id)) {
            $this->wisdom->delete($id);
            header("Location: /wisdoms");
            exit;
        }

        return notFound();
    }
}

```
### Models
**I've provided some eloquent model features like ```create($data)```, ```update($id, $data)```, etc...**
### QB (Query Builder)
**I've provided a very simple QB (Query Builder) class that you can use for simple queries.**
### Helpers
**I've provided some helper functions like ``` notFound()```, ```view($path, $data)```, etc...**
<br>
<br>
**Also, you can provide your Request class and  and extends the base ```Request::class``` and override the ```$requires``` property to track your required properties in the request like the next example.**
<br>
```
<?php

namespace App\Request;

class StoreWisdomRequest extends Request
{
    protected array $requires = ["content", "user_id"];
}
```
<br>
## Important Note:
Don't use this for real projects use **Laravel** instead.
