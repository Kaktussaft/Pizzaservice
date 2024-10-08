<?php

namespace app\controllers;

use  app\queries\UserQueries;

class UserController
{
    private $userQueries;

    public function __construct()
    {
        $this->userQueries = new UserQueries();
    }

    public function redirectToMainMenu()
    {
        header("Location: http://localhost/Pizzaservice/Orderpage");
        exit();
    }

    public function redirectToReceipt()
    {
        header("Location: http://localhost/Pizzaservice/Receipt");
        exit();
    }

    public function Logout()
    {
        session_destroy();
        header("Location: http://localhost/Pizzaservice/Login");
        exit();
    }

    public function Login()
    {

    }

    public function register($name, $surname, $password, $city, $postal_code, $street, $house_number)
    {
        $uniqueUser = $this->userQueries->uniqueUser($name, $password);
        if (isset($uniqueUser[0]) && $uniqueUser[0] != null) {
            return "User already exists";
        }
        $result = $this->userQueries->CreateUser($name, $surname, $password, $city, $postal_code, $street, $house_number);
        if($result == 1)
        {
            return "User created";
        }
        return "Error creating user";
    }


   
}