<?php

namespace app\controllers;


use app\queries\ReceiptQueries;
use app\models\ReceiptModel;

class ReceiptController
{
    private $receiptQueries;

    public function __construct()
    {
        $this->receiptQueries = new ReceiptQueries();
    }

    public function createReceipt($receiptId, $userId)
    {
        $date = date('Y-m-d H:i:s');
        $receipt = new ReceiptModel($receiptId, $userId, $date, 0);
        $result = $this->receiptQueries->create($receipt);
        return $result;
    }

    public function openReceiptExists($userId)
    {
       $result= $this->receiptQueries->readByUserId($userId);
       if($result->num_rows > 0)
       {
        $row = $result->fetch_assoc(); 
        return $row['receipt_id'];
       }
       else
       {
           return false;
       }

    }
}