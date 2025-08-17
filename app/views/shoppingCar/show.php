<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            padding: 2rem;
            width: 90%;
            max-width: 900px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f9f9f9;
            color: #444;
        }
        td {
            background-color: #fff;
        }
        input[type="number"] {
            width: 70px;
            padding: 5px;
            text-align: center;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .btn-update {
            background: #3498db;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-update:hover {
            background: #2980b9;
        }
        .btn-delete {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-delete:hover {
            background: #c0392b;
        }
        .empty {
            text-align: center;
            font-size: 1.2em;
            color: #555;
            padding: 1rem;
        }
        tfoot th {
            background-color: #f4f4f4;
            color: #222;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
    <div class="container">
        <h1>🛒 Carrito de Compras</h1>

        <?php if (!$car): ?>
            <p class="empty">No hay carrito disponible para este usuario.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($car['products'] as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td>
                                <form action="/shoppingCar/updateMyCar" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_person" value="<?= (int)$car['id_person'] ?>">
                                    <input type="hidden" name="name" value="<?= htmlspecialchars($p['name']) ?>">
                                    <input type="number" name="quantity" value="<?= (int)$p['quantity'] ?>" min="0">
                                    <button type="submit" class="btn-update">Actualizar</button>
                                </form>
                            </td>
                            <td>$<?= number_format($p['price'], 0) ?></td>
                            <td>$<?= number_format($p['price'] * $p['quantity'], 0) ?></td>
                            <td>
                                <form action="/shoppingCar/updateMyCar" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_person" value="<?= (int)$car['id_person'] ?>">
                                    <input type="hidden" name="name" value="<?= htmlspecialchars($p['name']) ?>">
                                    <input type="hidden" name="quantity" value="0">
                                    <button type="submit" class="btn-delete">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align:right;">Total:</th>
                        <th>$<?= number_format($car['total_price'], 0) ?></th>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
