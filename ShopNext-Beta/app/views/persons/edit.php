<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Persona</title>
</head>
<body>
    <h1>Editar Persona #<?= htmlspecialchars($person->id) ?></h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="/persons/update" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($person->id) ?>">
        <label>Nombre completo: <input type="text" name="full_name" value="<?= htmlspecialchars($person->full_name) ?>" required></label><br>
        <label>Teléfono: <input type="text" name="phone" value="<?= htmlspecialchars($person->phone) ?>"></label><br>
        <label>Género:
            <select name="gender">
                <option value="male" <?= $person->gender === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= $person->gender === 'female' ? 'selected' : '' ?>>Female</option>
                <option value="other" <?= $person->gender === 'other' ? 'selected' : '' ?>>Other</option>
            </select>
        </label><br>
        <label>Fecha de nacimiento: <input type="date" name="date_of_birth" value="<?= htmlspecialchars($person->date_of_birth) ?>"></label><br>
        <label>Avatar URL: <input type="text" name="avatar" value="<?= htmlspecialchars($person->avatar) ?>"></label><br>
        <label>ID Usuario: <input type="number" name="id_user" value="<?= htmlspecialchars($person->id_user) ?>" required></label><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="/persons/findById?id=<?= htmlspecialchars($person->id) ?>">Cancelar</a>
</body>
</html>
