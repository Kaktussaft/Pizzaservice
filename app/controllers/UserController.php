<?php

namespace app\controllers;


use app\builders\UserQueries;

class UserController
{
    public function redirectToMainMenu()
    {
        header("http://localhost/Pizzaservice/Orderpage");
    }
}