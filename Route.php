<?php

class Route{

    public static $validRoutes = array();

    public static function set($route, $callback){
        self::$validRoutes[$route] = $callback;
    } 
    public static function dispatch($request) {
        if (array_key_exists($request, self::$validRoutes)) {
            call_user_func(self::$validRoutes[$request]);
        } else {
            echo "404 - Not Found";
        }
    }
}