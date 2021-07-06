<?php


class Sql extends PDO
{
    private PDO $conn;
    private string $dsn = 'mysql:host=localhost;dbname=dbphp7';
    private string $username = 'root';
    private string $password = 'fXaoiKtG3BKpKsK8SbGZ';

    public function __construct()
    {
        $this->conn = new PDO($this->dsn, $this->username, $this->password);
    }

    public function select(string $rawQuery, array $params = array()): array
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(parent::FETCH_ASSOC);
    }

    public function query(string $rawQuery, array $params = array()): PDOStatement
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function setParams(PDOStatement $statement, array $parameters = array()): void
    {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam(PDOStatement $statement, $key, $value): void
    {
        $statement->bindParam($key, $value);
    }
}