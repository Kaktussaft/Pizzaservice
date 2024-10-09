<?php

namespace app\queries;

use app\repository; 
use app\models\ReceiptModel;

class ReceiptQueries
{
    private $update = "UPDATE Receipts SET";
    private $select = "SELECT * FROM Receipts";
    private $delete = "DELETE FROM Receipts";
    private $insert = "INSERT INTO Receipts";   
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function create(ReceiptModel $receipt)
    {
        $sql = $this->insert . " (receipt_id, user_id,  orderdate, confirmed) VALUES (?, ?, ?, ?)";
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

    public function updateReceipt($receiptId)
    {
        $sql = $this->update . " confirmed = 1 WHERE receipt_id = ?";
        $parametertypes = "i";
        $parameters = array($receiptId);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }
   

    
}