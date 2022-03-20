<?php

namespace global;

use PDO;

class Database
{
    private string $port = "3306";
    private string $host = "127.0.0.1";
    private string $db = "ssi_location";
    private string $usr = "root";
    private string $pw = "";

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db, $this->usr, $this->pw);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    private string $query = "";

    public function getQuery(): string
    {
        return $this->query;
    }

    public function select(string $dbname, string $query = "*"): Database
    {
        $this->query = "SELECT " . $query . " FROM " . $dbname;
        return $this;
    }

    /**
     * @for SELECT, DELETE, UPDATE
     */
    public function where(string $condition, bool $and = true): Database
    {
        if (str_contains($this->query, "WHERE")) {
            if ($and) {
                $this->query = $this->query . " AND " . $condition;
            } else {
                $this->query = $this->query . " OR " . $condition;
            }
        } else {
            $this->query = $this->query . " WHERE " . $condition;
        }
        return $this;
    }

    /**
     * @for SELECT
     * @warning make sure you run **where** before running this
     */
    public function contains(string $query): Database
    {
        $this->query = $this->query . " LIKE '%" . $query . "%'";
        return $this;
    }

    /**
     * @for SELECT
     * @warning make sure you run **where** before running this
     */
    public function like(string $query): Database
    {
        $this->query = $this->query . " LIKE ".$query;
        return $this;
    }

    /**
     * @for SELECT
     */
    public function orderBy(string $field): Database
    {
        $this->query = $this->query . " ORDER BY " . $field;
        return $this;
    }

    /**
     * @for SELECT
     */
    public function sort(string $destination): Database
    {
        $this->query = $this->query . " " . strtoupper($destination);
        return $this;
    }

    /**
     * @for SELECT
     */
    public function limit(int $limit): Database
    {
        $this->query = $this->query . " LIMIT " . $limit;
        return $this;
    }

    /**
     * @for SELECT
     */
    public function offset(int $offset): Database
    {
        $this->query = $this->query . " OFFSET " . $offset;
        return $this;
    }

    public function delete(string $dbname): Database
    {
        $this->query = "DELETE FROM " . $dbname;
        return $this;
    }

    public function insert(string $dbname): Database
    {
        $this->query = "INSERT INTO " . $dbname;
        return $this;
    }

    /**
     * @for INSERT INTO
     */
    public function columns(string $columns): Database
    {
        $this->query = $this->query . " (" . $columns.")";
        return $this;
    }

    /**
     * @for INSERT INTO
     */
    public function values(string $values): Database
    {
        $this->query = $this->query . " VALUES (" . $values.")";
        return $this;
    }

    public function update(string $dbname): Database
    {
        $this->query = "UPDATE " . $dbname;
        return $this;
    }

    public function set(string $field, string $value) : Database
    {
        if(str_contains($this->query, "SET")) {
            $this->query = $this->query.", ".$field." = '".$value."'";
        }else {
            $this->query = $this->query." SET ".$field." = '".$value."'";
        }
        return $this;
    }

    /**
     * @for ALL
     */
    public function exec(): bool
    {
        $statement = $this->pdo->prepare($this->query);
        return $statement->execute();;
    }

    /**
     * @for SELECT
     */
    public function fetch() : mixed
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @for SELECT
     */
    public function fetchAll() : array
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}