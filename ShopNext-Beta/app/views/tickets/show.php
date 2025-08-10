<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del ticket</title>
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
        <h2>Información del ticket</h2>

        <div>
            <div class="label">ID:</div>
            <div class="value"><?= htmlspecialchars($ticket->id) ?></div>
        </div>

        <div>
            <div class="label">titulo:</div>
            <div class="value"><?= htmlspecialchars($ticket->tittle) ?></div>
        </div>

        <div>
            <div class="label">mensaje:</div>
            <div class="value"><?= htmlspecialchars($ticket->message) ?></div>
        </div>

        <div>
            <div class="label">prioridad:</div>
            <div class="value"><?= htmlspecialchars($ticket->priority) ?></div>
        </div>

        <div>
            <div class="label">estado:</div>
            <div class="value"><?= htmlspecialchars($ticket->status) ?></div>
        </div>

        <div>
            <div class="label">id_persona:</div>
            <div class="value"><?= htmlspecialchars($ticket->id_person) ?></div>
        </div>

        <div>
            <div class="label">Creado el:</div>
            <div class="value"><?= htmlspecialchars($ticket->created_at) ?></div>
        </div>

    </div>
</body>
</html>
