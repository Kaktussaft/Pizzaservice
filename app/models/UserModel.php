<?php

namespace app\models;

class UserModel
{
    public int $id;
    public string $name;
    public string $surname;
    public string $password;
    public string $city;
    public string $postalCode;
    public string $street;
    public string $houseNumber;

    public function __construct(string $name, string $surname, string $password, string $city, string $postalCode, string $street, string $houseNumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
    }
}