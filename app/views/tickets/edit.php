<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Ticket</title>
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
    width: 500px;
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
input[type="text"], input[type="number"], select {
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
.message-box.error {
    background: #ffe0e0;
    color: #900;
}
.message-box.success {
    background: #e8f5e8;
    color: #2e7d32;
}
input.error, select.error {
    border-color: #e74c3c;
}
</style>
</head>
<body>
<div class="container">
    <h2>Editar Ticket</h2>
    <div id="messageContainer"></div>

    <form id="editTicketForm" action="/tickets/update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($ticket->id) ?>">

        <label for="tittle">Título</label>
        <input type="text" name="tittle" id="tittle" value="<?= htmlspecialchars($ticket->tittle) ?>" required>

        <label for="message">Mensaje</label>
        <input type="text" name="message" id="message" value="<?= htmlspecialchars($ticket->message) ?>">

        <label for="priority">Prioridad</label>
        <select name="priority" id="priority" required>
            <option value="low" <?= $ticket->priority === 'low' ? 'selected' : '' ?>>Baja</option>
            <option value="medium" <?= $ticket->priority === 'medium' ? 'selected' : '' ?>>Media</option>
            <option value="high" <?= $ticket->priority === 'high' ? 'selected' : '' ?>>Alta</option>
        </select>

        <label for="status">Estado</label>
        <select name="status" id="status" required>
            <option value="open" <?= $ticket->status === 'open' ? 'selected' : '' ?>>Abierto</option>
            <option value="in_progress" <?= $ticket->status === 'in_progress' ? 'selected' : '' ?>>En Progreso</option>
            <option value="closed" <?= $ticket->status === 'closed' ? 'selected' : '' ?>>Cerrado</option>
        </select>

        <label for="id_person">Persona</label>
        <select id="id_person" name="id_person" required>
            <option value="">-- Seleccione una persona --</option>
            <?php foreach ($persons as $person): ?>
                <option value="<?= htmlspecialchars($person->id) ?>"
                    <?= $ticket->id_person == $person->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($person->full_name) ?>
                </option>
            <?php endforeach; ?>
        </select>


        <label>Creado el</label>
        <div style="padding:10px; background:#f4f4f4; border-radius:8px;"><?= htmlspecialchars($ticket->created_at) ?></div>

        <button type="submit" id="submitBtn">Actualizar Ticket</button>
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
    submitBtn.textContent = 'Actualizando ticket...';
    form.classList.add('loading');

    try {
        const response = await fetch(form.action, { method: 'POST', body: formData });
        const result = await response.json();

        if (response.ok && result.status === 200) {
            showMessage('success', result.message || 'Ticket actualizado exitosamente');
            clearInputErrors();
        } else {
            showMessage('error', result.message || 'Error al actualizar el ticket');
            highlightErrorFields(result.errors || {});
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Actualizar Ticket';
        form.classList.remove('loading');
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
        }, 5000);
    }
}

function clearInputErrors() {
    document.querySelectorAll('input.error, select.error').forEach(el => el.classList.remove('error'));
}

function highlightErrorFields(errors) {
    Object.keys(errors).forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field) field.classList.add('error');
    });
}
</script>
</body>
</html>
