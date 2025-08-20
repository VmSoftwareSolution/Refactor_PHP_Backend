<meta charset="UTF-8">
<title>Productos</title>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #fff;
        color: #111;
    }

    .main-content {
        max-width: 1300px;
        margin: auto;
        padding: 2rem 1rem;
    }

    .section {
        margin-bottom: 4rem;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .section-title {
        font-size: 1.4rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-title span {
        display: inline-block;
        width: 6px;
        height: 20px;
        background: #6a11cb;
        border-radius: 4px;
    }
    .btn-view {
        background: #6a11cb;
        color: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .flash-sales {
        overflow-x: auto;
        display: flex;
        gap: 16px;
        scroll-snap-type: x mandatory;
        padding-bottom: 10px;
    }

    /* Estilos para el enlace de la tarjeta */
    .product-link {
        text-decoration: none;
        color: inherit;
    }

    .product-card {
        flex: 0 0 220px;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        padding: 15px;
        text-align: center;
        scroll-snap-align: start;
        transition: transform .2s;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
    .product-card img {
        width: 100%;
        height: 160px;
        object-fit: contain;
        margin-bottom: 10px;
    }
    .product-name {
        font-weight: 600;
        font-size: 1rem;
        margin: 5px 0;
    }
    .product-price {
        font-size: 1.1rem;
        font-weight: bold;
        color: #6a11cb;
    }
    .old-price {
        text-decoration: line-through;
        color: #999;
        font-size: 0.85rem;
        margin-left: 6px;
    }
    .btn-add {
        margin-top: 10px;
        padding: 8px;
        width: 100%;
        background: #6a11cb;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    /* Estilos del ícono de corazón */
    .favorite-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 1.5rem;
        color: #ddd; /* Color por defecto (gris) */
        transition: color 0.2s ease-in-out;
    }

    .favorite-icon.liked {
        color: #ff0000; /* Color cuando está gustado (rojo) */
    }

    .categories {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
    }
    .category-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
        padding: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }
    .category-card:hover {
        background: #6a11cb;
        color: #fff;
    }

    .banner {
        background: #000;
        color: #fff;
        padding: 3rem 2rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }
    .banner h2 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }
    .banner img {
        max-width: 280px;
    }
    .banner button {
        background: #6a11cb;
        border: none;
        padding: 10px 20px;
        color: #fff;
        border-radius: 6px;
        cursor: pointer;
    }

    .features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 2rem;
        text-align: center;
    }
    .feature {
        padding: 20px;
    }
    .feature h3 {
        margin: 10px 0;
    }
</style>
</head>
<body>
<?php include __DIR__ . '/../layouts/sideBar.php'; ?>
<div class="main-content">

    <div class="section">
        <div class="section-header">
            <div class="section-title"><span></span> Flash Sales</div>
        </div>
        <div class="flash-sales">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                        <div class="product-card" data-product-id="<?= htmlspecialchars($product['id'] ?? '') ?>">
                            <span class="favorite-icon" data-product-id="<?= htmlspecialchars($product['id'] ?? '') ?>">&#x2661;</span>
                            <?php if(!empty($product['image'])): ?>
                                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name'] ?? '') ?>">
                            <?php endif; ?>
                            <div class="product-name"><?= htmlspecialchars($product['name'] ?? '') ?></div>
                            <div>
                                <span class="product-price">$<?= htmlspecialchars($product['price'] ?? '0') ?></span>
                                <?php if(!empty($product['old_price'])): ?>
                                    <span class="old-price">$<?= htmlspecialchars($product['old_price']) ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="btn-add" onclick="event.stopPropagation();">Add To Cart</button>
                        </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles</p>
            <?php endif; ?>
        </div>
    </div>

     <div class="section">
        <div class="section-header">
            <div class="section-title"><span></span> Categories</div>
        </div>
        <div class="categories">
            <div class="category-card">Phones</div>
            <div class="category-card">Computers</div>
            <div class="category-card">SmartWatch</div>
            <div class="category-card">Camera</div>
            <div class="category-card">HeadPhones</div>
            <div class="category-card">Gaming</div>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-title"><span></span> Best Selling Products</div>
        </div>
        <div class="flash-sales">
            <div class="product-card" data-product-id="1">
                <span class="favorite-icon" data-product-id="1">&#x2661;</span>
                <img src="https://www.gaynors.co.uk/images/boys-never-stop-down-jacket-p22421-127001_image.jpg" alt="">
                <div class="product-name">The north coat</div>
                <div><span class="product-price">$260</span><span class="old-price">$360</span></div>
                <button class="btn-add">Add To Cart</button>
            </div>
            <div class="product-card" data-product-id="2">
                <span class="favorite-icon" data-product-id="2">&#x2661;</span>
                <img src="https://media.gucci.com/style/White_South_0_160_316x316/1716915692/802094_FADUJ_9859_002_097_0000_Light-GG-canvas-large-duffle-bag.jpg" alt="">
                <div class="product-name">Gucci duffle bag</div>
                <div><span class="product-price">$960</span><span class="old-price">$1160</span></div>
                <button class="btn-add">Add To Cart</button>
            </div>
        </div>
    </div>

    <div class="section banner">
        <div>
            <h2>Enhance Your Music Experience</h2>
            <button>Buy Now</button>
        </div>
        <img src="https://www.dossaudio.com/cdn/shop/files/2_b132c3c2-ae7f-4c11-9265-9f214b082aa8.png?v=1733213462&width=2048" alt="Speaker">
    </div>

     <div class="section">
        <div class="section-header">
            <div class="section-title"><span></span> Explore Our Products</div>
        </div>
        <div class="flash-sales">
            <div class="product-card" data-product-id="3">
                <span class="favorite-icon" data-product-id="3">&#x2661;</span>
                <img src="https://www.alkosto.com/medias/013803351415-001-750Wx750H?context=bWFzdGVyfGltYWdlc3wzNjE4OHxpbWFnZS93ZWJwfGFHSmlMMmd3TXk4eE5ETTFOakE1TmpNMU1qSTROaTh3TVRNNE1ETXpOVEUwTVRWZk1EQXhYemMxTUZkNE56VXdTQXxkMmU4ZDc4NWY2NmYyMzc3ZjEzMTE5YWE0MjZmYTBjZGY5NTQ0M2E5MmE0ZDhjNTYzMjhhZDI3MTM5YjM3NGI3" alt="">
                <div class="product-name">Camera Canon</div>
                <div class="product-price">$560</div>
                <button class="btn-add">Add To Cart</button>
            </div>
            <div class="product-card" data-product-id="4">
                <span class="favorite-icon" data-product-id="4">&#x2661;</span>
                <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQ2lTnp03jSzwmKH3Sw7g_epPrEw_QrTb6PSw5BPb9CR2DUzKmC5LteYdF5NMhto1wuyNU9GYIAzONhsNaOfMJNBN9ehu8TxhFwdYePpW1z0bZS9p90ps1ZdQ" alt="">
                <div class="product-name">Playstation 5</div>
                <div class="product-price">$1200</div>
                <button class="btn-add">Add To Cart</button>
            </div>
            <div class="product-card" data-product-id="6">
                <span class="favorite-icon" data-product-id="6">&#x2661;</span>
                <img src="https://www.mussi.com.co/cdn/shop/files/777405_1_-Tenis-Sneakers-damian-de-sintetico-para-hombre-Azul.webp?v=1738039544" alt="">
                <div class="product-name">Sneakers</div>
                <div class="product-price">$200</div>
                <button class="btn-add">Add To Cart</button>
            </div>
        </div>
    </div>

    <div class="features">
        <div class="feature">
            <h3>FREE AND FAST DELIVERY</h3>
            <p>Free delivery for all orders over $140</p>
        </div>
        <div class="feature">
            <h3>24/7 CUSTOMER SERVICE</h3>
            <p>Friendly 24/7 customer support</p>
        </div>
        <div class="feature">
            <h3>MONEY BACK GUARANTEE</h3>
            <p>We return money within 30 days</p>
        </div>
    </div>

</div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteIcons = document.querySelectorAll('.favorite-icon');
    const addToCartButtons = document.querySelectorAll('.btn-add');

    favoriteIcons.forEach(icon => {
        icon.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            const productId = this.getAttribute('data-product-id');
            const personId = localStorage.getItem('id_person');

            if (!personId) {
                console.error('ID de persona no encontrado en localStorage.');
                alert('Inicia sesión para agregar productos a favoritos.');
                return;
            }

            const isLiked = this.classList.contains('liked');

            let endpoint = '';
            const formData = new FormData();
            formData.append('id_person', parseInt(personId));

            if (isLiked) {
                endpoint = 'http://localhost:8000/favorites/delete';
                formData.append('name', productId);
            } else {
                endpoint = 'http://localhost:8000/favorites/addFavorite';
                formData.append('id_product', parseInt(productId));
            }

            fetch(endpoint, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Respuesta de la red no fue exitosa');
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    this.classList.toggle('liked');
                    this.innerHTML = this.classList.contains('liked') ? '&#x2665;' : '&#x2661;';
                } else {
                   this.classList.toggle('liked');
                    this.innerHTML = this.classList.contains('liked') ? '&#x2665;' : '&#x2661;';
                }
            })
            .catch(error => {
                console.error('Error al llamar a la API de favoritos:', error);
                alert('Error al conectar con la API de favoritos.');
            });
        });
    });

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            const productId = productCard.getAttribute('data-product-id');
            const personId = localStorage.getItem('id_person');

            if (!personId) {
                console.error('ID de persona no encontrado en localStorage.');
                alert('Inicia sesión para agregar productos al carrito.');
                return;
            }

            const formData = new FormData();
            formData.append('id_person', parseInt(personId));
            formData.append('id_product', parseInt(productId));

            fetch('http://localhost:8000/shoppingCar/addProduct', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                  
                    return response.json().then(err => { throw new Error(err.message || 'Error desconocido'); });
                }
                return response.json();
            })
            .then(result => {
                console.log('Respuesta de la API del carrito:', result);
                if (!result.success) {
                    alert((result.message || 'No se pudo agregar el producto al carrito.'));
                }
            })
            .catch(error => {
                console.error('Error al llamar a la API del carrito:', error);
                alert('Error al conectar con la API del carrito: ' + error.message);
            });
        });
    });
});
</script>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>