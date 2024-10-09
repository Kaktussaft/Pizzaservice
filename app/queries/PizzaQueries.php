<?php

namespace app\queries;

use app\repository; 
use app\models\Pizza;
use app\models\PizzaModel;

class PizzaQueries
{
    private $update = "UPDATE Pizza SET";
    private $select = "SELECT * FROM Pizza";
    private $delete = "DELETE FROM Pizza";
    private $insert = "INSERT INTO Pizza";
    private $repository;
    private $pizzaModel;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function create(PizzaModel $pizza)
    {
        $sql = $this->insert . " (pizza_id, receipt_id, price, toppings, name, message) VALUES (?, ?, ?, ?, ?, ?)";
        $parametertypes = "ssdiss";
        $parameters = array($pizza->id, $pizza->receiptId, $pizza->price, $pizza->toppings, $pizza->name, $pizza->message);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }

    public function readByReceiptId($receiptId)
    {
        $sql = $this->select . " WHERE receipt_id = ?";
        $parametertypes = "s";
        $parameters = array($receiptId);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }

}