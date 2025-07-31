<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Rol</title>
</head>
<body>
    <h2>Editar Rol</h2>
    <form action="/role/update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($role->id) ?>">

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($role->name) ?>" required><br>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($role->description) ?></textarea><br>

        <button type="submit">Actualizar Rol</button>
    </form>
</body>
</html>
