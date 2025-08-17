<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Producto al Carrito</title>
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
    margin-top: 15px;
    font-weight: bold;
    color: #555;
}
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    margin-top: 20px;
    width: 100%;
    background-color: #2575fc;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
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
    <h2>Agregar Producto al Carrito</h2>
    <div id="messageContainer"></div>

    <form id="addProductForm">
        <label for="id_person">Persona:</label>
        <select name="id_person" id="id_person" required>
            <option value="">Seleccione una persona</option>
            <?php foreach ($persons as $person): ?>
                <option value="<?= htmlspecialchars($person->id) ?>">
                    <?= htmlspecialchars($person->full_name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_product">Producto:</label>
        <select name="id_product" id="id_product" required>
            <option value="">Seleccione un producto</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= htmlspecialchars($product->id) ?>">
                    <?= htmlspecialchars($product->name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Agregar al Carrito</button>
    </form>
</div>

<script>
const form = document.getElementById('addProductForm');
const messageContainer = document.getElementById('messageContainer');

function showMessage(type, message) {
    const messageBox = document.createElement('div');
    messageBox.className = `message-box ${type}`;
    const icon = type === 'success' ? '✅' : '⚠️';
    const title = type === 'success' ? '¡Éxito!' : 'Error:';
    messageBox.innerHTML = `<strong>${icon} ${title}</strong> ${message}`;
    messageContainer.innerHTML = ''; // Limpiar mensajes anteriores
    messageContainer.appendChild(messageBox);
    if (type === 'success') {
        setTimeout(() => {
            messageBox.style.opacity = '0';
            messageBox.style.transform = 'translateY(-10px)';
            setTimeout(() => messageBox.remove(), 500);
        }, 5000);
    }
}

form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch('/shoppingCar/addProduct', {
        method: 'POST',
        body: formData
    })
    .then(async response => {
        const data = await response.json();
        if (!response.ok) throw new Error(data.message || 'Error desconocido');
        showMessage('success', data.message);
        form.reset();
    })
    .catch(error => {
        showMessage('error', error.message);
    });
});
</script>
</body>
</html>
