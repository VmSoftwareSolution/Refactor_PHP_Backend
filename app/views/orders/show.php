<?php if (!$order): ?>
<div class="container">
    <h2>Detalle de la Orden</h2>
    <div class="message-box error">No se encontró la orden.</div>
</div>
<?php return; endif; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Detalle de la Orden</title>
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
h2, h3 {
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
    margin-bottom: 10px;
    color: #333;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}
table thead {
    background-color: #2575fc;
    color: #fff;
}
table tr:nth-child(even) {
    background-color: #f8f9fa;
}
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    font-family: inherit;
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
    margin-top: 15px;
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
<div class="container">
    <h2>Detalle de la Orden</h2>

    <div class="label">ID Orden:</div>
    <div class="value"><?= htmlspecialchars($order->id ?? 'N/A') ?></div>

    <div class="label">ID Persona:</div>
    <div class="value"><?= htmlspecialchars($order->id_person ?? 'N/A') ?></div>

    <div class="label">Fecha de Creación:</div>
    <div class="value"><?= htmlspecialchars($order->created_at ?? 'N/A') ?></div>

    <h3>Productos</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($order->products) && is_array($order->products)): ?>
            <?php foreach ($order->products as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['name'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['quantity'] ?? 0) ?></td>
                    <td>$<?= number_format($p['price'] ?? 0, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3" style="text-align:center;">No hay productos</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="label">Total:</div>
    <div class="value"><strong>$<?= number_format($order->total_price ?? 0, 2) ?></strong></div>

    <form id="updateForm" action="/orders/updateStatus" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($order->id ?? '') ?>">

        <label for="status" class="label">Estado de la orden:</label>
        <select id="status" name="status" required>
            <option value="open" <?= ($order->status ?? '') === 'open' ? 'selected' : '' ?>>En espera</option>
            <option value="in_progress" <?= ($order->status ?? '') === 'in_progress' ? 'selected' : '' ?>>Pagando</option>
            <option value="closed" <?= ($order->status ?? '') === 'closed' ? 'selected' : '' ?>>Completada</option>
        </select>

        <button type="submit">Actualizar Orden</button>
    </form>

    <div id="messageContainer"></div>
</div>

<script>
const form = document.getElementById('updateForm');
const messageContainer = document.getElementById('messageContainer');

form.addEventListener('submit', async e => {
    e.preventDefault();
    messageContainer.innerHTML = '';
    const submitBtn = form.querySelector('button');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Actualizando...';

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        const result = await response.json();

        const div = document.createElement('div');
        div.className = 'message-box ' + (response.ok ? 'success' : 'error');
        div.textContent = result.message || (response.ok ? 'Orden actualizada correctamente' : 'Error al actualizar');
        window.location.href = 'http://localhost:8000/orders/list';
        messageContainer.appendChild(div);
    } catch (error) {
        const div = document.createElement('div');
        div.className = 'message-box error';
        div.textContent = 'Error de conexión con el servidor';
        messageContainer.appendChild(div);
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Actualizar Orden';
    }
});
</script>
<script src="/js/sessionCheck.js"></script>
</body>
</html>
