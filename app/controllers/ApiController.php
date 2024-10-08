<?php

namespace app\controllers;

use  app\controllers\UserController; 

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

        $controllerNamespace = 'app\\controllers\\' . $input['controller'];


        if (!file_exists($controllerNamespace.'.php')) {
            $this->sendResponse(404, ['error' => 'Controller not found: ' . $controllerNamespace]);
            return;
        }

        require_once($controllerNamespace.'.php');
        $this->controller = new $controllerNamespace();

        if (!method_exists($this->controller, $input['method'])) {
            $this->sendResponse(404, ['error' => 'Method not found: ' . $input['method']]);
            return;
        }
        
        $this->method = $input['method'];
        $this->params = isset($input['data']) ? array_values($input['data']) : [];
        $result = call_user_func_array([$this->controller, $this->method], $this->params);

        unset($input['method']);
        unset($input['controller']);
        unset($input['params']);

        if($result != ""){
            $this->sendResponse(200, $result);
        }
    }

    protected function sendResponse($statusCode, $data)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
    }

}