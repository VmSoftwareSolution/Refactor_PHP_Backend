<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de la Orden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background-color: #f4f6f8;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }
        .info {
            margin-bottom: 1.5rem;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
            margin-bottom: 0.8rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table thead {
            background-color: #3498db;
            color: white;
        }
        table th, table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
        }
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        select {
            width: 100%;
            padding: 0.6rem;
            margin-top: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .actions {
            margin-top: 2rem;
            text-align: center;
        }
        .btn-primary {
            background-color: #27ae60;
            color: white;
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background-color: #219150;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detalle de la Orden</h2>

        <div class="info">
            <div class="label">ID Orden:</div>
            <div class="value"><?= htmlspecialchars($order->id) ?></div>

            <div class="label">ID Persona:</div>
            <div class="value"><?= htmlspecialchars($order->id_person) ?></div>

            <div class="label">Fecha de Creación:</div>
            <div class="value"><?= htmlspecialchars($order->created_at) ?></div>
        </div>

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
                <?php foreach ($order->products as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= htmlspecialchars($p['quantity']) ?></td>
                        <td>$<?= number_format($p['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="label" style="margin-top: 1rem;">Total:</div>
        <div class="value"><strong>$<?= number_format($order->total_price, 2) ?></strong></div>

        <form action="/orders/updateStatus" method="POST" class="actions">
            <input type="hidden" name="id" value="<?= htmlspecialchars($order->id) ?>">

            <label for="status" class="label">Estado de la orden:</label>
            <select id="status" name="status" required>
                <option value="open" <?= $order->status === 'open' ? 'selected' : '' ?>>En espera</option>
                <option value="in_progress" <?= $order->status === 'in_progress' ? 'selected' : '' ?>>Pagando</option>
                <option value="closed" <?= $order->status === 'closed' ? 'selected' : '' ?>>Completada</option>
            </select>

            <button type="submit" class="btn-primary">Actualizar Orden</button>
        </form>
    </div>
</body>
</html>
