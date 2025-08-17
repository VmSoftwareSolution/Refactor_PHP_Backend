<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Envío</title>
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
    width: 400px;
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
}
.value {
    color: #333;
    margin-bottom: 10px;
}
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    font-family: inherit;
    box-sizing: border-box;
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
select.error {
    border-color: #e74c3c;
}
</style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
<div class="container">
    <h2>Editar Envío</h2>

    <div id="messageContainer"></div>

    <div>
        <div class="label">ID:</div>
        <div class="value"><?= htmlspecialchars($shipment->id) ?></div>

        <div class="label">Orden ID:</div>
        <div class="value"><?= htmlspecialchars($shipment->id_order) ?></div>

        <div class="label">Dirección:</div>
        <div class="value"><?= htmlspecialchars($shipment->address) ?></div>
    </div>

    <form id="updateShipmentForm" action="/shipments/updateStatus" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($shipment->id) ?>">

        <label for="status">Estado:</label>
        <select id="status" name="status" required>
            <option value="pending" <?= $shipment->status == 'pending' ? 'selected' : '' ?>>PENDIENTE</option>
            <option value="shipped" <?= $shipment->status == 'shipped' ? 'selected' : '' ?>>EN CAMINO...</option>
            <option value="delivered" <?= $shipment->status == 'delivered' ? 'selected' : '' ?>>ENTREGADO</option>
        </select>

        <button type="submit" id="submitBtn">Actualizar Envío</button>
    </form>

    <div class="label" style="margin-top: 20px;">Creado el:</div>
    <div class="value"><?= htmlspecialchars($shipment->created_at) ?></div>
</div>

<script>
document.getElementById('updateShipmentForm').addEventListener('submit', async function(e) {
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
            showMessage('success', result.message || 'Envío actualizado correctamente');
            clearInputErrors();
        } else {
            showMessage('error', result.message || 'Error al actualizar el envío');
            highlightErrorFields(result.errors || {});
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Actualizar Envío';
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
    document.querySelectorAll('select.error').forEach(el => el.classList.remove('error'));
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
