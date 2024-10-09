<?php

require __DIR__ . '/vendor/autoload.php';
require_once('Routes.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/Pizzaservice/', '', $request);
Route::dispatch($request);

