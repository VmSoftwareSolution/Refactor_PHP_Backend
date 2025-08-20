<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Favoritos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            min-height: 100vh;
            display: flex;
        }

        .navbar {
            flex-shrink: 0;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .breadcrumb {
            margin-bottom: 30px;
            font-size: 0.9rem;
            color: #666;
        }

        .breadcrumb a {
            color: #666;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: #000;
        }

        .breadcrumb span {
            margin: 0 8px;
            color: #999;
        }

        .breadcrumb .current {
            color: #000;
            font-weight: 500;
        }

        .favorites-container {
            display: grid;
            grid-template-columns: 1fr; 
            gap: 30px;
            max-width: 1200px;
        }

        .favorites-items {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .favorites-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.9rem;
            color: #374151;
        }

        .favorites-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #f3f4f6;
            align-items: center;
        }

        .favorites-item:last-child {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-image {
            width: 60px;
            height: 60px;
            background: #f3f4f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #9ca3af;
            flex-shrink: 0;
        }

        .product-name {
            font-weight: 500;
            color: #111827;
            font-size: 0.95rem;
        }

        .price {
            font-weight: 500;
            color: #111827;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid #d1d5db;
            background: #fff;
            color: #374151;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background: #f9fafb;
        }
        
        .btn-add-to-cart {
            background: #8b5cf6;
            color: white;
            border-color: #8b5cf6;
        }

        .btn-add-to-cart:hover {
            background: #7c3aed;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }
        
        .btn-delete:hover {
            background: #dc2626;
        }

        .empty-favorites {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
            grid-column: 1 / -1;
        }

        .empty-favorites h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #374151;
        }

        @media (max-width: 768px) {
            .favorites-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .favorites-header,
            .favorites-item {
                grid-template-columns: 1fr;
                gap: 10px;
                text-align: left;
            }
            
            .favorites-header {
                display: none;
            }
            
            .favorites-item {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }
            
            .product-info {
                justify-content: flex-start;
            }
            
            .action-buttons {
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>

    <div class="main-content">
        <div class="breadcrumb">
            <a href="http://localhost:8000/products/list">Home</a>
            <span>/</span>
            <span class="current">Favorites</span>
        </div>

        <div class="favorites-container">
            <?php if (!$fav || empty($fav['products'])): ?>
                <div class="empty-favorites">
                    <h3>No tienes productos favoritos</h3>
                    <p>Agrega productos que te gusten para verlos aquí.</p>
                </div>
            <?php else: ?>
                <div class="favorites-items">
                    <div class="favorites-header">
                        <div>Producto</div>
                        <div>Precio</div>
                        <div>Acciones</div>
                    </div>

                    <?php foreach ($fav['products'] as $p): ?>
                        <div class="favorites-item">
                            <div class="product-info">
                                <div class="product-image">
                                    ❤️
                                </div>
                                <div class="product-name"><?= htmlspecialchars($p['name']) ?></div>
                            </div>
                            
                            <div class="price">$<?= number_format($p['price'], 0) ?></div>
                            
                            <div class="action-buttons">
                                <button class="btn btn-delete" 
                                        onclick="removeFavorite('<?= $id_person ?>', '<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>')">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        async function removeFavorite(id_person, name) {
            if (!confirm(`¿Seguro que quieres eliminar "${name}" de tus favoritos?`)) return;

            try {
                const formData = new FormData();
                formData.append('id_person', id_person);
                formData.append('name', name);

                const response = await fetch('/favorites/delete', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert(result.message || 'Ocurrió un error al eliminar');
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Intenta nuevamente.');
            }
        }
        
        function addToCart(name) {
             alert(`Funcionalidad de añadir "${name}" al carrito en desarrollo.`);
        }
    </script>
<script src="/js/sessionCheck.js"></script>
</body>
</html>