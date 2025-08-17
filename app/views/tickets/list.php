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
    justify-content: center;
}
.container {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    width: 90%;
    max-width: 900px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
th {
    background-color: #2575fc;
    color: #fff;
}
tr:hover {
    background-color: #f4f4f4;
}
.btn-view, .btn-edit, .btn-delete {
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    margin-right: 5px;
}
.btn-view { background-color: #2e7d32; }
.btn-view:hover { background-color: #1b4d1b; }
.btn-edit { background-color: #2575fc; }
.btn-edit:hover { background-color: #1a5edb; }
.btn-delete { background-color: #e74c3c; }
.btn-delete:hover { background-color: #c0392b; }
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
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
<div class="container">
    <h2>Lista de Tickets</h2>
    <div id="messageContainer"></div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Mensaje</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>ID Persona</th>
                <th>Creado el</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?= htmlspecialchars($ticket->id) ?></td>
                <td><?= htmlspecialchars($ticket->tittle) ?></td>
                <td><?= htmlspecialchars($ticket->message) ?></td>
                <td><?= htmlspecialchars($ticket->priority) ?></td>
                <td><?= htmlspecialchars($ticket->status) ?></td>
                <td><?= htmlspecialchars($ticket->id_person) ?></td>
                <td><?= htmlspecialchars($ticket->created_at) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function showMessage(type, message) {
    const messageContainer = document.getElementById('messageContainer');
    const messageBox = document.createElement('div');
    messageBox.className = `message-box ${type}`;
    const icon = type === 'success' ? '✅' : '⚠️';
    const title = type === 'success' ? '¡Éxito!' : 'Error:';
    messageBox.innerHTML = `<strong>${icon} ${title}</strong> ${message}`;
    messageContainer.appendChild(messageBox);
    if (type === 'success') {
        setTimeout(() => {
            messageBox.style.opacity = '0';
            messageBox.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                if (messageBox.parentNode) messageBox.parentNode.removeChild(messageBox);
            }, 500);
        }, 5000);
    }
}
</script>
</body>
</html>
