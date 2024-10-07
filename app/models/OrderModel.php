<?php

namespace app\models;

class OrderModel
{
    public int $receiptId;
    public int $pizzaId;

    public function __construct(int $receiptId, int $pizzaId)
    {
        $this->receiptId = $receiptId;
        $this->pizzaId = $pizzaId;
    }
}