<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';

class UserController
{
    public function validate(array $data, ?int $userId = null): array
    {
        $errors = [];

        $firstName = trim((string) ($data['first_name'] ?? ''));
        $lastName = trim((string) ($data['last_name'] ?? ''));
        $username = trim((string) ($data['username'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $roleId = (int) ($data['role_id'] ?? 0);

        if ($firstName === '') {
            $errors[] = 'El nombre es obligatorio.';
        }

        if ($lastName === '') {
            $errors[] = 'El apellido es obligatorio.';
        }

        if ($username === '') {
            $errors[] = 'El nombre de usuario es obligatorio.';
        }

        if ($email === '') {
            $errors[] = 'El email es obligatorio.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El email no tiene un formato válido.';
        }

        if ($roleId <= 0) {
            $errors[] = 'Debe seleccionar un rol válido.';
        }

        $pdo = getDatabaseConnection();
        $roles = Role::all($pdo);
        $validRoleIds = array_map(static fn ($role) => (int) $role['id'], $roles);

        if ($roleId > 0 && !in_array($roleId, $validRoleIds, true)) {
            $errors[] = 'El rol seleccionado no existe.';
        }

        $existingUser = $pdo->prepare('SELECT id FROM users WHERE username = :username AND id != :id');
        $existingUser->execute([':username' => $username, ':id' => $userId ?? 0]);
        if ($existingUser->fetch()) {
            $errors[] = 'El nombre de usuario ya existe.';
        }

        $existingEmail = $pdo->prepare('SELECT id FROM users WHERE email = :email AND id != :id');
        $existingEmail->execute([':email' => $email, ':id' => $userId ?? 0]);
        if ($existingEmail->fetch()) {
            $errors[] = 'El email ya está registrado.';
        }

        return $errors;
    }

    public function store(array $data): array
    {
        $errors = $this->validate($data);

        if ($errors !== []) {
            return ['success' => false, 'errors' => $errors];
        }

        $pdo = getDatabaseConnection();
        $created = User::create($pdo, $data);

        if (!$created) {
            return ['success' => false, 'errors' => ['No se pudo crear el usuario.']];
        }

        return ['success' => true, 'message' => 'Usuario creado correctamente.'];
    }

    public function update(int $id, array $data): array
    {
        $errors = $this->validate($data, $id);

        if ($errors !== []) {
            return ['success' => false, 'errors' => $errors];
        }

        $pdo = getDatabaseConnection();
        $updated = User::update($pdo, $id, $data);

        if (!$updated) {
            return ['success' => false, 'errors' => ['No se pudo actualizar el usuario.']];
        }

        return ['success' => true, 'message' => 'Usuario actualizado correctamente.'];
    }

    public function delete(int $id): array
    {
        $pdo = getDatabaseConnection();
        $user = User::findById($pdo, $id);

        if (!$user) {
            return ['success' => false, 'errors' => ['El usuario no existe.']];
        }

        $deleted = User::delete($pdo, $id);

        if (!$deleted) {
            return ['success' => false, 'errors' => ['No se pudo eliminar el usuario.']];
        }

        return ['success' => true, 'message' => 'Usuario eliminado correctamente.'];
    }
}
