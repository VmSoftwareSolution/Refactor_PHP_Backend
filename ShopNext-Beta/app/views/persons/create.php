<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear Persona</title>
</head>
<body>
    <h1>Crear Persona</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="/persons/createPerson" method="post">
        <label>Nombre completo: <input type="text" name="full_name" required></label><br>
        <label>Teléfono: <input type="text" name="phone"></label><br>
        <label>Género:
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other" selected>Other</option>
            </select>
        </label><br>
        <label>Fecha de nacimiento: <input type="date" name="date_of_birth"></label><br>
        <label>Avatar URL: <input type="text" name="avatar"></label><br>
        <label>ID Usuario: <input type="number" name="id_user" required></label><br>
        <button type="submit">Crear</button>
    </form>
    <a href="/persons">Cancelar</a>
</body>
</html>
