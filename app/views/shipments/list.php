<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Envíos</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    margin: 0;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}
#messageContainer {
    width: 100%;
    max-width: 1200px;
    margin-bottom: 20px;
}
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    width: 100%;
    max-width: 1200px;
}
.card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    width: 300px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card h3 {
    margin: 0 0 10px 0;
    color: #333;
    text-align: center;
}
.card .label {
    font-weight: bold;
    color: #555;
    margin-top: 5px;
}
.card .value {
    margin-bottom: 10px;
    color: #333;
}
.card button {
    padding: 10px;
    margin-top: 10px;
    background: #2575fc;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.3s ease;
}
.card button:hover {
    background: #1a5edb;
}
.back-button {
    padding: 10px 15px;
    background: #555;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.3s ease;
    margin-bottom: 20px;
}
.back-button:hover {
    background: #333;
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

<div id="messageContainer"></div>

<form action="http://localhost:8000/admin" method="GET">
    <button type="submit" class="back-button">⬅ Volver</button>
</form>

<div class="container">
<?php foreach ($shipments as $shipment): ?>
    <div class="card">
        <h3>Envío #<?= htmlspecialchars($shipment->id) ?></h3>

        <div class="label">Orden ID:</div>
        <div class="value"><?= htmlspecialchars($shipment->id_order) ?></div>

        <div class="label">Dirección:</div>
        <div class="value"><?= htmlspecialchars($shipment->address) ?></div>

        <div class="label">Estado:</div>
        <div class="value"><?= htmlspecialchars($shipment->status) ?></div>

        <div class="label">Creado el:</div>
        <div class="value"><?= htmlspecialchars($shipment->created_at) ?></div>

        <!-- Botón de Editar -->
        <form action="/shipments/show" method="GET">
            <input type="hidden" name="id" value="<?= htmlspecialchars($shipment->id) ?>">
            <button type="submit">Editar</button>
        </form>
    </div>
<?php endforeach; ?>
</div>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>
