<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Home;

class HomeController extends Controller
{
    // function index
    public function index(): void
    {
        // ให้แสดงหน้า home/index.php
        $this->view('home/index', ['title' => 'Home']);
    }

    // function list
    public function list(): void
    {
        try {
            $teachers = Home::list();
            $this->jsonSuccess($teachers, 'Fetch teacher');
        } catch (\Throwable $e) {
            // log
            error_log((string)$e);

            $this->jsonError('Internal server error', null, 500);
        }
    }

    // function stroe
    public function store(): void
    {

        try {
            $name  = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if ($name === '' || $email === '') {
                http_response_code(422);
                $this->jsonError('Invalid data', null, 500);
            }

            $id = Home::create($name, $email);
            $this->jsonSuccess(null, 'Create success');
        } catch (\Throwable $e) {
            // log
            error_log((string)$e);

            $this->jsonError('Internal server error', null, 500);
        }
    }
}
