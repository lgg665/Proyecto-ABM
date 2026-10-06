<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ABM Usuarios</title>

    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>

<body>

<div class="container">

    <div class="system-bar">
        <span class="system-mark">
            <span class="status-dot"></span>
            ABM // USER MANAGEMENT
        </span>

        <span>DATABASE / ONLINE</span>
    </div>

    <header class="header">
        <div>
            <p class="eyebrow">Control panel / usuarios</p>

            <h1>Gestión de usuarios</h1>

            <p class="subtitle">
                Administra cuentas, roles y permisos desde un único panel.
            </p>
        </div>

        <a
            class="btn btn-primary"
            href="<?= site_url('users/create') ?>"
        >
            + Agregar Usuario
        </a>
    </header>


    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-error">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>

    <?php endif; ?>


    <section class="card table-card">

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
                        <td colspan="7" class="empty-state">
                            <strong>No hay usuarios registrados</strong>
                            La tabla está lista para recibir el primer registro.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($users as $user): ?>

                        <tr>

                            <td data-label="ID" class="technical">
                                USR-<?= str_pad(
                                    (string) $user['id'],
                                    3,
                                    '0',
                                    STR_PAD_LEFT
                                ) ?>
                            </td>

                            <td data-label="Nombre">
                                <?= esc($user['first_name']) ?>
                            </td>

                            <td data-label="Apellido">
                                <?= esc($user['last_name']) ?>
                            </td>

                            <td data-label="Usuario">
                                <?= esc($user['username']) ?>
                            </td>

                            <td data-label="Email" class="email">
                                <?= esc($user['email']) ?>
                            </td>

                            <td data-label="Rol">
                                <span class="badge">
                                    <?= esc($user['role_name'] ?? '') ?>
                                </span>
                            </td>

                            <td class="actions">

                                <a
                                    class="btn btn-secondary"
                                    href="<?= site_url(
                                        'users/edit/' . $user['id']
                                    ) ?>"
                                >
                                    Editar
                                </a>

                                <form
                                    action="<?= site_url(
                                        'users/delete/' . $user['id']
                                    ) ?>"
                                    method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');"
                                >
                                    <?= csrf_field() ?>

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        Eliminar
                                    </button>
                                </form>

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