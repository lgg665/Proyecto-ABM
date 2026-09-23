<?php

require_once __DIR__ . '/../models/Role.php';

class RoleRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $stmt = $this->pdo->query('SELECT id, name, description FROM roles ORDER BY name');
        return array_map(static fn (array $row): Role => Role::fromArray($row), $stmt->fetchAll());
    }

    public function exists(int $id): bool
    {
        $stmt = $this->pdo->prepare('SELECT id FROM roles WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        return (bool) $stmt->fetch();
    }
}