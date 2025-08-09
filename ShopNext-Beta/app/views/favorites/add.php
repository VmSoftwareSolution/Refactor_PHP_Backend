<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto al Carrito</title>
</head>
<body>
    <h1>Agregar Producto al Carrito</h1>
    <form action="/favorites/addFavorite" method="POST">
        <label for="id_person">ID Persona:</label>
        <input type="number" name="id_person" id="id_person" required><br><br>

        <label for="id_product">ID Producto:</label>
        <input type="number" name="id_product" id="id_product" required><br><br>

        <button type="submit">Agregar</button>
    </form>
</body>
</html>
