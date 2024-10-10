<?php

namespace app\queries;

use app\repository; 

class UserQueries
{
    private $update = "UPDATE Users SET";
    private $select = "SELECT * FROM Users";
    private $delete = "DELETE FROM Users";
    private $insert = "INSERT INTO Users";
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function createUser($name, $surname, $password, $city, $postal_code, $street, $house_number)
    {
        $sql = $this->insert . " (name, surname, password, city, postal_code, street, house_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $parametertypes = "ssssisi";
        $parameters = array($name, $surname, $password, $city, $postal_code, $street, $house_number);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }

    public function getUserByNameAndPassword($name, $password)
    {
        $sql = $this->select . " WHERE name = ? AND password = ?";
        $parametertypes = "ss";
        $parameters = array($name, $password);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }

    public function getUserById($id)
    {
        $sql = $this->select . " WHERE user_id = ?";
        $parametertypes = "i";
        $parameters = array($id);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }

    

}