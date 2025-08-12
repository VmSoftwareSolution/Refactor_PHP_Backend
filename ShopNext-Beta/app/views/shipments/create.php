<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear entrega</title>
</head>
<body>
    <h1>Crear entrega</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="/shipments/createShipment" method="POST">
        <label>id_order: <input type="number" name="id_order"></label><br>
        <label>address: <input type="text" name="address"></label><br>
        
        <button type="submit">Crear</button>

    </form>
</body>
</html>
