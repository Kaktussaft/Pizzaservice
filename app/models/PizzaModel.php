<?php

namespace app\models;

class PizzaModel
{
    public string $id;
    public string $receiptId;
    public float $price;
    public int $toppings;
    public string $message; 

    public function __construct(string $id, string $receiptId, float $price, int $toppings, string $message)
    {
        $this->id = $id;
        $this->receiptId = $receiptId;
        $this->price = $price;
        $this->toppings = $toppings;
        $this->message = $message;
    }

    public const Tomatensauce = 0.1;
    public const Mozzarella = 0.2;
    public const Salami = 0.7;
    public const Schinken = 0.7;
    public const Pilze = 0.2;
    public const Zwibel = 0.2;
    public const Paprika = 0.2;
    public const Oliven = 0.2;
    public const Speck = 0.7;
    public const Thunfisch = 0.7;

    public const Ingredients = ["Tomatensauce", "Mozzarella", "Salami", "Schinken", "Pilze", "Zwiebeln", "Paprika", "Oliven", "Speck", "Thunfisch"];

    public const prices = [0.1, 0.2, 0.7, 0.7, 0.2, 0.2, 0.2, 0.2, 0.7, 0.7];

    public const IntForPizzas = [
        "Margherita" => 1100000000,
        "Pepperoni" => 1110000000,
        "Supreme" => 1110111100,
        "BBQ" => 1101010010,
        "Tonno" => 1100010101,
        "Prosciutto" => 1101000000,
        "Vegetarisch" => 1100111100
    ]; 

    public const PizzaMenu = [
        "Margherita" => 10.3,
        "Pepperoni" => 11,
        "Supreme" => 11.8,
        "BBQ" => 11.9,
        "Tonno" => 11.4,
        "Prosciutto" => 11,
        "Vegetarisch" => 11.1
    ];
}