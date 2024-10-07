<?php

require_once('Route.php');

Route::set('Login', function(){
   include 'app/views/Login.php';
});

Route::set('Orderpage', function(){
   include 'app/views/Orderpage.php';
});

Route::set('Receipt', function(){
   include 'app/views/Receipt.php';
});

Route::set('ApiController', function(){
   include 'app/controllers/ApiController.php';
   $apiController = new \app\controllers\ApiController();
   $apiController->handleRequest();
});

?>