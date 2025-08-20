<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Detalle del Pago</title>
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    margin: 0;
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
.label {
    font-weight: bold;
    color: #555;
    margin-top: 10px;
    display: block;
}
.value {
    color: #333;
    margin-bottom: 0.8rem;
}
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
}
select:focus {
    outline: none;
    border-color: #2575fc;
    box-shadow: 0 0 5px rgba(37,117,252,0.5);
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
    transition: background 0.3s ease;
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
</style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
<div class="container">
    <h2>Detalle del Pago</h2>

    <div id="messageContainer"></div>

    <div class="info">
        <span class="label">ID PAGO:</span>
        <span class="value"><?= htmlspecialchars($payload->id) ?></span>

        <span class="label">ID ORDEN:</span>
        <span class="value"><?= htmlspecialchars($payload->id_order) ?></span>

        <span class="label">METODO:</span>
        <span class="value"><?= htmlspecialchars($payload->method) ?></span>

        <span class="label">PAGADO EL:</span>
        <span class="value"><?= htmlspecialchars($payload->payment_at) ?></span>
    </div>

    <form id="updatePaymentForm" action="/payloads/updateStatus" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($payload->id) ?>">

        <label for="status" class="label">Estado del pago:</label>
        <select id="status" name="status" required>
            <option value="canceled" <?= $payload->status == 'canceled' ? 'selected' : '' ?>>CANCELADO</option>
            <option value="in_progress" <?= $payload->status == 'in_progress' ? 'selected' : '' ?>>EN PROGRESO</option>
            <option value="complete" <?= $payload->status == 'complete' ? 'selected' : '' ?>>PAGADO</option>
        </select>

        <button type="submit" id="submitBtn">Actualizar Pago</button>
    </form>
</div>

<script>
document.getElementById('updatePaymentForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = document.getElementById('submitBtn');
    const messageContainer = document.getElementById('messageContainer');
    const formData = new FormData(form);

    messageContainer.innerHTML = '';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Actualizando...';
    form.classList.add('loading');

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (response.ok && result.status === 200) {
            showMessage('success', result.message || 'Pago actualizado correctamente');
        } else {
            showMessage('error', result.message || 'Error al actualizar el pago');
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Actualizar Pago';
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
</script>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>
