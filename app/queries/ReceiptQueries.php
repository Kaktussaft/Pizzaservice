<?php

namespace app\queries;

use app\repository; 
use app\models\ReceiptModel;

class ReceiptQueries
{
    private $update = "UPDATE Receipt SET";
    private $select = "SELECT * FROM Receipt";
    private $delete = "DELETE FROM Receipt";
    private $insert = "INSERT INTO Receipt";   
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function create(ReceiptModel $receipt)
    {
        $sql = $this->insert . " (receipt_id, user_id,  orderdate, confirmed) VALUES (?, ?)";
        $parametertypes = "sisi";
        $parameters = array($receipt->id, $receipt->userId, $receipt->orderDate, $receipt->confirmed);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }

    public function readByUserId($userId)
    {
        $sql = $this->select . " WHERE user_id = ? AND confirmed = 0";
        $parametertypes = "i";
        $parameters = array($userId);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }
   

    
}