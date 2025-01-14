<?php

//namespace model;

class Model
{
    protected  $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $servername = $_ENV['DB_SERVER'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];

        $dsn = "mysql:host=$servername;dbname=$dbname";

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
        }
    }

    public function all()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $keys = implode(",", array_keys($data));
        $tags = ':' . implode(",", array_values($data));
        $sql = "INSERT INTO $this->table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }
    public function update($data)
    {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= $key . '=:' . $key . ',';
        }
        $fields = rtrim($fields, ',');
        $sql = "UPDATE $this->table SET $fields WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }
    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}
