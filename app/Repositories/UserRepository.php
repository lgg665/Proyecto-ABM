<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository
{
    public function __construct(
        private UserModel $model
    ) {
    }

    public function all(): array
    {
        return $this->model
            ->select('users.*, roles.name AS role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->orderBy('users.id', 'ASC')
            ->findAll();
    }

    public function findById(int $id): ?array
    {
        return $this->model->find($id);
    }

    public function existsUsername(string $username, ?int $exceptId = null): bool
    {
        $builder = $this->model
            ->where('username', $username);

        if ($exceptId !== null) {
            $builder->where('id !=', $exceptId);
        }

        return $builder->countAllResults() > 0;
    }

    public function existsEmail(string $email, ?int $exceptId = null): bool
    {
        $builder = $this->model
            ->where('email', $email);

        if ($exceptId !== null) {
            $builder->where('id !=', $exceptId);
        }

        return $builder->countAllResults() > 0;
    }

    public function save(array $data): bool
    {
        return $this->model->insert($data) !== false;
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}