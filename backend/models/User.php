<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    public static function all(PDO $pdo): array
    {
        $sql = "
            SELECT u.id, u.first_name, u.last_name, u.username, u.email, r.name AS role_name
            FROM users u
            INNER JOIN roles r ON r.id = u.role_id
            ORDER BY u.id ASC
        ";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function findById(PDO $pdo, int $id): ?array
    {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public static function create(PDO $pdo, array $data): bool
    {
        $sql = 'INSERT INTO users (first_name, last_name, username, email, role_id) VALUES (:first_name, :last_name, :username, :email, :role_id)';

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':first_name' => trim($data['first_name']),
            ':last_name' => trim($data['last_name']),
            ':username' => trim($data['username']),
            ':email' => trim($data['email']),
            ':role_id' => (int) $data['role_id'],
        ]);
    }

    public static function update(PDO $pdo, int $id, array $data): bool
    {
        $sql = 'UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username, email = :email, role_id = :role_id WHERE id = :id';

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':first_name' => trim($data['first_name']),
            ':last_name' => trim($data['last_name']),
            ':username' => trim($data['username']),
            ':email' => trim($data['email']),
            ':role_id' => (int) $data['role_id'],
            ':id' => $id,
        ]);
    }

    public static function delete(PDO $pdo, int $id): bool
    {
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
