<?php

// เรียกใช้งาน Controller
use App\Controllers\HomeController;

// Home
// โครงสร้าง method, กำหนดชื่อ path, class ที่ต้องการใช้งาน , ชื่อ method หรือ function ใน class
// ตัวอย่างเรียกใช้งานหน้า
$router->get('/', [HomeController::class, 'index']);

// ตัวอย่างเรียกใช้งาน api
$router->get('/api/home', [HomeController::class, 'list']); // รายการ
$router->post('/api/home/store', [HomeController::class, 'store']); // สร้างรายการ
$router->post('/api/home/update', [HomeController::class, 'update']); // อัปเดตรายการ
$router->post('/api/home/delete', [HomeController::class, 'delete']); // ลบรายการ
