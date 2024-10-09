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
        $sql = $this->insert . " (price, toppings, message) VALUES (?, ?, ?)";
        $parametertypes = "iis";
        $parameters = array($pizza->price, $pizza->toppings, $pizza->message);
        $result = $this->repository->ExecuteQuery($sql, $parametertypes, $parameters);
        return $result;
    }

}