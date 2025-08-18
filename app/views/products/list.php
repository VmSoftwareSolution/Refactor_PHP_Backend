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
<div class="main-content">

    <div class="section">
        <div class="section-header">
            <div class="section-title"><span></span> Flash Sales</div>
            <a href="#" class="btn-view">View All Products</a>
        </div>
        <div class="flash-sales">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="product-card">
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
            <div class="product-card">
                <img src="https://www.gaynors.co.uk/images/boys-never-stop-down-jacket-p22421-127001_image.jpg" alt="">
                <div class="product-name">The north coat</div>
                <div><span class="product-price">$260</span><span class="old-price">$360</span></div>
            </div>
            <div class="product-card">
                <img src="https://media.gucci.com/style/White_South_0_160_316x316/1716915692/802094_FADUJ_9859_002_097_0000_Light-GG-canvas-large-duffle-bag.jpg" alt="">
                <div class="product-name">Gucci duffle bag</div>
                <div><span class="product-price">$960</span><span class="old-price">$1160</span></div>
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
            <div class="product-card">
                <img src="https://www.alkosto.com/medias/013803351415-001-750Wx750H?context=bWFzdGVyfGltYWdlc3wzNjE4OHxpbWFnZS93ZWJwfGFHSmlMMmd3TXk4eE5ETTFOakE1TmpNMU1qSTROaTh3TVRNNE1ETXpOVEUwTVRWZk1EQXhYemMxTUZkNE56VXdTQXxkMmU4ZDc4NWY2NmYyMzc3ZjEzMTE5YWE0MjZmYTBjZGY5NTQ0M2E5MmE0ZDhjNTYzMjhhZDI3MTM5YjM3NGI3" alt="">
                <div class="product-name">Camera Canon</div>
                <div class="product-price">$560</div>
            </div>
            <div class="product-card">
                <img src="data:image/jpeg;base64,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" alt="">
                <div class="product-name">Gaming Mouse</div>
                <div class="product-price">$120</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-header">
            <div class="section-title"><span></span> New Arrival</div>
        </div>
        <div class="flash-sales">
            <div class="product-card">
                <img src="data:image/jpeg;base64,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" alt="">
                <div class="product-name">Playstation 5</div>
                <div class="product-price">$1200</div>
            </div>
            <div class="product-card">
                <img src="https://www.mussi.com.co/cdn/shop/files/777405_1_-Tenis-Sneakers-damian-de-sintetico-para-hombre-Azul.webp?v=1738039544" alt="">
                <div class="product-name">Sneakers</div>
                <div class="product-price">$200</div>
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
</body>
</html>
