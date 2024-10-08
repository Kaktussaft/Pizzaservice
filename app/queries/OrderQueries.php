<?php

namespace app\queries;

use app\repository; 

class OrderQueries
{
    private $update = "UPDATE Order SET";
    private $select = "SELECT * FROM Order";
    private $delete = "DELETE FROM Order";
    private $insert = "INSERT INTO Order";
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }
}