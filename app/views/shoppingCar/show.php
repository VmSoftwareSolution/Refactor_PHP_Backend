<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>
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

        .cart-container {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
            max-width: 1200px;
        }

        .cart-items {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .cart-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 0.1fr; /* Nueva columna para el ícono */
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.9rem;
            color: #374151;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 0.1fr; /* Nueva columna para el ícono */
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #f3f4f6;
            align-items: center;
        }

        .cart-item:last-child {
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

        .quantity-display {
            font-weight: 500;
            text-align: center;
        }

        .subtotal {
            font-weight: 600;
            color: #111827;
        }
        
        .delete-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            color: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            margin-left: auto; /* Mueve el botón a la derecha */
        }

        .delete-btn:hover {
            color: #b91c1c;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e5e7eb;
        }

        .btn-return {
            background: white;
            border: 1px solid #d1d5db;
            padding: 10px 20px;
            border-radius: 4px;
            color: #374151;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-return:hover {
            background: #f9fafb;
            color: #111827;
        }

        .btn-update {
            background: white;
            border: 1px solid #d1d5db;
            padding: 10px 20px;
            border-radius: 4px;
            color: #374151;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-update:hover {
            background: #f9fafb;
        }

        .coupon-section {
            padding: 20px;
            background: white;
            border-top: 1px solid #e5e7eb;
        }

        .coupon-form {
            display: flex;
            gap: 10px;
        }

        .coupon-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn-coupon {
            background: #8b5cf6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-coupon:hover {
            background: #7c3aed;
        }

        .cart-summary {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            height: fit-content;
            border: 1px solid #e5e7eb;
        }

        .summary-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .summary-row.subtotal {
            color: #6b7280;
        }

        .summary-row.shipping {
            color: #6b7280;
        }

        .summary-row.total {
            font-weight: 600;
            font-size: 1.1rem;
            color: #111827;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .shipping-free {
            color: #059669;
            font-weight: 500;
        }

        .btn-checkout {
            width: 100%;
            background: #8b5cf6;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-checkout:hover {
            background: #7c3aed;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
            grid-column: 1 / -1;
        }

        .empty-cart h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #374151;
        }

        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .cart-header,
            .cart-item {
                grid-template-columns: 1fr;
                gap: 10px;
                text-align: left;
            }
            
            .cart-header {
                display: none;
            }
            
            .cart-item {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }
            
            .product-info {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="breadcrumb">
            <a href="http://localhost:8000/products/list">Home</a>
            <span>/</span>
            <span class="current">Cart</span>
        </div>

        <div class="cart-container">
            <?php if (!$car || empty($car['products'])): ?>
                <div class="empty-cart">
                    <h3>Tu carrito está vacío</h3>
                    <p>No hay productos en tu carrito de compras.</p>
                </div>
            <?php else: ?>
                <div class="cart-items">
                    <div class="cart-header">
                        <div>Product</div>
                        <div>Price</div>
                        <div>Quantity</div>
                        <div>Subtotal</div>
                        <div></div>
                    </div>

                    <?php foreach ($car['products'] as $p): ?>
                        <div class="cart-item">
                            <div class="product-info">
                                <div class="product-image">
                                    📦
                                </div>
                                <div class="product-name"><?= htmlspecialchars($p['name']) ?></div>
                            </div>
                            
                            <div class="price">$<?= number_format($p['price'], 0) ?></div>
                            
                            <div class="quantity-display"><?= (int)$p['quantity'] ?></div>
                            
                            <div class="subtotal">$<?= number_format($p['price'] * $p['quantity'], 0) ?></div>
                            
                            <button class="delete-btn" onclick="deleteProductByName('<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>')">🗑️</button>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="cart-summary">
                    <div class="summary-title">Cart Total</div>
                    
                    <div class="summary-row subtotal">
                        <span>Subtotal:</span>
                        <span>$<?= number_format($car['total_price'], 0) ?></span>
                    </div>
                    
                    <div class="summary-row shipping">
                        <span>Shipping:</span>
                        <span class="shipping-free">Free</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>$<?= number_format($car['total_price'], 0) ?></span>
                    </div>
                    
                    <button class="btn-checkout" onclick="proceedToCheckout()">Proceed to checkout</button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const id_person = localStorage.getItem('id_person');

        async function updateProductInCart(name, quantity) {
            if (!id_person) {
                alert("No se encontró el ID de usuario.");
                return;
            }

            try {
                const formData = new FormData();
                formData.append('id_person', id_person);
                formData.append('name', name);
                formData.append('quantity', quantity);

                const response = await fetch('/shoppingCar/updateMyCar', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert(result.message || 'Error al actualizar el carrito.');
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Intenta nuevamente.');
            }
        }

        async function deleteProductByName(name) {
            if (confirm(`¿Seguro que quieres eliminar "${name}" del carrito?`)) {
                await updateProductInCart(name, 0);
            }
        }

        function applyCoupon() {
            const couponCode = document.getElementById('couponCode').value;
            if (couponCode) {
                alert('Funcionalidad de cupón en desarrollo');
            } else {
                alert('Por favor ingresa un código de cupón');
            }
        }

    function proceedToCheckout() {
        if (!id_person) {
            alert("No se encontró el ID de usuario. Inicia sesión para continuar.");
            return;
        }
        
        window.location.href = `http://localhost:8000/orders/fromCar?id_person=${id_person}`;
    }
    </script>
<script src="/js/sessionCheck.js"></script>
</body>
</html>