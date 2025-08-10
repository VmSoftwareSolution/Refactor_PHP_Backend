<?php
// views/shopping_cart/show_cart.php

/** @var array|null $cart viene desde el controlador */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        img { max-width: 60px; }
        .empty { text-align: center; font-size: 1.2em; color: #666; }
        form { display: inline; }
        input[type="number"] { width: 60px; text-align: center; }
        button { padding: 5px 10px; cursor: pointer; }
        .btn-update { background-color: #3498db; color: white; border: none; }
        .btn-delete { background-color: #c0392b; color: white; border: none; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Carrito de Compras</h1>

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
                            <!-- Formulario para actualizar cantidad -->
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
                            <!-- Botón eliminar (manda cantidad 0) -->
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
</body>
</html>
