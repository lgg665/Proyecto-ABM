<?php

namespace App\Repositories;

use App\Models\RoleModel;

class RoleRepository
{
    public function __construct(
        private RoleModel $model
    ) {
    }

    public function all(): array
    {
        return $this->model
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    public function exists(int $id): bool
    {
        return $this->model->find($id) !== null;
    }
}