<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once('Routes.php');

$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/Pizzaservice/', '', $request);
Route::dispatch($request);

