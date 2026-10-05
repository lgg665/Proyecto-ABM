<?php

namespace App\Controllers;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Models\RoleModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService(
            new UserRepository(new UserModel()),
            new RoleRepository(new RoleModel())
        );
    }

    public function index()
    {
        return view('users/index', [
            'users' => $this->service->listUsers(),
        ]);
    }

    public function create()
    {
        $data = $this->service->formData();

        return view('users/form', [
            ...$data,
            'mode' => 'create',
            'errors' => [],
        ]);
    }

    public function edit(int $id)
    {
        $data = $this->service->formData($id);

        if ($data === null) {
            return redirect()->to('/users');
        }

        return view('users/form', [
            ...$data,
            'mode' => 'edit',
            'id' => $id,
            'errors' => [],
        ]);
    }

    public function store()
    {
        $result = $this->service->create([
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
        ]);

        if ($result['success']) {
            return redirect()
                ->to('/users')
                ->with('success', 'Usuario creado correctamente.');
        }

        $data = $this->service->formData();

        return view('users/form', [
            ...$data,
            'mode' => 'create',
            'errors' => $result['errors'],
            'formData' => $this->request->getPost(),
        ]);
    }

    public function update(int $id)
    {
        $result = $this->service->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
        ]);

        if ($result['success']) {
            return redirect()
                ->to('/users')
                ->with('success', 'Usuario actualizado correctamente.');
        }

        $data = $this->service->formData($id);

        if ($data === null) {
            return redirect()->to('/users');
        }

        return view('users/form', [
            ...$data,
            'mode' => 'edit',
            'id' => $id,
            'errors' => $result['errors'],
            'formData' => $this->request->getPost(),
        ]);
    }

    public function delete(int $id)
    {
        $result = $this->service->delete($id);

        return redirect()
            ->to('/users')
            ->with(
                $result['success'] ? 'success' : 'error',
                $result['success']
                    ? 'Usuario eliminado correctamente.'
                    : implode(' ', $result['errors'])
            );
    }
}