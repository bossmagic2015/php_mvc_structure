<?php

// กำหนดชื่อ namespace
namespace App\Core;

// เชื่อมต่อฐานข้อมูลโดยใช้ PDO
use PDO;

class Database
{
    protected static array $connections = [];
    protected static string $default = 'espsm';

    public static function init(array $configs, string $default = 'espsm'): void
    {
        self::$default = $default;
        foreach ($configs as $name => $config) {
            self::$connections[$name] = new PDO(
                $config['dsn'],
                $config['user'],
                $config['pass'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }
    }

    public static function connection(string $name = 'espsm'): PDO
    {
        $name = $name ?? self::$default;
        if (!isset(self::$connections[$name])) {
            throw new \Exception("Database connection '{$name}' not found.");
        }

        return self::$connections[$name];
    }
}
