<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Estado del Ticket</title>
<style>
body {
    display: flex;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    margin: 0;
    padding: 2rem;
}
.container {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    width: 400px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}
label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #555;
}
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    background: #fff;
    font-family: inherit;
}
button {
    padding: 12px;
    margin-top: 20px;
    background: #2575fc;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    width: 100%;
    font-size: 1rem;
}
button:hover {
    background: #1a5edb;
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
<div class="container">
    <h2>Editar Estado del Ticket</h2>
    <div id="messageContainer"></div>

    <form id="editTicketForm" action="/tickets/update" method="POST">
        <!-- Campos ocultos con el resto de datos -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($ticket->id) ?>">
        <input type="hidden" name="tittle" value="<?= htmlspecialchars($ticket->tittle) ?>">
        <input type="hidden" name="message" value="<?= htmlspecialchars($ticket->message) ?>">
        <input type="hidden" name="priority" value="<?= htmlspecialchars($ticket->priority) ?>">
        <input type="hidden" name="id_person" value="<?= htmlspecialchars($ticket->id_person) ?>">
        <input type="hidden" name="created_at" value="<?= htmlspecialchars($ticket->created_at) ?>">

        <!-- Solo el estado es editable -->
        <label for="status">Estado</label>
        <select name="status" id="status" required>
            <option value="open" <?= $ticket->status === 'open' ? 'selected' : '' ?>>Abierto</option>
            <option value="in_progress" <?= $ticket->status === 'in_progress' ? 'selected' : '' ?>>En Progreso</option>
            <option value="closed" <?= $ticket->status === 'closed' ? 'selected' : '' ?>>Cerrado</option>
        </select>

        <button type="submit" id="submitBtn">Actualizar Estado</button>
    </form>
</div>

<script>
document.getElementById('editTicketForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = document.getElementById('submitBtn');
    const messageContainer = document.getElementById('messageContainer');
    const formData = new FormData(form);

    messageContainer.innerHTML = '';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Actualizando...';

    try {
        const response = await fetch(form.action, { method: 'POST', body: formData });
        const result = await response.json();

        if (response.ok && result.status === 200) {
            showMessage('success', result.message || 'Estado actualizado exitosamente');
            setTimeout(() => {
                window.location.href = '/tickets/list';
            }, 1000);
        } else {
            showMessage('error', result.message || 'Error al actualizar el estado');
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Actualizar Estado';
    }
});

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
        }, 3000);
    }
}
</script>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>
