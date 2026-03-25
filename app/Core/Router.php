<?php

// กำหนดชื่อ namespace
namespace App\Core;

class Router
{
    private array $routes = [];

    // Method GET
    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    // Method POST
    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    // Dispatch ตัดสตริง
    public function dispatch(string $method, string $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        // base ของโปรเจ็คใน subfolder
        $base = '/php_base_structure'; // ชื่อโปรเจ็ต

        if ($base !== '/' && str_starts_with($path, $base)) {
            $path = substr($path, strlen($base));
        }

        $path = rtrim($path, '/') ?: '/';
        $handler = $this->routes[$method][$path] ?? null;

        // ถ้าไม่ match กับข้อมูลใด ๆ ให้ 404
        if (!$handler) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        [$class, $action] = $handler;

        // ถ้าเรียกใช้งาน class ต่าง ๆ ไม่ได้
        if (!class_exists($class)) {
            http_response_code(500);
            echo "500 Controller class not found: $class";
            return;
        }
        $controller = new $class;

        // ถ้า models มีปัญหา
        if (!method_exists($controller, $action)) {
            http_response_code(500);
            echo "500 Action not found: $class::$action";
            return;
        }

        return $controller->$action();
    }
}
