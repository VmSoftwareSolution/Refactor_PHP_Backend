<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos</title>
<style>
  body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #fff;
      color: #111;
  }
  .main-content { max-width: 1200px; margin: auto; padding: 2rem 1rem; }
  .back-btn { display: inline-block; margin-bottom: 1.5rem; text-decoration: none; font-size: 0.95rem; color: #6a11cb; font-weight: bold; }
  .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; }
  .section-title { font-size: 1.4rem; font-weight: bold; display: flex; align-items: center; gap: 8px; }
  .section-title span { display: inline-block; width: 6px; height: 20px; background: #6a11cb; border-radius: 4px; }
  .btn-add { background: #6a11cb; color: #fff; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-size: 0.9rem; }
  .btn-add:hover { background: #4b0fa5; }
  .product-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
  .product-card { background: #fff; border: 1px solid #eee; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.08); padding: 20px; text-align: center; transition: transform .2s; position: relative; }
  .product-card:hover { transform: translateY(-5px); }
  .product-card img { width: 100%; height: 180px; object-fit: contain; margin-bottom: 12px; }
  .product-name { font-weight: 600; font-size: 1.1rem; margin: 8px 0; }
  .product-price { font-size: 1.2rem; font-weight: bold; color: #6a11cb; }
  .card-actions { display: flex; justify-content: center; gap: 10px; margin-top: 12px; }
  
  /* Botones Editar, Eliminar y Añadir */
  .btn-edit, .btn-delete, .btn-add {
      padding: 8px 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9rem;
      font-weight: 500;
      text-decoration: none;
      display: inline-block;
      text-align: center;
  }
  .btn-edit { background: #007bff; color: #fff; }
  .btn-edit:hover { background: #0056b3; }
  .btn-delete { background: #dc3545; color: #fff; }
  .btn-delete:hover { background: #b02a37; }
  
  form { display: inline; }
  .message { margin-top: 1rem; color: green; font-weight: bold; }
</style>
</head>
<body>
<div class="main-content">
    <a href="http://localhost:8000/admin" class="back-btn">⬅ Volver</a>
    <div class="section-header">
        <div class="section-title"><span></span> Productos</div>
        <a href="/products/create" class="btn-add">+ Nuevo Producto</a>
    </div>
    <div id="message" class="message"></div>

    <div class="product-grid">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="product-card" id="product-<?= htmlspecialchars($product['id']) ?>">
                    <?php if(!empty($product['image'])): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name'] ?? '') ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/180x180?text=Producto" alt="Sin imagen">
                    <?php endif; ?>
                    <div class="product-name"><?= htmlspecialchars($product['name'] ?? '') ?></div>
                    <div class="product-price">$<?= htmlspecialchars($product['price'] ?? '0') ?></div>

                    <div class="card-actions">
                        <a href="/products/edit?id=<?= htmlspecialchars($product['id'] ?? '') ?>" class="btn-edit">Editar</a>
                        
                        <form class="delete-form" data-id="<?= htmlspecialchars($product['id']) ?>">
                            <button type="submit" class="btn-delete">Eliminar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles</p>
        <?php endif; ?>
    </div>
</div>
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!confirm('¿Seguro que deseas eliminar este producto?')) return;

        const productId = this.dataset.id;

        fetch('/products/delete', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + encodeURIComponent(productId)
        })
        .then(res => res.json())
        .then(data => {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = data.message || 'Producto eliminado';
            const card = document.getElementById('product-' + productId);
            if(card) card.remove();
        })
        .catch(err => alert('Error al eliminar el producto.'));
    });
});
</script>
<script src="/js/sessionCheck.js"></script>
</body>
</html>