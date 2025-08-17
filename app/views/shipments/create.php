<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Entrega</title>
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
h1 {
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
input[type="number"],
input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    font-family: inherit;
    box-sizing: border-box;
}
input:focus {
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
input.error {
    border-color: #e74c3c;
}
</style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
<div class="container">
    <h1>Crear Entrega</h1>

    <div id="messageContainer"></div>

    <form id="createShipmentForm" action="/shipments/createShipment" method="POST">
        <label for="id_order">ID Orden:</label>
        <input type="number" id="id_order" name="id_order" required>

        <label for="address">Dirección:</label>
        <input type="text" id="address" name="address" required>

        <button type="submit" id="submitBtn">Crear Entrega</button>
    </form>
</div>

<script>
document.getElementById('createShipmentForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = document.getElementById('submitBtn');
    const messageContainer = document.getElementById('messageContainer');
    const formData = new FormData(form);

    messageContainer.innerHTML = '';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creando entrega...';
    form.classList.add('loading');

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (response.ok && result.status === 201) {
            showMessage('success', result.message || 'Entrega creada exitosamente');
            form.reset();
            clearInputErrors();
        } else {
            showMessage('error', result.message || 'Error al crear la entrega');
            highlightErrorFields(result.errors || {});
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Crear Entrega';
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
    document.querySelectorAll('input.error').forEach(input => input.classList.remove('error'));
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
