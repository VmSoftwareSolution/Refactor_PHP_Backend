<?php
// list.php
if (!isset($orders)) {
    $orders = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Órdenes</title>
<style>
body {
    margin: 0;
    display: flex;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f6f9;
}

.main-content {
    flex-grow: 1;
    padding: 2rem;
}

h2 {
    text-align: center;
    margin-bottom: 2rem;
    color: #2c3e50;
    font-size: 2rem;
    font-weight: bold;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.card h3 {
    margin: 10px 0;
    color: #34495e;
    font-size: 1.2rem;
}
.card p {
    margin: 5px 0;
    color: #555;
    font-size: 0.95rem;
}
.card table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.card table th, .card table td {
    padding: 5px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 0.9rem;
}
.card table thead {
    background-color: #2575fc;
    color: #fff;
}
.card table tr:nth-child(even) {
    background-color: #f8f9fa;
}

.card a, .card-btn, .back-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 18px;
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}
.card a:hover, .card-btn:hover, .back-btn:hover {
    background: linear-gradient(135deg, #1a5edb, #4a0fa3);
    transform: scale(1.05);
}

.create-container {
    text-align: center;
    margin-bottom: 25px;
}
.create-container .card-btn {
    font-weight: bold;
    font-size: 1rem;
}

.back-container {
    text-align: left;
    margin-bottom: 20px;
}
</style>
</head>
<body>
<div class="main-content">
    <div class="back-container">
        <a href="/admin" class="back-btn">⬅ Back</a>
    </div>

    <h2>Órdenes</h2>

    <div class="grid">
    <?php if (empty($orders)): ?>
        <p style="grid-column:1/-1; text-align:center;">No hay órdenes registradas.</p>
    <?php else: ?>
        <?php foreach($orders as $order): ?>
            <div class="card">
                <h3>Orden #<?= htmlspecialchars($order->id ?? '', ENT_QUOTES, 'UTF-8') ?></h3>
                <p><strong>Persona ID:</strong> <?= htmlspecialchars($order->id_person ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Estado:</strong> <?= htmlspecialchars($order->status ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Fecha:</strong> <?= htmlspecialchars($order->created_at ?? '', ENT_QUOTES, 'UTF-8') ?></p>

                <h4>Productos</h4>
                <?php $products = is_array($order->products) ? $order->products : []; ?>
                <?php if (!empty($products)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($products as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($p['quantity'] ?? 0, ENT_QUOTES, 'UTF-8') ?></td>
                                <td>$<?= number_format($p['price'] ?? 0, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay productos en esta orden.</p>
                <?php endif; ?>
                <a href="/orders/show?id=<?= htmlspecialchars($order->id ?? '', ENT_QUOTES, 'UTF-8') ?>">Editar</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</div>
<script src="/js/sessionCheck.js"></script>
</body>
</html>
