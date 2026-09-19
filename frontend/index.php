<?php

require_once __DIR__ . '/../backend/config/database.php';
require_once __DIR__ . '/../backend/models/User.php';

$pdo = getDatabaseConnection();
$users = User::all($pdo);
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
    <div class="container">
        <header class="header">
            <h1>Gestión de Usuarios</h1>
            <a class="btn btn-primary" href="usuarios/crear.php">+ Agregar Usuario</a>
        </header>

        <?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
            <div class="alert alert-success">Operación realizada correctamente.</div>
        <?php endif; ?>

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
                                <td><?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['role_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="actions">
                                    <a class="btn btn-secondary" href="usuarios/editar.php?id=<?= (int) $user['id'] ?>">Editar</a>
                                    <a class="btn btn-danger delete-button" href="usuarios/eliminar.php?id=<?= (int) $user['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
