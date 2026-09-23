<?php

require_once __DIR__ . '/../backend/config/database.php';
require_once __DIR__ . '/../backend/repositories/RoleRepository.php';
require_once __DIR__ . '/../backend/repositories/UserRepository.php';
require_once __DIR__ . '/../backend/services/UserService.php';
require_once __DIR__ . '/../backend/controllers/UserController.php';

$pdo = getDatabaseConnection();
$service = new UserService(new UserRepository($pdo), new RoleRepository($pdo));
$controller = new UserController($service);

$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'];
$userId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$response = null;
$errors = [];

if ($method === 'POST') {
    $input = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'username' => $_POST['username'] ?? '',
        'email' => $_POST['email'] ?? '',
        'role_id' => $_POST['role_id'] ?? '',
    ];
    $userId = isset($_POST['id']) ? (int) $_POST['id'] : $userId;

    $result = $action === 'update'
        ? $controller->update($userId, $input)
        : $controller->store($input);

    if ($result['success']) {
        header('Location: index.php?success=1');
        exit;
    }

    $errors = $result['errors'];
    $response = $action === 'update' ? $controller->edit($userId) : $controller->create();
    if ($response === null) {
        header('Location: index.php');
        exit;
    }
    $response['data']['formData'] = $input;
    $response['data']['errors'] = $errors;
} elseif ($action === 'delete') {
    $result = $controller->delete($userId);
    header('Location: index.php?success=' . ($result['success'] ? '1' : '0'));
    exit;
} elseif ($action === 'create') {
    $response = $controller->create();
} elseif ($action === 'edit') {
    $response = $controller->edit($userId);
    if ($response === null) {
        header('Location: index.php');
        exit;
    }
} else {
    $response = $controller->index();
}

$view = $response['view'];
$data = $response['data'];
$data['success'] = ($_GET['success'] ?? '') === '1';

extract($data, EXTR_SKIP);
require __DIR__ . '/views/users/' . $view . '.php';
