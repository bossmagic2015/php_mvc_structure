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
}
