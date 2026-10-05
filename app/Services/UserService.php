<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $users,
        private RoleRepository $roles
    ) {
    }

    public function listUsers(): array
    {
        return $this->users->all();
    }

    public function formData(?int $id = null): ?array
    {
        $user = $id === null
            ? null
            : $this->users->findById($id);

        if ($id !== null && $user === null) {
            return null;
        }

        return [
            'roles' => $this->roles->all(),
            'formData' => $user ?? $this->emptyFormData(),
        ];
    }

    public function create(array $data): array
    {
        $data = $this->normalize($data);
        $errors = $this->validate($data);

        if ($errors !== []) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $created = $this->users->save($data);

        return $created
            ? ['success' => true]
            : [
                'success' => false,
                'errors' => ['No se pudo crear el usuario.'],
            ];
    }

    public function update(int $id, array $data): array
    {
        $data = $this->normalize($data);

        if ($this->users->findById($id) === null) {
            return [
                'success' => false,
                'errors' => ['El usuario no existe.'],
            ];
        }

        $errors = $this->validate($data, $id);

        if ($errors !== []) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $updated = $this->users->update($id, $data);

        return $updated
            ? ['success' => true]
            : [
                'success' => false,
                'errors' => ['No se pudo actualizar el usuario.'],
            ];
    }

    public function delete(int $id): array
    {
        if ($this->users->findById($id) === null) {
            return [
                'success' => false,
                'errors' => ['El usuario no existe.'],
            ];
        }

        $deleted = $this->users->delete($id);

        return $deleted
            ? ['success' => true]
            : [
                'success' => false,
                'errors' => ['No se pudo eliminar el usuario.'],
            ];
    }

    public function emptyFormData(): array
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'username' => '',
            'email' => '',
            'role_id' => '',
        ];
    }

    private function validate(
        array $data,
        ?int $userId = null
    ): array {
        $errors = [];

        if ($data['first_name'] === '') {
            $errors[] = 'El nombre es obligatorio.';
        }

        if ($data['last_name'] === '') {
            $errors[] = 'El apellido es obligatorio.';
        }

        if ($data['username'] === '') {
            $errors[] = 'El nombre de usuario es obligatorio.';
        }

        if ($data['email'] === '') {
            $errors[] = 'El email es obligatorio.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El email no tiene un formato válido.';
        }

        if (
            $data['role_id'] <= 0 ||
            !$this->roles->exists($data['role_id'])
        ) {
            $errors[] = 'Debe seleccionar un rol válido.';
        }

        if (
            $data['username'] !== '' &&
            $this->users->existsUsername(
                $data['username'],
                $userId
            )
        ) {
            $errors[] = 'El nombre de usuario ya existe.';
        }

        if (
            $data['email'] !== '' &&
            $this->users->existsEmail(
                $data['email'],
                $userId
            )
        ) {
            $errors[] = 'El email ya está registrado.';
        }

        return $errors;
    }

    private function normalize(array $data): array
    {
        return [
            'first_name' => trim((string) ($data['first_name'] ?? '')),
            'last_name' => trim((string) ($data['last_name'] ?? '')),
            'username' => trim((string) ($data['username'] ?? '')),
            'email' => trim((string) ($data['email'] ?? '')),
            'role_id' => (int) ($data['role_id'] ?? 0),
        ];
    }
}