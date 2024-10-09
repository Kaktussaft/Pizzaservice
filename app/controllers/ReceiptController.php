<?php

namespace app\controllers;


use app\queries\ReceiptQueries;
use app\controllers\PizzaController; 
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
        $result = $this->receiptQueries->readByUserId($userId);
        if (!empty($result) && isset($result[0]['receipt_id']) && $result[0]['receipt_id'] != "") {
            return $result[0]['receipt_id'];
        } else {
            return false;
        }
    }

    public function order()
    {
        $userId = $_SESSION['user_id'];
        $receiptId = $this->openReceiptExists($userId);
        if ($receiptId == false) {
           return "Ihre Bestellung ist leer"; 
        }
        else{
            $this->receiptQueries->updateReceipt($receiptId);
            return "Ihre Bestellung wurde erfolgreich abgeschickt - Die Pizza wird in Kürze geliefert";
        }
       
    }
}