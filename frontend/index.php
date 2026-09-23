<?php

require_once __DIR__ . '/../backend/config/database.php';
require_once __DIR__ . '/../backend/models/Role.php';
require_once __DIR__ . '/../backend/models/User.php';
require_once __DIR__ . '/../backend/controllers/UserController.php';

$controller = new UserController();
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'];
$errors = [];
$formData = [
    'first_name' => '',
    'last_name' => '',
    'username' => '',
    'email' => '',
    'role_id' => '',
];
$roles = [];
$userId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($method === 'POST') {
    $formData = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'username' => $_POST['username'] ?? '',
        'email' => $_POST['email'] ?? '',
        'role_id' => $_POST['role_id'] ?? '',
    ];
    $userId = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    $result = $action === 'update'
        ? $controller->update($userId, $formData)
        : $controller->store($formData);

    if ($result['success']) {
        header('Location: index.php?success=1');
        exit;
    }

    $errors = $result['errors'];
    $action = $action === 'update' ? 'edit' : 'create';
}

if ($action === 'delete') {
    $result = $controller->delete($userId);
    header('Location: index.php?success=' . ($result['success'] ? '1' : '0'));
    exit;
}

if ($action === 'create') {
    $data = $controller->getCreateData();
    $roles = $data['roles'];
    if ($method !== 'POST') {
        $formData = $data['formData'];
    }
} elseif ($action === 'edit') {
    $data = $controller->getEditData($userId);
    if ($data === null) {
        header('Location: index.php');
        exit;
    }
    $roles = $data['roles'];
    if ($method !== 'POST') {
        $formData = $data['formData'];
    }
} else {
    $action = 'index';
    $users = $controller->getIndexData()['users'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Usuarios</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container<?= $action === 'index' ? '' : ' small' ?>">
        <header class="header">
            <h1><?= $action === 'index' ? 'Gestión de Usuarios' : ($action === 'edit' ? 'Editar Usuario' : 'Crear Usuario') ?></h1>
            <?php if ($action === 'index'): ?>
                <a class="btn btn-primary" href="index.php?action=create">+ Agregar Usuario</a>
            <?php else: ?>
                <a class="btn btn-secondary" href="index.php">Volver</a>
            <?php endif; ?>
        </header>

        <?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
            <div class="alert alert-success">Operación realizada correctamente.</div>
        <?php endif; ?>

        <?php if ($errors !== []): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($action === 'index'): ?>
        <section class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($users === []): ?>
                        <tr>
                            <td colspan="7" class="empty-state">No hay usuarios registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td data-label="ID"><?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Nombre"><?= htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Apellido"><?= htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Usuario"><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Email"><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Rol"><?= htmlspecialchars($user['role_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="actions">
                                    <a class="btn btn-secondary" href="index.php?action=edit&id=<?= (int) $user['id'] ?>">Editar</a>
                                    <a class="btn btn-danger delete-button" href="index.php?action=delete&id=<?= (int) $user['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
        <?php else: ?>
        <form method="POST" class="card form-card" action="index.php?action=<?= $action ?><?= $action === 'edit' ? '&id=' . $userId : '' ?>">
            <?php if ($action === 'edit'): ?>
                <input type="hidden" name="id" value="<?= $userId ?>">
            <?php endif; ?>
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
                    <?php if ($action === 'create'): ?><option value="">Seleccione un rol</option><?php endif; ?>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= (int) $role['id'] ?>" <?= ((string) $role['id'] === (string) $formData['role_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['name'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><?= $action === 'edit' ? 'Actualizar' : 'Guardar' ?></button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
