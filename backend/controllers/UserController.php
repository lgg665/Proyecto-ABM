<?php

require_once __DIR__ . '/../services/UserService.php';

class UserController
{
    public function __construct(private UserService $service)
    {
    }

    public function index(): array
    {
        return ['view' => 'index', 'data' => ['users' => $this->service->listUsers()]];
    }

    public function create(): array
    {
        return ['view' => 'form', 'data' => $this->service->formData() + ['mode' => 'create', 'errors' => []]];
    }

    public function edit(int $id): ?array
    {
        $data = $this->service->formData($id);
        return $data === null
            ? null
            : ['view' => 'form', 'data' => $data + ['mode' => 'edit', 'id' => $id, 'errors' => []]];
    }

    public function store(array $input): array
    {
        return $this->service->create($input);
    }

    public function update(int $id, array $input): array
    {
        return $this->service->update($id, $input);
    }

    public function delete(int $id): array
    {
        return $this->service->delete($id);
    }
}
