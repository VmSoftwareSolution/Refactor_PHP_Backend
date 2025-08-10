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
    </style>
</head>
<body>
    <h1 style="text-align:center;">Carrito de Compras</h1>

    <?php if (!$cart): ?>
        <p class="empty">No hay carrito disponible para este usuario.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart['products'] as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= (int)$p['quantity'] ?></td>
                        <td>$<?= number_format($p['price'], 0) ?></td>
                        <td>$<?= number_format($p['price'] * $p['quantity'], 0) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align:right;">Total:</th>
                    <th>$<?= number_format($cart['total_price'], 0) ?></th>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
</body>
</html>
