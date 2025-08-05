<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar User</title>
</head>
<body>
    <h2>Editar User</h2>
    <form action="/user/changePassword" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id) ?>">

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="<?= htmlspecialchars($user->password) ?>" required><br>

        <button type="submit">Actualizar User</button>
    </form>
</body>
</html>
