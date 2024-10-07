<?php

namespace app\models;

class PizzaModel
{
    public int $id;
    public float $price;
    public int $toppings;
    public string $message; 

    public function __construct(float $price, int $toppings, string $message)
    {
        $this->price = $price;
        $this->toppings = $toppings;
        $this->message = $message;
    }
}