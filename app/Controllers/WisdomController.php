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
        $page = $request->page ?? 1;
        $no_of_records_per_page = 5;
        $offset = ($page - 1) * $no_of_records_per_page;

        $wisdoms = (new QB())
            ->select(["wisdoms.id", "wisdoms.content", "wisdoms.user_id", "wisdoms.created_at", "users.name"])
            ->from("wisdoms")
            ->join("users", ["wisdoms.user_id=users.id"])
            ->orderBy("wisdoms.id", "DESC")
            ->limit($offset, $no_of_records_per_page)
            ->get();

        return $this->view("wisdoms.index", [
            "wisdoms" => $wisdoms,
            "page" => $page,
            "records_per_page" => $no_of_records_per_page,
            "num_records" => $this->wisdom->recordsNum()
        ]);
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
