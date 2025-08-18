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
            <a href="#" class="btn-view">View All Products</a>
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
                        <button class="btn-add">Add To Cart</button>
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
            <a href="#" class="btn-view">View All</a>
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
                <img src="data:image/jpeg;base64,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" alt="">
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

    favoriteIcons.forEach(icon => {
        icon.addEventListener('click', function() {
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
                console.error('Error al llamar a la API:', error);
                alert('Error al conectar con la API.');
            });
        });
    });
});
</script>

</body>
</html>