<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear Ticket</title>
</head>
<body>
    <h1>Crear Ticket</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form action="/tickets/createTicket" method="POST">
        <label>tittle: <input type="text" name="tittle" required></label><br>
        <label>message: <input type="text" name="message"></label><br>
        <label>id_person: <input type="number" name="id_person"></label><br>
        <button type="submit">Crear</button>

    </form>
</body>
</html>
