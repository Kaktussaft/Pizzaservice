<?php

require_once 'Connection.php';
use app\database\Connection;
$conn = Connection::getInstance()->getConnection();

$userQuery = "CREATE TABLE IF NOT EXISTS users (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    surname VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    city VARCHAR(50),
    postal_code INT(10),
    street VARCHAR(30),
    house_number INT(10)
)";

$pizzaQuery = "CREATE TABLE IF NOT EXISTS pizza (
    pizza_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(10,2) NOT NULL,
    toppings INT(10) NOT NULL,
    message VARCHAR(1000)
)";


$receiptQuery = "CREATE TABLE IF NOT EXISTS receipts (
    receipt_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    pizza_id INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (pizza_id) REFERENCES pizza(pizza_id),
    orderdate DATE NOT NULL,
)";


$queries = array($userQuery, $pizzaQuery, $receiptQuery);

foreach ($queries as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Table " . $sql . " created successfully";
    } else {
        echo "Error creating table " . $sql . ": " . $conn->error;
    }
}
