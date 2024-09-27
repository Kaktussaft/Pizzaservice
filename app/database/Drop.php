<?php

require_once 'Connection.php';
use app\database\Connection;

$conn = Connection::getInstance()->getConnection();

$conn->query("SET FOREIGN_KEY_CHECKS = 0");
$result = $conn->query("SHOW TABLES");

if ($result) {

    while ($row = $result->fetch_array()) {
        $table = $row[0];
        $dropSql = "DROP TABLE IF EXISTS $table";
        if ($conn->query($dropSql) === TRUE) {
            echo "Table $table deleted successfully<br>";
        } else {
            echo "Error when trying to delete $table: " . $conn->error . "<br>";
        }
    }
} else {
    echo "Error when trying to access db: " . $conn->error;
}


$conn->query("SET FOREIGN_KEY_CHECKS = 1");
$conn->close();