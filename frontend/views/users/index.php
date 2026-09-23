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
        <div class="system-bar">
            <span class="system-mark"><span class="status-dot"></span> ABM // USER MANAGEMENT</span>
            <span>DATABASE / ONLINE</span>
        </div>
        <header class="header">
            <div>
                <p class="eyebrow">Control panel / usuarios</p>
                <h1>Gestión de usuarios</h1>
                <p class="subtitle">Administra cuentas, roles y permisos desde un único panel.</p>
            </div>
            <a class="btn btn-primary" href="index.php?action=create">+ Agregar Usuario</a>
        </header>

        <?php if ($success): ?>
            <div class="alert alert-success">Operación realizada correctamente.</div>
        <?php endif; ?>

        <section class="card table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nombre</th><th>Apellido</th><th>Usuario</th>
                        <th>Email</th><th>Rol</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($users === []): ?>
                        <tr><td colspan="7" class="empty-state"><strong>No hay usuarios registrados</strong>La tabla está lista para recibir el primer registro.</td></tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td data-label="ID" class="technical">USR-<?= str_pad((string) $user->id, 3, '0', STR_PAD_LEFT) ?></td>
                                <td data-label="Nombre"><?= htmlspecialchars($user->firstName, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Apellido"><?= htmlspecialchars($user->lastName, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Usuario"><?= htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Email" class="email"><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?></td>
                                <td data-label="Rol"><span class="badge"><?= htmlspecialchars($user->roleName ?? '', ENT_QUOTES, 'UTF-8') ?></span></td>
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
