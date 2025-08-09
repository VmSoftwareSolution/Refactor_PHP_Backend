<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear Producto</title>
</head>
<body>
    <h1>Crear Producto</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="/products/createProduct" method="post">
        <label>Nombre del producto: <input type="text" name="name" required></label><br>
        <label>descripcion: <input type="text" name="description"></label><br>
        <label>Precio: <input type="number" name="price"></label><br>
        <label>Stock: <input type="number" name="stock"></label><br>
        <label>Categoria: <input type="text" name="category" ></label><br>
        <label>Url Imagen: <input type="text" name="image" ></label><br>
        <button type="submit">Crear</button>

    </form>
</body>
</html>
