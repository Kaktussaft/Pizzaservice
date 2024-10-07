<?php

namespace app\controllers;

use app\controllers\UserController; 

class ApiController
{
    private $controller; 
    private $method;
    private $params = []; 

    public function handleRequest()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['controller']) || !isset($input['method'])) {
            $this->sendResponse(400, ['error' => 'Invalid request']);
            return;
        }

        $controllerName = 'app\\controllers\\' . $input['controller'];

        error_log('Resolving controller: ' . $controllerName);

        if (!class_exists($controllerName)) {
            $this->sendResponse(404, ['error' => 'Controller not found: ' . $controllerName]);
            return;
        }

        $this->controller = new $controllerName();

        if (!method_exists($this->controller, $input['method'])) {
            $this->sendResponse(404, ['error' => 'Method not found: ' . $input['method']]);
            return;
        }

        $this->method = $input['method'];
        unset($input['method']);
        unset($input['controller']);

        $this->params = $input ? array_values($input) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    protected function sendResponse($statusCode, $data)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($this->params);
    }

}