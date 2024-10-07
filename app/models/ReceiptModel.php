<?php

namespace app\models;

use DateTime;

class ReceipModel
{
    public int $id;
    public int $userId;
    public DateTime $orderDate;
    public float $totalPrice;

    public function __construct(int $userId, DateTime $orderDate, float $totalPrice)
    {
        $this->userId = $userId;
        $this->orderDate = $orderDate;
        $this->totalPrice = $totalPrice;
    }
}