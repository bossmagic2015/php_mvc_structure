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
}
