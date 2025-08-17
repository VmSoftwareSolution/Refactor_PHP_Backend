<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Favoritos</title>
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
    </style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
    <div class="container">
        <h1>⭐ Favoritos</h1>

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
                                <form action="/favorites/delete" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_person" value="<?= $id_person ?>">
                                    <input type="hidden" name="name" value="<?= htmlspecialchars($p['name']) ?>">
                                    <button type="submit" class="btn-delete">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
