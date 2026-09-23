<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $mode === 'edit' ? 'Editar Usuario' : 'Crear Usuario' ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container small">
        <header class="header">
            <h1><?= $mode === 'edit' ? 'Editar Usuario' : 'Crear Usuario' ?></h1>
            <a class="btn btn-secondary" href="index.php">Volver</a>
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

        <form method="POST" class="card form-card" action="index.php?action=<?= $mode === 'edit' ? 'update&id=' . $id : 'create' ?>">
            <?php if ($mode === 'edit'): ?><input type="hidden" name="id" value="<?= $id ?>"><?php endif; ?>
            <div class="field-group"><label for="first_name">Nombre</label><input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($formData['first_name'], ENT_QUOTES, 'UTF-8') ?>" required></div>
            <div class="field-group"><label for="last_name">Apellido</label><input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($formData['last_name'], ENT_QUOTES, 'UTF-8') ?>" required></div>
            <div class="field-group"><label for="username">Usuario</label><input type="text" id="username" name="username" value="<?= htmlspecialchars($formData['username'], ENT_QUOTES, 'UTF-8') ?>" required></div>
            <div class="field-group"><label for="email">Email</label><input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8') ?>" required></div>
            <div class="field-group">
                <label for="role_id">Rol</label>
                <select id="role_id" name="role_id" required>
                    <?php if ($mode === 'create'): ?><option value="">Seleccione un rol</option><?php endif; ?>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role->id ?>" <?= ((string) $role->id === (string) $formData['role_id']) ? 'selected' : '' ?>><?= htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><?= $mode === 'edit' ? 'Actualizar' : 'Guardar' ?></button>
        </form>
    </div>
</body>
</html>
