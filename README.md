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
**You can declare your own controller in the controllers' directory like this example controller.**
<be>
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
            ->limit($offset, $no_of_records_per_page)
            ->get();

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

**As you can see, I've provided some eloquent model features like ``` create()```, ```update```, etc...**
<br>
**As you can see also, I've provided a very simple QB (Query Builder) class that you can use for simple queries.**
<be>
**Also, you can provide your Request class and override the ```$requires``` property to track your required properties in the request.**

**Important Note:** Don't use this for real projects use **Laravel** insted.
