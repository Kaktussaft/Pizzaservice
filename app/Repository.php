<?php

namespace app; 

use app\database\Connection;
use Exception;

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
        $stmt->bind_param($parameterTypes, ...$parameters);
        $result = $stmt->execute();
        if ($result === false) {
            throw new Exception('Failed to execute statement: ' . $stmt->error);
        }
        if (stripos($query, 'SELECT') === 0) {
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        } else {
            $affectedRows = $stmt->affected_rows;
            $stmt->close();
            return $affectedRows;
        }
    }
}

