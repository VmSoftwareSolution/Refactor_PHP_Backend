<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar User</title>
</head>
<body>
    <h2>Editar User</h2>
    <form action="/user/update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id) ?>">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($user->email) ?>" required><br>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="<?= htmlspecialchars($user->password) ?>" required><br>

        <label for="role_id">ROL:</label>
        <input type="text" id="role_id" name="role_id" value="<?= htmlspecialchars($user->role_id) ?>" required><br>


        <button type="submit">Actualizar User</button>
    </form>
</body>
</html>
