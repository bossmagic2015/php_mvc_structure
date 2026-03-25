<?php
// Debug Error
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// เรียกใช้งาน Autoload
require __DIR__ . '/vendor/autoload.php';
// เรียกใช้งาน helper สำหรับ path ใน asset
require __DIR__ . '/app/Core/helper.php';

// Base path
define('BASE_URL', '/php_base_structure'); // ชื่อ sub folder

// เรียกใช้ Class Database ผ่าน namespace
use App\Core\Database;
// เรียกใช้ Class Router ผ่าน namespace
use App\Core\Router;

// Config DB
$config = require __DIR__ . '/config/config.php';
Database::init($config['connections'], 'espsm');

// เรียกใช้งาน Router ที่ตั้งค่าไว้
$router = new Router();
require __DIR__ . '/router/web.php';

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
