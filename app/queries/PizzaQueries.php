<?php

namespace app\queries;

use app\repository; 

class PizzaQueries
{
    private $update = "UPDATE Pizza SET";
    private $select = "SELECT * FROM Pizza";
    private $delete = "DELETE FROM Pizza";
    private $insert = "INSERT INTO Pizza";
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }
}