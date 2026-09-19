<?php

require_once __DIR__ . '/../config/database.php';

class Role
{
    public static function all(PDO $pdo): array
    {
        $stmt = $pdo->query('SELECT id, name, description FROM roles ORDER BY name');
        return $stmt->fetchAll();
    }
}
