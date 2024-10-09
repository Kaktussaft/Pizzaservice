<?php

namespace app\controllers;

use app\queries\PizzaQueries;
use app\models\PizzaModel;
use app\controllers\ReceiptController;


class PizzaController
{
    private $pizzaQueries;
    private $receiptController;
    private array $pizzaToppings = ["Tomatensauce", "Mozzarralla", "Salami", "Schinken", "Pilze", "Zwiebeln",  "Paprika", "Oliven", "Speck",  "Thunfisch"];

    public function __construct()
    {
        $this->pizzaQueries = new PizzaQueries();
        $this->receiptController = new ReceiptController();
    }


    public function calculatePrice(string $toppings)
    {
        $toppingsArray = $this->breakUpToppings($toppings);
        $price = 10;
        for ($i = 0; $i < 10; $i++) {
            if ($toppingsArray[$i] == 1) {
                $price += PizzaModel::prices[$i];
            }
        }
        return $price;
    }

    public function createCustomPizza(array $toppings, string $message)
    {
        if(!isset($_SESSION['user'])) {
            return "Bitte einloggen";
        }
        $receiptId = $this->getReceiptId();
        $toppingsString = $this->convertIngredientsToInt($toppings);
        $price = $this->calculatePrice($toppingsString);
        $toppingsInt = bindec($toppingsString);
        $pizzaId = $this->genereateUUID();
        $pizza = new PizzaModel($pizzaId, $receiptId, $price, $toppingsInt, $message);
        $result = $this->pizzaQueries->create($pizza);
        if ($result == 1) {
            return "Zur Bestellung hinzugefügt: Pizza mit ".implode(", ", $toppings);
        }
    }

    public function createPizza(string $name)
    {
        if(!isset($_SESSION['user'])) {
            return "Bitte einloggen";
        }

        foreach (PizzaModel::PizzaMenu as $pizzaName => $pizzaInt) {
            if ($pizzaName == $name) {
                $receiptId = $this->getReceiptId();
                $price = $pizzaInt;
                $pizzaId = $this->genereateUUID();
                $newPizza = new PizzaModel($pizzaId, $receiptId, $price, bindec($this->getIntFromPizza($name)), "");
                $result = $this->pizzaQueries->create($newPizza);
                if ($result == 1) {

                    return "Zur Bestellung hinzugefügt: Pizza ". $name;
                }
            }
        }
    }

    public function convertIntToIngredients(int $toppings)
    {
       $binary = decbin($toppings);
       $length = strlen($binary);
    }

    public function convertIngredientsToInt(array $ingredients) 
    {
        $ingredients[] = "end";
        $result = null;
        $j = 0;
        for ($i = 0; $i <  10; $i++) {

            if (PizzaModel::Ingredients[$i] ==$ingredients[$j]) {
                $result .= '1';
                $j++;
            } else {
                $result .= '0';
            }
        }
        return $result; //must return string or else 0 get cut off
    }

    public function getIntFromPizza($name)
    {
        foreach (PizzaModel::IntForPizzas as $pizzaName => $binary) {
            if ($pizzaName == $name) {
                return $binary;
            }
        }
    }

    private function breakUpToppings(string $toppings)
    {
        $toppingsArray = str_split($toppings);
        $toppingsArray = array_map('intval', $toppingsArray);
        return $toppingsArray;
    }

    private function getReceiptId()
    {
        $userId = $_SESSION['user']->id;
        $receiptId = '';
        if($receiptId =$this->receiptController->openReceiptExists($userId) != false)
        {
            return $receiptId;
        }
        else{
            $receiptId = $this->genereateUUID();
            $this->receiptController->createReceipt($receiptId, $userId);
            return $receiptId;
        }
    }
    
    private function genereateUUID()
    {
        return bin2hex(random_bytes(8));
    }
}
