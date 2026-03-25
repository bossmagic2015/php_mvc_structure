<?php

namespace App\Models;

use App\Core\Database;

class Home
{
    public static function list(string $conn = 'espsm'): array
    {
        return Database::connection($conn)
            ->query("SELECT * FROM teacher")
            ->fetchAll();
    }

    public static function create(string $name, string $email): int
    {
        $stmt = Database::connection('espsm')->prepare("INSERT INTO teacher(name,email) VALUES(?,?)");
        $stmt->execute([$name, $email]);
        return (int)Database::connection('espsm')->lastInsertId();
    }
}
