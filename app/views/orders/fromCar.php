<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Orden Desde El Carrito</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        .header .breadcrumb {
            color: #888;
        }

        .header .breadcrumb a {
            text-decoration: none;
            color: #888;
        }

        h2 {
            margin-bottom: 20px;
        }

        .main-form {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
        }

        .billing-details {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            font-size: 0.9em;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        
        .name-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9em;
        }

        .order-summary {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .product-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-item .info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .product-item img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .price-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .price-details .row {
            display: flex;
            justify-content: space-between;
        }

        .total-row {
            font-size: 1.2em;
            font-weight: bold;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .payment-methods {
            margin-top: 20px;
        }
        
        .payment-methods label {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .payment-methods img {
            height: 20px;
        }

        .coupon-section {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .coupon-section input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .coupon-section button {
            padding: 10px 20px;
            background-color: #8b5cf6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .place-order-btn {
            width: 100%;
            padding: 15px;
            background-color: #8b5cf6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            margin-top: 20px;
        }

        .message-box {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }
        .message-box.error {
            background: #ffe0e0;
            color: #900;
        }
        .message-box.success {
            background: #e8f5e8;
            color: #2e7d32;
        }
        
        @media (max-width: 768px) {
            .main-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="breadcrumb">
                Account / My Account / Product / View Cart / <a href="#">CheckOut</a>
            </div>
            <h2>Billing Details</h2>
        </div>

        <form id="orderForm" action="/orders/OrderFromCar" method="POST" class="main-form">
            <div class="billing-details">
                <div class="name-group">
                    <div class="form-group">
                        <label for="first_name">First Name*</label>
                        <input type="text" id="first_name" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" id="company_name" name="company_name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="street_address">Street Address*</label>
                    <input type="text" id="street_address" name="street_address">
                </div>
                
                <div class="form-group">
                    <label for="apartment">Apartment, floor, etc. (optional)</label>
                    <input type="text" id="apartment" name="apartment">
                </div>
                
                <div class="form-group">
                    <label for="town_city">Town/City*</label>
                    <input type="text" id="town_city" name="town_city">
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number*</label>
                    <input type="text" id="phone_number" name="phone_number">
                </div>

                <div class="form-group">
                    <label for="email_address">Email Address*</label>
                    <input type="email" id="email_address" name="email_address">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="save_info" name="save_info">
                    <label for="save_info">Save this information for faster check-out next time</label>
                </div>
            </div>

            <div class="order-summary">
                <div id="messageContainer"></div>
                
                <div class="product-list">
                    <?php if (isset($car['products']) && !empty($car['products'])): ?>
                        <?php foreach ($car['products'] as $product): ?>
                            <div class="product-item">
                                <div class="info">
                                    <span><?= htmlspecialchars($product['name']) ?></span>
                                    <span>(x<?= htmlspecialchars($product['quantity']) ?>)</span>
                                </div>
                                <span>$<?= number_format($product['price'] * $product['quantity'], 0) ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay productos en tu carrito.</p>
                    <?php endif; ?>
                </div>
                
                <div class="price-details">
                    <div class="row">
                        <span>Subtotal:</span>
                        <span>$<?= isset($car['total_price']) ? number_format($car['total_price'], 0) : '0' ?></span>
                    </div>
                    <div class="row">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div class="row total-row">
                        <span>Total:</span>
                        <span>$<?= isset($car['total_price']) ? number_format($car['total_price'], 0) : '0' ?></span>
                    </div>
                </div>

                <div class="payment-methods">
                    <div class="form-group">
                        <label>
                            <div class="form-group">
                                <label>
                                    <input type="radio" name="payment_method" value="bank" checked> Bank
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa" style="height:20px;">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" style="height:20px;">
                                </label>
                            </div>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="radio" name="payment_method" value="cash"> Cash on delivery
                        </label>
                    </div>
                </div>

                <div class="coupon-section">
                    <input type="text" placeholder="Coupon Code" name="coupon_code">
                    <button type="button">Apply Coupon</button>
                </div>
                
                <div class="form-group" style="display: none;">
                    <label for="id_person">Persona:</label>
                    <select id="id_person" name="id_person">
                        <option value="">-- Seleccione una persona --</option>
                        <?php foreach ($persons as $person): ?>
                            <option value="<?= htmlspecialchars($person->id) ?>">
                                <?= htmlspecialchars($person->full_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" id="submitBtn" class="place-order-btn">Place Order</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const id_person = localStorage.getItem('id_person');
            const personSelect = document.getElementById('id_person');
            if (id_person && personSelect) {
                personSelect.value = id_person;
            }

            const orderForm = document.getElementById('orderForm');
            orderForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitBtn = document.getElementById('submitBtn');
                const messageContainer = document.getElementById('messageContainer');

                messageContainer.innerHTML = '';
                submitBtn.disabled = true;
                submitBtn.textContent = 'Creando orden...';
                
                const formData = new FormData(this);

                try {
                    const response = await fetch(this.action, { method: 'POST', body: formData });
                    const result = await response.json();

                    if (response.ok && result.status === 200) {
                        showMessage('success', result.message || 'Orden creada exitosamente');
                    } else {
                        showMessage('error', result.message || 'Error al crear la orden');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showMessage('error', 'Error de conexión. Intenta nuevamente.');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Place Order';
                }
            });
        });

        function showMessage(type, message) {
            const messageContainer = document.getElementById('messageContainer');
            const messageBox = document.createElement('div');
            messageBox.className = `message-box ${type}`;
            const icon = type === 'success' ? '✅' : '⚠️';
            const title = type === 'success' ? '¡Éxito!' : 'Error:';
            messageBox.innerHTML = `<strong>${icon} ${title}</strong> ${message}`;
            messageContainer.appendChild(messageBox);
        }
    </script>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>