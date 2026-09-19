<?php

require_once __DIR__ . '/../../backend/config/database.php';
require_once __DIR__ . '/../../backend/controllers/UserController.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: ../index.php');
    exit;
}

$controller = new UserController();
$result = $controller->delete($id);

header('Location: ../index.php' . ($result['success'] ? '?success=1' : '?success=0'));
exit;
