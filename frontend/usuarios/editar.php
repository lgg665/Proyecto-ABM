<?php

require_once __DIR__ . '/../../backend/config/database.php';
require_once __DIR__ . '/../../backend/models/Role.php';
require_once __DIR__ . '/../../backend/models/User.php';
require_once __DIR__ . '/../../backend/controllers/UserController.php';

$pdo = getDatabaseConnection();
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$user = $id > 0 ? User::findById($pdo, $id) : null;
$roles = Role::all($pdo);
$errors = [];
$formData = [
    'first_name' => '',
    'last_name' => '',
    'username' => '',
    'email' => '',
    'role_id' => '',
];

if (!$user) {
    header('Location: ../index.php');
    exit;
}

$formData = [
    'first_name' => $user['first_name'],
    'last_name' => $user['last_name'],
    'username' => $user['username'],
    'email' => $user['email'],
    'role_id' => $user['role_id'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'username' => $_POST['username'] ?? '',
        'email' => $_POST['email'] ?? '',
        'role_id' => $_POST['role_id'] ?? '',
    ];

    $controller = new UserController();
    $result = $controller->update($id, $formData);

    if ($result['success']) {
        header('Location: ../index.php?success=1');
        exit;
    }

    $errors = $result['errors'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container small">
        <header class="header">
            <h1>Editar Usuario</h1>
            <a class="btn btn-secondary" href="../index.php">Volver</a>
        </header>

        <?php if ($errors !== []): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" class="card form-card">
            <div class="field-group">
                <label for="first_name">Nombre</label>
                <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($formData['first_name'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="field-group">
                <label for="last_name">Apellido</label>
                <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($formData['last_name'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="field-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($formData['username'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="field-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="field-group">
                <label for="role_id">Rol</label>
                <select id="role_id" name="role_id" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= (int) $role['id'] ?>" <?= ((string) $role['id'] === (string) $formData['role_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['name'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
