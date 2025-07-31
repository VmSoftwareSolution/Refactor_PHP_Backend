<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Rol</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background-color: #f9f9f9;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            max-width: 500px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .label {
            font-weight: bold;
            margin-top: 1rem;
            color: #555;
        }
        .value {
            margin-bottom: 1rem;
            font-size: 1.1em;
            color: #333;
        }
        .actions {
            margin-top: 2rem;
            text-align: center;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Información del Rol</h2>

        <div>
            <div class="label">ID:</div>
            <div class="value"><?= htmlspecialchars($role->id) ?></div>
        </div>

        <div>
            <div class="label">Nombre:</div>
            <div class="value"><?= htmlspecialchars($role->name) ?></div>
        </div>

        <div>
            <div class="label">Descripción:</div>
            <div class="value"><?= htmlspecialchars($role->description) ?></div>
        </div>

        <div class="actions">
            <form action="/role/delete" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este rol?');">
                <input type="hidden" name="id" value="<?= htmlspecialchars($role->id) ?>">
                <button type="submit" class="btn-delete">Eliminar Rol</button>
            </form>
        </div>
    </div>
</body>
</html>
