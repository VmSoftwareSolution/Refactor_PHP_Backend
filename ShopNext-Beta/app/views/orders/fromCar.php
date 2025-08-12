<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Orden Desde El Carrito</title>
</head>
<body>
    <h1>Crear Orden Desde El Carrito</h1>
    <form action="/orders/OrderFromCar" method="POST">
        <label for="id_person">ID Persona:</label>
        <input type="number" name="id_person" id="id_person" required><br><br>

        <button type="submit">crear</button>
    </form>
</body>
</html>
