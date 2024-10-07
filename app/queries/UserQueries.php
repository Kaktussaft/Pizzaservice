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
        $this->repository = new repository\Repository();
    }
}