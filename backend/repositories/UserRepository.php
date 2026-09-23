<?php

require_once __DIR__ . '/../models/User.php';

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $sql = '
            SELECT u.id, u.first_name, u.last_name, u.username, u.email,
                   u.role_id, r.name AS role_name
            FROM users u
            INNER JOIN roles r ON r.id = u.role_id
            ORDER BY u.id ASC
        ';

        $stmt = $this->pdo->query($sql);
        return array_map(static fn (array $row): User => User::fromArray($row), $stmt->fetchAll());
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();

        return $user ? User::fromArray($user) : null;
    }

    public function existsUsername(string $username, ?int $exceptId = null): bool
    {
        $sql = 'SELECT id FROM users WHERE username = :username';
        $parameters = [':username' => $username];
        if ($exceptId !== null) {
            $sql .= ' AND id != :except_id';
            $parameters[':except_id'] = $exceptId;
        }
        $sql .= ' LIMIT 1';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);
        return (bool) $stmt->fetch();
    }

    public function existsEmail(string $email, ?int $exceptId = null): bool
    {
        $sql = 'SELECT id FROM users WHERE email = :email';
        $parameters = [':email' => $email];
        if ($exceptId !== null) {
            $sql .= ' AND id != :except_id';
            $parameters[':except_id'] = $exceptId;
        }
        $sql .= ' LIMIT 1';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);
        return (bool) $stmt->fetch();
    }

    public function save(User $user): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (first_name, last_name, username, email, role_id)
             VALUES (:first_name, :last_name, :username, :email, :role_id)'
        );

        return $stmt->execute($this->parameters($user));
    }

    public function update(User $user): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE users SET first_name = :first_name, last_name = :last_name,
             username = :username, email = :email, role_id = :role_id
             WHERE id = :id'
        );

        return $stmt->execute($this->parameters($user) + [':id' => $user->id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }

    private function parameters(User $user): array
    {
        return [
            ':first_name' => $user->firstName,
            ':last_name' => $user->lastName,
            ':username' => $user->username,
            ':email' => $user->email,
            ':role_id' => $user->roleId,
        ];
    }
}