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
                                <input type="number" id="quantity-<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>" 
                                       value="<?= (int)$p['quantity'] ?>" min="0">
                            </td>
                            <td>$<?= number_format($p['price'], 0) ?></td>
                            <td>$<?= number_format($p['price'] * $p['quantity'], 0) ?></td>
                            <td>
                                <button class="btn-update" 
                                        onclick="updateQuantity('<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>')">
                                    Actualizar
                                </button>
                                <button class="btn-delete" 
                                        onclick="deleteProduct('<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>')">
                                    Eliminar
                                </button>
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

    <script>
        const id_person = localStorage.getItem('id_person');

        async function updateQuantity(name) {
            const quantityInput = document.getElementById(`quantity-${name}`);
            const quantity = quantityInput.value;

            if (!id_person) {
                alert("No se encontró el ID de usuario.");
                return;
            }

            try {
                const formData = new FormData();
                formData.append('id_person', id_person);
                formData.append('name', name);
                formData.append('quantity', quantity);

                const response = await fetch('/shoppingCar/updateMyCar', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert(result.message || 'Error al actualizar la cantidad.');
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Intenta nuevamente.');
            }
        }

        async function deleteProduct(name) {
            if (!confirm(`¿Seguro que quieres eliminar "${name}" del carrito?`)) return;

            if (!id_person) {
                alert("No se encontró el ID de usuario.");
                return;
            }

            try {
                const formData = new FormData();
                formData.append('id_person', id_person);
                formData.append('name', name);
                formData.append('quantity', 0);

                const response = await fetch('/shoppingCar/updateMyCar', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert(result.message || 'Error al eliminar el producto.');
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Intenta nuevamente.');
            }
        }
    </script>
</body>
</html>
