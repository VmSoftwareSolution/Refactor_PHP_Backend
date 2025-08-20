<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Tickets</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    margin: 0;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}
#messageContainer {
    width: 100%;
    max-width: 1200px;
    margin-bottom: 20px;
}
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    width: 100%;
    max-width: 1200px;
}
.card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    width: 300px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card h3 {
    margin: 0 0 10px 0;
    color: #333;
    text-align: center;
}
.card .label {
    font-weight: bold;
    color: #555;
    margin-top: 5px;
}
.card .value {
    margin-bottom: 10px;
    color: #333;
}
.card button {
    padding: 10px;
    margin-top: 10px;
    background: #2575fc;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.3s ease;
}
.card button:hover {
    background: #1a5edb;
}

.back-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 18px;
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}
.back-btn:hover {
    background: linear-gradient(135deg, #1a5edb, #4a0fa3);
    transform: scale(1.05);
}

.message-box {
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
}
.message-box.error { background: #ffe0e0; color: #900; }
.message-box.success { background: #e8f5e8; color: #2e7d32; }
</style>
</head>
<body>

<div id="messageContainer"></div>

<div class="back-container">
    <a href="http://localhost:8000/admin" class="back-btn">⬅ Back</a>
</div>

<div class="container">
<?php foreach ($tickets as $ticket): ?>
    <div class="card">
        <h3>Ticket #<?= htmlspecialchars($ticket->id) ?></h3>

        <div class="label">Título:</div>
        <div class="value"><?= htmlspecialchars($ticket->tittle) ?></div>
        
        <div class="label">Mensaje:</div>
        <div class="value"><?= htmlspecialchars($ticket->message) ?></div>
        
        <div class="label">Prioridad:</div>
        <div class="value"><?= htmlspecialchars($ticket->priority) ?></div>
        
        <div class="label">Estado:</div>
        <div class="value"><?= htmlspecialchars($ticket->status) ?></div>
        
        <div class="label">ID Persona:</div>
        <div class="value"><?= htmlspecialchars($ticket->id_person) ?></div>
        
        <div class="label">Creado el:</div>
        <div class="value"><?= htmlspecialchars($ticket->created_at) ?></div>

        <!-- Botón de Editar -->
        <form action="/tickets/edit" method="GET">
            <input type="hidden" name="id" value="<?= htmlspecialchars($ticket->id) ?>">
            <button type="submit">Editar</button>
        </form>
    </div>
<?php endforeach; ?>
</div>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>
