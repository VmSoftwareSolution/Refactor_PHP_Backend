<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Producto</title>
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
    margin-bottom: 10px;
    color: #555;
    font-weight: bold;
}
input[type="text"], input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-top: 4px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    background-color: #2575fc;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    margin-top: 15px;
    width: 100%;
}
button:hover {
    background-color: #1a5edb;
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
    <h1>Crear Producto</h1>

    <div id="messageContainer"></div>

    <?php if (!empty($error)): ?>
        <div class="message-box error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form id="createProductForm" action="/products/createProduct" method="post">
        <label>Nombre del producto:
            <input type="text" name="name" required>
        </label>

        <label>Descripción:
            <input type="text" name="description">
        </label>

        <label>Precio:
            <input type="number" name="price" step="0.01">
        </label>

        <label>Stock:
            <input type="number" name="stock">
        </label>

        <label>Categoría:
            <input type="text" name="category">
        </label>

        <label>URL Imagen:
            <input type="text" name="image">
        </label>

        <button type="submit" id="submitBtn">Crear Producto</button>
    </form>
</div>

<script>
document.getElementById('createProductForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = document.getElementById('submitBtn');
    const messageContainer = document.getElementById('messageContainer');
    const formData = new FormData(form);
    messageContainer.innerHTML = '';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creando producto...';
    form.classList.add('loading');

    try {
        const response = await fetch('/products/createProduct', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (response.ok && result.status === 201) {
            showMessage('success', result.message || 'Producto creado exitosamente');
            window.location.href = 'http://localhost:8000/products/list';
            form.reset();
        } else {
            showMessage('error', result.message || 'Error al crear el producto');
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Crear Producto';
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
</body>
</html>
