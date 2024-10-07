<?php

namespace app\controllers;

class ApiController
{
    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        switch ($method) {
            case 'GET':
                $this->handleGet($path);
                break;
            case 'POST':
                $this->handlePost($path);
                break;
            case 'PUT':
                $this->handlePut($path);
                break;
            case 'DELETE':
                $this->handleDelete($path);
                break;
            default:
                $this->sendResponse(405, ['error' => 'Method Not Allowed']);
                break;
        }
    }

    private function handleGet($path)
    {
        if ($path === '/api/resource') {
            $data = ['message' => 'GET request received'];
            $this->sendResponse(200, $data);
        } else {
            $this->sendResponse(404, ['error' => 'Not Found']);
        }
    }

    private function handlePost($path)
    {
        if ($path === '/api/resource') {
            $input = json_decode(file_get_contents('php://input'), true);
            $data = ['message' => 'POST request received', 'input' => $input];
            $this->sendResponse(201, $data);
        } else {
            $this->sendResponse(404, ['error' => 'Not Found']);
        }
    }

    private function handlePut($path)
    {
        if ($path === '/api/resource') {
            $input = json_decode(file_get_contents('php://input'), true);
            $data = ['message' => 'PUT request received', 'input' => $input];
            $this->sendResponse(200, $data);
        } else {
            $this->sendResponse(404, ['error' => 'Not Found']);
        }
    }

    private function handleDelete($path)
    {
        if ($path === '/api/resource') {
            $data = ['message' => 'DELETE request received'];
            $this->sendResponse(200, $data);
        } else {
            $this->sendResponse(404, ['error' => 'Not Found']);
        }
    }

    private function sendResponse($statusCode, $data)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
    }
}
$controller = new ApiController();
$controller->handleRequest();