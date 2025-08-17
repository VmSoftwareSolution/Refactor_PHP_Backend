<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos</title>
<style>
/* Layout general */
body {
    margin: 0;
    display: flex;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    min-height: 100vh;
}

/* Sidebar */
.navbar {
    flex-shrink: 0;
}

/* Contenido */
.main-content {
    flex-grow: 1;
    padding: 2rem;
    color: #fff;
}

/* Título */
h1 {
    text-align: center;
    margin-bottom: 2rem;
}

/* Grid de productos */
.container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

/* Tarjetas */
.card {
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: #333;
}
.card img {
    max-width: 100%;
    border-radius: 8px;
    margin-bottom: 10px;
}
.card h3 {
    margin: 0 0 10px 0;
    font-size: 1.2rem;
}
.card p {
    margin: 5px 0;
    color: #555;
    font-size: 0.95rem;
}
.card .price {
    font-weight: bold;
    color: #2575fc;
    margin: 10px 0;
}

/* Acciones */
.card .actions {
    display: flex;
    justify-content: space-between;
}
.card .btn {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    color: #fff;
    font-size: 0.9rem;
    text-decoration: none;
    text-align: center;
}
.card .btn-edit { background-color: #2575fc; }
.card .btn-edit:hover { background-color: #1a5edb; }
.card .btn-delete { background-color: #e74c3c; }
.card .btn-delete:hover { background-color: #c0392b; }
</style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>

    <div class="main-content">
        <h1>Lista de Productos</h1>

        <div class="container">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="card">
                    <?php if(!empty($product['image'])): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name'] ?? '') ?>">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($product['name'] ?? '') ?></h3>
                    <p><?= htmlspecialchars($product['description'] ?? '') ?></p>
                    <p class="price">$<?= htmlspecialchars($product['price'] ?? '0') ?></p>
                    <p>Stock: <?= htmlspecialchars($product['stock'] ?? '0') ?></p>
                    <p>Categoria: <?= htmlspecialchars($product['category'] ?? '-') ?></p>

                    <div class="actions">
                        <a href="/products/edit?id=<?= htmlspecialchars($product['id']) ?>" class="btn btn-edit">Editar</a>
                        <form action="/products/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; grid-column:1/-1;">No hay productos disponibles</p>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
