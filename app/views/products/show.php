<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product->name) ?> | Detalle del Producto</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .product-images {
            flex: 1;
            min-width: 300px;
            display: flex;
            gap: 20px;
        }
        .thumbnail-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .thumbnail {
            width: 80px;
            height: 80px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            object-fit: contain;
        }
        .thumbnail:hover, .thumbnail.active {
            border-color: #8b5cf6;
        }
        .main-image {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-image img {
            max-width: 100%;
            max-height: 500px;
            border-radius: 12px;
            object-fit: contain;
        }
        .product-details {
            flex: 1.5;
            min-width: 400px;
        }
        .breadcrumb {
            color: #6b7280;
            margin-bottom: 20px;
        }
        .breadcrumb a {
            text-decoration: none;
            color: #6b7280;
        }
        .breadcrumb span {
            color: #9ca3af;
            margin: 0 5px;
        }
        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1f2937;
        }
        .product-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: #6b7280;
        }
        .product-rating .stars {
            color: #f59e0b;
        }
        .price {
            font-size: 2rem;
            font-weight: 700;
            color: #8b5cf6;
            margin-bottom: 20px;
        }
        .product-description {
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .options-group {
            margin-bottom: 25px;
        }
        .options-group h4 {
            font-size: 1rem;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .option-list {
            display: flex;
            gap: 10px;
        }
        .option-item {
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            font-size: 0.9rem;
        }
        .option-item:hover, .option-item.active {
            border-color: #8b5cf6;
            color: #8b5cf6;
            font-weight: 600;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }
        .quantity-btn {
            background-color: #e5e7eb;
            border: none;
            padding: 8px 12px;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 6px;
        }
        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 8px;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-buy {
            background-color: #8b5cf6;
            color: #fff;
        }
        .btn-add-cart {
            background-color: #8b5cf6;
            color: #fff;
            flex-grow: 1;
        }
        .btn-favorite {
            background-color: #fff;
            border: 1px solid #d1d5db;
            font-size: 1.5rem;
            color: #ef4444;
        }
        .shipping-info {
            background-color: #f3f4f6;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-top: 30px;
        }
        .shipping-info h4 {
            margin-top: 0;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .product-images {
                flex-direction: column-reverse;
                align-items: center;
            }
            .thumbnail-container {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-images">
            <div class="thumbnail-container">
                <img src="<?= htmlspecialchars($product->image ?? '') ?>" alt="Miniatura 1" class="thumbnail active">
            </div>
            <div class="main-image">
                <img src="<?= htmlspecialchars($product->image ?? '') ?>" alt="<?= htmlspecialchars($product->name) ?>">
            </div>
        </div>
        <div class="product-details">
            <div class="breadcrumb">
                <a href="/products/list">Inicio</a> <span>/</span> <a href="#">Categoría</a> <span>/</span> <?= htmlspecialchars($product->name) ?>
            </div>
            <h1 class="product-title"><?= htmlspecialchars($product->name) ?></h1>
            <div class="product-rating">
                <span class="stars">⭐⭐⭐⭐⭐</span> (150 Reviews) | <span style="color: #22c55e;">In Stock</span>
            </div>
            <div class="price">$<?= number_format($product->price ?? 0) ?></div>
            <p class="product-description">
                <?= htmlspecialchars($product->description ?? 'No hay descripción disponible para este producto.') ?>
            </p>
            

            <div class="action-buttons">
                <button class="btn btn-buy" onclick="buyNow(<?= htmlspecialchars($product->id) ?>)">Comprar ahora</button>
            </div>

            <div class="shipping-info">
                <h4>Envío y Devoluciones</h4>
                <p>Envío gratuito<br><small>Ingresa tu código postal para disponibilidad.</small></p>
                <hr>
                <p>Devolución gratuita<br><small>Devolución en 30 días, detalles.</small></p>
            </div>
        </div>
    </div>
    <script>
        const productId = <?= htmlspecialchars($product->id) ?>;

        function buyNow(id) {
            const quantity = document.getElementById('quantity').value;
            // Lógica para procesar la compra ahora
            alert(`Comprando producto ${id} con una cantidad de ${quantity}.`);
        }

        function addToCart(id) {
            const quantity = document.getElementById('quantity').value;
            // Lógica para añadir al carrito
            alert(`Añadiendo producto ${id} al carrito con una cantidad de ${quantity}.`);
        }

        function toggleFavorite(id) {
            // Lógica para agregar/eliminar de favoritos
            alert(`Cambiando estado de favoritos para el producto ${id}.`);
        }

        document.getElementById('increaseQty').addEventListener('click', () => {
            let qty = parseInt(document.getElementById('quantity').value);
            document.getElementById('quantity').value = qty + 1;
        });

        document.getElementById('decreaseQty').addEventListener('click', () => {
            let qty = parseInt(document.getElementById('quantity').value);
            if (qty > 1) {
                document.getElementById('quantity').value = qty - 1;
            }
        });
    </script>
</body>
</html>