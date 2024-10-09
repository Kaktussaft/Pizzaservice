<?php

namespace app\models;


class ReceiptModel
{
    public string $id;
    public int $userId;
    public string $orderDate;
    public int $confirmed; 

    public function __construct(string $id, int $userId, string $orderDate, int $confirmed)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->orderDate = $orderDate;
        $this->confirmed = $confirmed;
    }
   
}