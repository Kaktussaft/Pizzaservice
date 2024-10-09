<?php

namespace app\controllers;

use app\queries\PizzaQueries;
use app\models\PizzaModel;

class PizzaController
{
    private $pizzaQueries;
    private $pizzaModel;
    private array $pizzaToppings = ["Tomatensauce", "Mozzarralla", "Salami", "Schinken", "Pilze", "Zwiebeln",  "Paprika", "Oliven", "Speck",  "Thunfisch"];

    public function __construct()
    {
        $this->pizzaQueries = new PizzaQueries();
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
        $toppingsString = $this->convertIngredientsToInt($toppings);
        $price = $this->calculatePrice($toppingsString);
        $toppingsInt = bindec($toppingsString);
        $pizza = new PizzaModel($price, $toppingsInt, $message);
        $result = $this->pizzaQueries->create($pizza);
        if ($result == 1) {
            return "Bestellung: Pizza mit ".implode(", ", $toppings)." erfolgreich";
        }
    }

    public function createPizza(string $name)
    {
        foreach (PizzaModel::PizzaMenu as $pizzaName => $pizzaInt) {
            if ($pizzaName == $name) {
                $price = $pizzaInt;
                $newPizza = new PizzaModel($price, bindec($this->getIntFromPizza($name)), "");
                $result = $this->pizzaQueries->create($newPizza);
                if ($result == 1) {
                    return "Bestellung: Pizza ". $name." erfolgreich";
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
}
