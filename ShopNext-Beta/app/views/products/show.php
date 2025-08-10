<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background-color: #f9f9f9;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            max-width: 500px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .label {
            font-weight: bold;
            margin-top: 1rem;
            color: #555;
        }
        .value {
            margin-bottom: 1rem;
            font-size: 1.1em;
            color: #333;
        }
        .actions {
            margin-top: 2rem;
            text-align: center;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Información del Producto</h2>

        <div>
            <div class="label">ID:</div>
            <div class="value"><?= htmlspecialchars($product->id) ?></div>
        </div>

        <div>
            <div class="label">Nombre:</div>
            <div class="value"><?= htmlspecialchars($product->name) ?></div>
        </div>

        <div>
            <div class="label">Descripción:</div>
            <div class="value"><?= htmlspecialchars($product->description) ?></div>
        </div>

        <div>
            <div class="label">Precio:</div>
            <div class="value"><?= htmlspecialchars($product->price) ?></div>
        </div>

        <div>
            <div class="label">Stock:</div>
            <div class="value"><?= htmlspecialchars($product->stock) ?></div>
        </div>

        <div>
            <div class="label">Categoria:</div>
            <div class="value"><?= htmlspecialchars($product->category) ?></div>
        </div>

        <div>
            <div class="label">Imagen:</div>
            <div class="value"><?= htmlspecialchars($product->image) ?></div>
        </div>


        <div class="actions">
            <form action="/products/delete" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                <input type="hidden" name="id" value="<?= htmlspecialchars($product->id) ?>">
                <button type="submit" class="btn-delete">Eliminar producto</button>
            </form>
        </div>
    </div>
</body>
</html>
