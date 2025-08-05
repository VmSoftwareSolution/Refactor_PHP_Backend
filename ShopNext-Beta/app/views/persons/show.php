<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ver Persona</title>
</head>
<body>
    <h1>Persona #<?= htmlspecialchars($person->id) ?></h1>
    <p><strong>Nombre completo:</strong> <?= htmlspecialchars($person->full_name) ?></p>
    <p><strong>Teléfono:</strong> <?= htmlspecialchars($person->phone) ?></p>
    <p><strong>Género:</strong> <?= htmlspecialchars($person->gender) ?></p>
    <p><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($person->date_of_birth) ?></p>
    <p><strong>Avatar:</strong> <?= htmlspecialchars($person->avatar) ?></p>
    <p><strong>Usuario asociado:</strong> <?= htmlspecialchars($person->id_user) ?></p>
    <p><strong>Creado en:</strong> <?= htmlspecialchars($person->create_at) ?></p>

    <a href="/persons/edit?id=<?= $person->id ?>">Editar</a> |
    <a href="/persons">Volver al listado</a>
</body>
</html>
