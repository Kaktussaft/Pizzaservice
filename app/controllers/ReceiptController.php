<?php

namespace app\controllers;


use app\queries\ReceiptQueries;
use app\controllers\PizzaController;
use app\models\ReceiptModel;
use app\controllers\UserController;

class ReceiptController
{
    private $receiptQueries;
    private $pizzaController;
    private $userController;

    public function __construct()
    {
        $this->receiptQueries = new ReceiptQueries();
        $this->pizzaController = new PizzaController($this);
        $this->userController = new UserController();
    }

    public function createReceipt($receiptId, $userId)
    {
        $date = date('Y-m-d H:i:s');
        $receipt = new ReceiptModel($receiptId, $userId, $date, 0);
        $result = $this->receiptQueries->create($receipt);
        return $result;
    }

    public function order()
    {
        $userId = $_SESSION['user']['user_id'];
        $receiptId = $this->openReceiptExists($userId);
        $onePizza = 0; 
        $onePizza = $this->onePizzaPerReceipt($receiptId);
        if ($receiptId == false || $onePizza == 0) {	
            return "Ihre Bestellung ist leer";
        } else {
            $this->receiptQueries->updateReceipt($receiptId);
            return "Ihre Bestellung wurde erfolgreich abgeschickt - Die Pizza wird in Kürze geliefert";
        }
    }

    public function getFullReceipt($receipt_id)
    {
        $userId = $_SESSION['user']['user_id'];
        $totalPrice = 0;
        $receipt= []; 
        $userInfo = $this->userController->getUserInformation($userId);
        $pizzasPerReceipt = $this->pizzaController->getPizzasPerReceipt($receipt_id);
        $totalPrice += $this->pizzaController->getPricePerReceipt($receipt_id);
        $receipt = [
            'user' => $userInfo,
            'pizzas' => $pizzasPerReceipt,
            'totalPrice' => $totalPrice
        ];
        return $receipt;
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

    public function getClosedReceipts()
    {
        $receipts = [];
        $userId = $_SESSION['user']['user_id'];
        $result = $this->receiptQueries->readAllClosedReceipts($userId);
        foreach ($result as $row) {
            $receipts[] = [
                'receipt_id' => $row['receipt_id'],
                'orderdate' => $row['orderdate']
            ];
        }
        return $receipts;
    }

    public function onePizzaPerReceipt($receiptId)
    {
        $result = 0;
        $result = $this->pizzaController->getPizzaAmountPerReceipt($receiptId);
        return  $result;
    }
}
