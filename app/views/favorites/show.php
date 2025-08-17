<?php
// views/favorites/show_fav.php

/** @var array|null $fav viene desde el controlador */
/** @var int $id_person */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FAVORITOS</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        img { max-width: 60px; }
        .empty { text-align: center; font-size: 1.2em; color: #666; }
        form { margin: 0; }
        button { background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer; }
        button:hover { background-color: darkred; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
    <h1 style="text-align:center;">FAVORITOS</h1>

    <?php if (!$fav || empty($fav['products'])): ?>
        <p class="empty">No hay favoritos disponibles para este usuario.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio unitario</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fav['products'] as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td>$<?= number_format($p['price'], 0) ?></td>
                        <td>
                            <form action="/favorites/delete" method="POST">
                                <input type="hidden" name="id_person" value="<?= $id_person ?>">
                                <input type="hidden" name="name" value="<?= $p['name'] ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
