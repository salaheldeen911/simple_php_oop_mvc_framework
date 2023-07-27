<?php

namespace App\Models;

use App\config\DB;
use PDO;

class Model
{
    protected $table = "";

    private PDO $db;

    private $sth;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function recordsNum()
    {
        try {
            return $this->db->query("select count(*) from $this->table")->fetchColumn();
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());

            return false;
        }
    }

    public function getAll()
    {
        try {
            $this->sth->execute();

            return $this->sth->fetchAll();
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());

            return false;
        }
    }

    public function find($id)
    {
        try {
            $this->sth = $this->db->prepare("SELECT * FROM $this->table WHERE id = ? LIMIT 1");
            $this->sth->execute([$id]);

            return $this->sth->fetch();
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());

            return false;
        }
    }

    public function create(array $data)
    {
        try {
            $keys = implode(",", array_keys($data));
            $qMarks = implode(",", array_fill(0, count(array_values($data)), "?"));

            $statement = $this->db->prepare("INSERT INTO $this->table ($keys) VALUES ($qMarks)");
            $statement->execute(array_values($data));

            return $this->find($this->db->lastInsertId());
        } catch (\Exception $e) {
            die("Failed: " . $e->getMessage());

            return false;
        }
    }

    public function update($id, array $data = [])
    {
        try {
            $colomns = implode(",", array_map(fn ($key) => $key . "=?", array_keys($data)));
            $this->sth = $this->db->prepare("UPDATE $this->table SET $colomns WHERE id=$id");
            $this->sth->execute(array_values($data));

            return $this->find($id);
        } catch (\Exception $e) {
            die("failed: " . $e->getMessage());

            return false;
        }
    }

    public function delete($id)
    {
        try {
            $this->sth = $this->db->prepare("DELETE FROM $this->table WHERE id=:id");
            $this->sth->bindValue(":id", (int) $id, PDO::PARAM_INT);
            $this->sth->execute();

            return true;
        } catch (\Exception $e) {
            die("failed: " . $e->getMessage());

            return false;
        }
    }

    public function exists($id)
    {
        try {
            $this->sth  = $this->db->prepare("SELECT * FROM $this->table WHERE id=?");
            $this->sth->execute([$id]);

            return $this->sth->fetch();
        } catch (\Exception $e) {
            die("failed: " . $e->getMessage());

            return false;
        }
    }
}
