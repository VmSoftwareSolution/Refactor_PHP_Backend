<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Rol</h2>
    <form action="/products/update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product->id) ?>">

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product->name) ?>" required><br>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($product->description) ?></textarea><br>

        <label for="price">Precio:</label>
        <textarea id="price" name="price" required><?= htmlspecialchars($product->price) ?></textarea><br>

        <label for="stock">Stock:</label>
        <textarea id="stock" name="stock" required><?= htmlspecialchars($product->stock) ?></textarea><br>

        <label for="category">Categoria:</label>
        <textarea id="category" name="category" required><?= htmlspecialchars($product->category) ?></textarea><br>

        <label for="image">Image URL:</label>
        <textarea id="image" name="image" required><?= htmlspecialchars($product->image) ?></textarea><br>

        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>
