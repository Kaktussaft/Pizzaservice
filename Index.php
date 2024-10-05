<?php

require_once('Routes.php');

$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/Pizzaservice/', '', $request);
Route::dispatch($request);

spl_autoload_register(function ($class_name) {
    $file = 'app/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once($file);
    } else {
        error_log("File not found: " . $file);
    }
});
?>