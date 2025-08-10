<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ticket</title>
</head>
<body>
    <h2>Editar Ticket</h2>
    <form action="/tickets/update" method="POST">
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

        <label for="priority">Prioridad:</label>
        <select id="priority" name="priority" required>
            <option value="low" <?= $ticket->priority = 'low' ? 'selected' : '' ?>>Baja</option>
            <option value="medium" <?= $ticket->priority = 'medium' ? 'selected' : '' ?>>Media</option>
            <option value="high" <?= $ticket->priority = 'high' ? 'selected' : '' ?>>Alta</option>
        </select><br>

        <label for="status">Estado:</label>
        <select id="status" name="status" required>
            <option value="open" <?= $ticket->status === 'open' ? 'selected' : '' ?>>Abierto</option>
            <option value="in_progress" <?= $ticket->status === 'in_progress' ? 'selected' : '' ?>>En Progreso</option>
            <option value="closed" <?= $ticket->status === 'closed' ? 'selected' : '' ?>>Cerrado</option>
        </select><br>

        <div>
            <div class="label">id_persona:</div>
            <div class="value"><?= htmlspecialchars($ticket->id_person) ?></div>
        </div>

        <div>
            <div class="label">Creado el:</div>
            <div class="value"><?= htmlspecialchars($ticket->created_at) ?></div>
        </div>
        <button type="submit">Actualizar ticket</button>
    </form>
</body>
</html>
