<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Producto</title>
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
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}
label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: bold;
}
input[type="text"], input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 12px;
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
    margin-top: 10px;
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
    <h2>Editar Producto</h2>

    <div id="messageContainer"></div>

    <?php if (!empty($error)): ?>
        <div class="message-box error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form id="editProductForm" action="/products/update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product->id) ?>">

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product->name) ?>" required>

        <label for="description">Descripción:</label>
        <input type="text" id="description" name="description" value="<?= htmlspecialchars($product->description) ?>" required>

        <label for="price">Precio:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product->price) ?>" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($product->stock) ?>" required>

        <label for="category">Categoría:</label>
        <input type="text" id="category" name="category" value="<?= htmlspecialchars($product->category) ?>" required>

        <label for="image">URL Imagen:</label>
        <input type="text" id="image" name="image" value="<?= htmlspecialchars($product->image) ?>" required>

        <button type="submit" id="submitBtn">Actualizar Producto</button>
    </form>
</div>

<script>
document.getElementById('editProductForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = document.getElementById('submitBtn');
    const messageContainer = document.getElementById('messageContainer');
    const formData = new FormData(form);
    messageContainer.innerHTML = '';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Actualizando producto...';
    form.classList.add('loading');

    try {
        const response = await fetch('/products/update', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();
        if (response.ok && result.status === 200) {
            showMessage('success', result.message || 'Producto actualizado exitosamente');
            window.location.href = 'http://localhost:8000/products/list';
        } else {
            showMessage('error', result.message || 'Error al actualizar el producto');
        }
    } catch (error) {
        showMessage('error', 'Error de conexión. Intenta nuevamente.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Actualizar Producto';
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
