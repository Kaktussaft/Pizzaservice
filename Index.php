<?php

require_once('Routes.php');

$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/Pizzaservice/', '', $request);
Route::dispatch($request);

spl_autoload_register(function ($class_name) {
    $base_dir = __DIR__ . '/app/';
    $file = $base_dir . str_replace('\\', '/', $class_name) . '.php';

    if (file_exists($file)) {
        require_once($file);
    } else {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base_dir));
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getFilename() === $class_name . '.php') {
                require_once($fileInfo->getPathname());
                return;
            }
        }
        error_log("File not found: " . $class_name . '.php');
    }
});