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
            <a class="btn btn-primary" href="index.php?action=create">+ Agregar Usuario</a>
        </header>

        <?php if ($success): ?>
            <div class="alert alert-success">Operación realizada correctamente.</div>
        <?php endif; ?>

        <section class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nombre</th><th>Apellido</th><th>Usuario</th>
                        <th>Email</th><th>Rol</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($users === []): ?>
                        <tr><td colspan="7" class="empty-state">No hay usuarios registrados.</td></tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td data-label="ID"><?= htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Nombre"><?= htmlspecialchars($user->firstName, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Apellido"><?= htmlspecialchars($user->lastName, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Usuario"><?= htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Email"><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Rol"><?= htmlspecialchars($user->roleName ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="actions">
                                    <a class="btn btn-secondary" href="index.php?action=edit&id=<?= (int) $user->id ?>">Editar</a>
                                    <a class="btn btn-danger" href="index.php?action=delete&id=<?= (int) $user->id ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
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
