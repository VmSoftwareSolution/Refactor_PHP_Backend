<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar ENVIO</title>
</head>
<body>
    <h2>Editar ENVIO</h2>
        
         <div>
            <div class="label">ID:</div>
            <div class="value"><?= htmlspecialchars($shipment->id) ?></div>
        </div>

        <div>
            <div class="label">ORDEN ID:</div>
            <div class="value"><?= htmlspecialchars($shipment->id_order) ?></div>
        </div>

        <div>
            <div class="label">DIRECCION:</div>
            <div class="value"><?= htmlspecialchars($shipment->address) ?></div>
        </div>
        <form action="/shipments/updateStatus" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($shipment->id) ?>">
            <label for="status">Estado:</label>
                <select id="status" name="status" required>
                    <option value="pending" <?= $shipment->status == 'pending' ? 'selected' : '' ?>>PENDIENTE</option>
                    <option value="shipped" <?= $shipment->status == 'shipped' ? 'selected' : '' ?>>EN CAMINO...</option>
                    <option value="delivered" <?= $shipment->status == 'delivered' ? 'selected' : '' ?>>ENTREGADO</option>
                </select><br>
                <button type="submit" class="btn-primary">Actualizar ENVIO</button>
        </form>

        

        <div>
            <div class="label">Creado el:</div>
            <div class="value"><?= htmlspecialchars($shipment->created_at) ?></div>
        </div>

</body>
</html>
