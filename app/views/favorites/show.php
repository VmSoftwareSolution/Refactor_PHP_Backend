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
                                <button class="btn-delete" 
                                        onclick="removeFavorite('<?= $id_person ?>', '<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>')">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script>
        async function removeFavorite(id_person, name) {
            if (!confirm(`¿Seguro que quieres eliminar "${name}" de tus favoritos?`)) return;

            try {
                const formData = new FormData();
                formData.append('id_person', id_person);
                formData.append('name', name);

                const response = await fetch('/favorites/delete', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert(result.message || 'Ocurrió un error al eliminar');
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Intenta nuevamente.');
            }
        }
    </script>
</body>
</html>
