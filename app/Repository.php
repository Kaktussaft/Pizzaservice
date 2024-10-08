<?php

namespace app; 
use app\database\Connection;

class Repository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
    }

    public function ExecuteQuery($query, string $parameterTypes, $parameters)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($parameterTypes, $parameters);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}

