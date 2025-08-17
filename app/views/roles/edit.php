<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Rol</title>
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
}
.container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    width: 400px;
    text-align: center;
    position: relative;
}
h2 {
    margin-bottom: 25px;
    color: #333;
}
label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}
input[type="text"], textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}
input:focus, textarea:focus {
    border-color: #2575fc;
    box-shadow: 0 0 5px rgba(37,117,252,0.5);
    outline: none;
}
button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #2575fc;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}
button:hover {
    background: #6a11cb;
}
button:disabled {
    background: #ccc;
    cursor: not-allowed;
}
input.error, textarea.error {
    border-color: #ff4b5c !important;
    box-shadow: 0 0 5px rgba(255, 75, 92, 0.5) !important;
}
.message-box {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    text-align: left;
    animation: slideDown 0.5s ease-in-out;
}
.message-box.error {
    background: #ffe0e0;
    border-left: 5px solid #ff4b5c;
    color: #900;
}
.message-box.success {
    background: #e8f5e8;
    border-left: 5px solid #4caf50;
    color: #2e7d32;
}
.message-box strong {
    font-weight: bold;
}
@keyframes slideDown {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
}
.loading {
    opacity: 0.7;
}
</style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
<div class="container">
    <h2>Editar Rol</h2>
    <div id="messageContainer"></div>
    <form id="editRoleForm" action="/role/update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($role->id) ?>">

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($role->name) ?>" required>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description"><?= !empty($role->description) ? htmlspecialchars($role->description) : '' ?></textarea>

        <button type="submit" id="submitBtn">Actualizar Rol</button>
    </form>
</div>

<script>
document.getElementById('editRoleForm').addEventListener('submit', async function(e) {
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
        const response = await fetch(form.action, { method: 'POST', body: formData });
        const result = await response.json();

        if (response.ok && result.status === 200) {
            showMessage('success', result.message || 'Rol actualizado exitosamente');
            clearInputErrors();
        } else {
            showMessage('error', result.message || 'Error al actualizar el rol');
            highlightErrorFields(result.errors || {});
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Actualizar Rol';
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
    document.querySelectorAll('input.error, textarea.error').forEach(input => input.classList.remove('error'));
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
