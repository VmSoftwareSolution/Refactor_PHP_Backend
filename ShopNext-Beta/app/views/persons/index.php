<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Personas</title>
</head>
<body>
    <h1>Personas</h1>
    <a href="/persons/create">Crear nueva persona</a>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($persons as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p->id) ?></td>
                    <td><?= htmlspecialchars($p->full_name) ?></td>
                    <td><?= htmlspecialchars($p->id_user) ?></td>
                    <td>
                        <a href="/persons/findById?id=<?= $p->id ?>">Ver</a> |
                        <a href="/persons/edit?id=<?= $p->id ?>">Editar</a> |
                        <form action="/persons/delete" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $p->id ?>">
                            <button type="submit" onclick="return confirm('Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
