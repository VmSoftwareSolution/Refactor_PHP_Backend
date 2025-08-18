<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Our Story</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f8f8f8;
            color: #333;
        }
        
        .header-section {
            padding: 50px 0;
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-section {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .hero-content {
            flex: 1;
        }

        .hero-content h1 {
            font-size: 3em;
            color: #1e1e2f;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #666;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .stats-section {
            padding: 80px 0;
            background-color: #f0f2f5;
        }

        .stats-grid {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            text-align: center;
            flex-wrap: wrap;
        }

        .stat-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 250px;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-10px);
        }

        .stat-card.purple {
            background-color: #8b5cf6;
            color: white;
        }

        .stat-card h4 {
            font-size: 2em;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #999;
            font-weight: 500;
        }

        .stat-card.purple p {
            color: #e0e0e0;
        }

        .team-section {
            padding: 80px 0;
            text-align: center;
        }

        .team-grid {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .team-member {
            width: 200px;
            text-align: center;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .team-member h3 {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .team-member p {
            color: #888;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .services-section {
            padding: 80px 0;
            background-color: #fff;
            text-align: center;
        }

        .services-grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }

        .service-item {
            width: 250px;
            text-align: center;
        }

        .service-item img {
            width: 60px;
            margin-bottom: 15px;
        }

        .service-item h4 {
            font-size: 1.1em;
            margin-top: 0;
        }

        .service-item p {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>

    <section class="header-section">
        <div class="container">
            <div class="hero-section">
                <div class="hero-content">
                    <h1>Our Story</h1>
                    <p>Founded in 2020, ShopNext is a premier online shopping marketplace with an active presence in Bangladesh. Supported by over 10.5k active sellers and 300 brands, we offer a wide range of products across various categories.</p>
                    <p>We aim to serve 3 million customers across the region by providing a seamless shopping experience and dedicated customer support.</p>
                </div>
                <div class="hero-image">
                    <img src="/images/blog1.png" alt="Team members smiling and holding shopping bags">
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>10.5k</h4>
                    <p>Sellers active on our site</p>
                </div>
                <div class="stat-card purple">
                    <h4>33k</h4>
                    <p>Monthly products for sale</p>
                </div>
                <div class="stat-card">
                    <h4>45.5k</h4>
                    <p>Customers active on our site</p>
                </div>
                <div class="stat-card">
                    <h4>25k</h4>
                    <p>Annual gross sales on our site</p>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="/images/person1.png" alt="Tom Cruise">
                    <h3>Tom Cruise</h3>
                    <p>Founder & Chairman</p>
                </div>
                <div class="team-member">
                    <img src="/images/person2.png" alt="Emma Watson">
                    <h3>Emma Watson</h3>
                    <p>Managing Director</p>
                </div>
                <div class="team-member">
                    <img src="/images/person3.png" alt="Will Smith">
                    <h3>Will Smith</h3>
                    <p>Product Designer</p>
                </div>
            </div>
        </div>
    </section>

    <section class="services-section">
        <div class="container">
            <h2>Our Services</h2>
            <div class="services-grid">
                <div class="service-item">
                    <img src="/images/icon1.png" alt="Shipping Icon">
                    <h4>Free and Fast Delivery</h4>
                    <p>Free delivery for all orders over $140</p>
                </div>
                <div class="service-item">
                    <img src="/images/icon2.png" alt="Customer Service Icon">
                    <h4>24/7 Customer Service</h4>
                    <p>Friendly 24/7 customer support</p>
                </div>
                <div class="service-item">
                    <img src="/images/icon3.png" alt="Money Back Icon">
                    <h4>Money Back Guarantee</h4>
                    <p>We return money within 30 days</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>