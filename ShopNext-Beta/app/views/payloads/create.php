<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear Pago</title>
</head>
<body>
    <h1>Crear Pago</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="/payloads/createPayload" method="POST">
        <label>id_order: 
            <input type="number" name="id_order" required>
        </label><br>

        <label for="method">METODO:</label>
        <select id="method" name="method" required>
            <option value="VISA">VISA</option>
            <option value="MASTERCARD">MASTERCARD</option>
            <option value="PAYPAL">PAYPAL</option>
        </select><br>

        <button type="submit">Crear</button>
    </form>
</body>
</html>
