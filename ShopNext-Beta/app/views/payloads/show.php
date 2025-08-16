<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del PAGO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background-color: #f4f6f8;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }
        .info {
            margin-bottom: 1.5rem;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
            margin-bottom: 0.8rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table thead {
            background-color: #3498db;
            color: white;
        }
        table th, table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
        }
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        select {
            width: 100%;
            padding: 0.6rem;
            margin-top: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .actions {
            margin-top: 2rem;
            text-align: center;
        }
        .btn-primary {
            background-color: #27ae60;
            color: white;
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background-color: #219150;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detalle del PAGO</h2>

        <div class="info">
            <div class="label">ID PAGO:</div>
            <div class="value"><?= htmlspecialchars($payload->id) ?></div>

            <div class="label">ID ORDEN:</div>
            <div class="value"><?= htmlspecialchars($payload->id_order) ?></div>

            <div class="label">METODO:</div>
            <div class="value"><?= htmlspecialchars($payload->method) ?></div>

            <div class="label">PAGADO EL:</div>
            <div class="value"><?= htmlspecialchars($payload->payment_at) ?></div>
        </div>

        <form action="/payloads/updateStatus" method="POST" class="actions">
            <input type="hidden" name="id" value="<?= htmlspecialchars($payload->id) ?>">

            <label for="status" class="label">Estado de la orden:</label>
            <select id="status" name="status" required>
            <option value="canceled">CANCELADO</option>
            <option value="in_progress">EN PROGRESO</option>
            <option value="complete">PAGADO</option>
            </select><br>

            <button type="submit" class="btn-primary">Actualizar Orden</button>
        </form>
    </div>
</body>
</html>
