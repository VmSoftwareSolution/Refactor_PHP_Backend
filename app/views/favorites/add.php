<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Producto a Favoritos</title>
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
select, input[type="number"] {
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
    <h2>Agregar Producto a Mis Favoritos</h2>
    <div id="messageContainer"></div>

    <form action="/favorites/addFavorite" method="post">
    <label for="id_person">Selecciona Persona:</label>
    <select id="id_person" name="id_person" required>
        <?php foreach ($persons as $person): ?>
            <option value="<?= htmlspecialchars($person->id) ?>">
                <?= htmlspecialchars($person->full_name) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="id_product">Selecciona Producto:</label>
    <select id="id_product" name="id_product" required>
        <?php foreach ($products as $product): ?>
            <option value="<?= htmlspecialchars($product->id) ?>">
                <?= htmlspecialchars($product->name) ?> - $<?= htmlspecialchars($product->price) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Agregar a Favoritos</button>
</form>

</div>

<script>
const form = document.querySelector('form'); // selecciona tu único form
const messageContainer = document.getElementById('messageContainer');

function showMessage(type, message) {
    const messageBox = document.createElement('div');
    messageBox.className = `message-box ${type}`;
    const icon = type === 'success' ? '✅' : '⚠️';
    const title = type === 'success' ? '¡Éxito!' : 'Error:';
    messageBox.innerHTML = `<strong>${icon} ${title}</strong> ${message}`;
    messageContainer.innerHTML = ''; 
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

    fetch('/favorites/addFavorite', { 
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
