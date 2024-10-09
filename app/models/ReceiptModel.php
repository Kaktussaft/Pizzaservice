<?php

namespace app\models;

use DateTime;

class ReceipModel
{
    public int $id;
    public int $userId;
    public int $pizzaId;
    public DateTime $orderDate;
    public float $totalPrice;

    public function __construct(int $userId, int $pizzaId, DateTime $orderDate, float $totalPrice)
    {
        $this->userId = $userId;
        $this->pizzaId = $pizzaId;
        $this->orderDate = $orderDate;
        $this->totalPrice = $totalPrice;
    }
}