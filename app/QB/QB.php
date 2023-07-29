<?php

namespace App\QB;

use App\DB\DB;
use PDO;

class QB
{
    private string $statement = "";
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function select(array $columns): self
    {
        $this->statement .= " SELECT " . implode(",", $columns);

        return $this;
    }

    public function insertInto(string $table): self
    {
        $this->statement .= " INSERT INTO $table";

        return $this;
    }

    public function from(string $table): self
    {
        $this->statement .= " FROM $table ";

        return $this;
    }

    public function orderBy(string $column, $order = "ASC"): self
    {
        $this->statement .= " ORDER BY $column $order";

        return $this;
    }

    public function limit(int $offset, int $limit): self
    {
        $this->statement .= " LIMIT $offset, $limit ";

        return $this;
    }

    public function where(array $conditions): self
    {
        $this->statement .= " WHERE " . implode(" AND ", $conditions);

        return $this;
    }

    public function join(string $table, array $conditions): self
    {
        $this->statement .= " INNER JOIN $table ON " . implode(" AND ", $conditions);

        return $this;
    }

    public function getAll(): array
    {
        $sth = $this->db->prepare($this->statement);
        $sth->execute();

        return $sth->fetchAll();
    }

    public function __destruct()
    {
        $this->statement = "";
    }
}
