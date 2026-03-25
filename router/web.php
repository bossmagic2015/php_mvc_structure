<?php

// เรียกใช้งาน Controller
use App\Controllers\HomeController;

// Home
// โครงสร้าง method, กำหนดชื่อ path, class ที่ต้องการใช้งาน , ชื่อ method หรือ function ใน class
$router->get('/', [HomeController::class, 'index']);
$router->get('/list', [HomeController::class, 'list']);
