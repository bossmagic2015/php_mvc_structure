<?php

// กำหนดชื่อ namespace
namespace App\Core;

class Controller
{
    // function สำหรับแสดงหน้า page ต่าง ๆ และใช้ layout คลุม โดยค่าเริ่มต้นจะเป็น main
    protected function view(string $view, array $data = [], string|null $layout = 'main'): void
    {
        View::render($view, $data, $layout);
    }

    // function สำหรับส่งข้อมูลเป็น json
    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    // helper สำหรับ success
    protected function jsonSuccess(mixed $data = null, string $message = 'OK', int $status = 200): void
    {
        $this->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    // helper สำหรับ error
    protected function jsonError(string $message = 'Error', mixed $errors = null, int $status = 400): void
    {
        $this->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

    // function สำหรับตรวจสอบ input
    protected function input(string $key, $default = null)
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    // function สำหรับ redirect
    protected function redirect(string $to): void
    {
        header("Location: {$to}");
        exit;
    }
}
