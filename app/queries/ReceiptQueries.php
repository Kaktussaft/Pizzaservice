<?php

namespace app\queries;

use app\repository; 

class ReceiptQueries
{
    private $update = "UPDATE Receipt SET";
    private $select = "SELECT * FROM Receipt";
    private $delete = "DELETE FROM Receipt";
    private $insert = "INSERT INTO Receipt";   
    private $repository;

    public function __construct()
    {
        $this->repository = new repository\Repository();
    }

    
}