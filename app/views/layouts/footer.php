<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      display: grid;
      grid-template-columns: 250px 1fr;
      grid-template-rows: 1fr auto;
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
    }
    .navbar {
      grid-row: 1 / 2;
      grid-column: 1 / 2;
    }
    .main-content {
      grid-row: 1 / 2;
      grid-column: 2 / 3;
      padding: 2rem;
      color: #fff;
    }
    h1 {
      text-align: center;
      margin-bottom: 2rem;
    }
    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
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
    .footer {
      grid-column: 1 / -1;
      grid-row: 2 / 3;
      background: #000;
      padding: 3rem 2rem 1rem;
    }
    .footer-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: auto;
    }
    .footer-section h2.logo {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 1rem;
      color: #fff;
    }
    .footer-section h3 {
      font-size: 1.2rem;
      margin-bottom: 1rem;
      color: #fff;
    }
    .footer-section p, .footer-section a {
      font-size: 0.95rem;
      color: #ccc;
      margin: 0.3rem 0;
      text-decoration: none;
      display: block;
    }
    .footer-section a:hover {
      color: #fff;
    }
    .subscribe-form {
      display: flex;
      margin-top: 1rem;
    }
    .subscribe-form input {
      flex: 1;
      padding: 0.6rem;
      border: 1px solid #444;
      border-radius: 4px 0 0 4px;
      outline: none;
    }
    .subscribe-form button {
      background: #444;
      border: none;
      padding: 0 1rem;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
      color: #fff;
    }
    .subscribe-form button:hover {
      background: #666;
    }
    .footer-section ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .footer-section ul li {
      margin-bottom: 0.5rem;
    }
    .app-links {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .app-links img {
      max-height: 40px;
    }
    .stores img {
      display: block;
      margin-bottom: 0.5rem;
      max-height: 40px;
    }
    .social-icons {
      margin-top: 1rem;
    }
    .social-icons a {
      color: #ccc;
      margin-right: 0.8rem;
      font-size: 1.2rem;
    }
    .social-icons a:hover {
      color: #fff;
    }
    .footer-bottom {
      text-align: center;
      padding-top: 1.5rem;
      margin-top: 2rem;
      border-top: 1px solid #222;
      font-size: 0.9rem;
      color: #777;
    }
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
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="text-align:center; grid-column:1/-1;">No hay productos disponibles</p>
    <?php endif; ?>
    </div>
  </div>
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h2 class="logo">SHOPNEXTS</h2>
        <p>Get 10% off your first order</p>
        <form class="subscribe-form">
          <input type="email" placeholder="Enter your email">
          <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
      </div>
      <div class="footer-section">
        <h3>Support</h3>
        <p>111 Bijoy sarani, Dhaka,<br> DH 1515, Bangladesh.</p>
        <p>exclusive@gmail.com</p>
        <p>+88015-88888-9999</p>
      </div>
      <div class="footer-section">
        <h3>Account</h3>
        <ul>
          <li><a href="#">My Account</a></li>
          <li><a href="#">Login / Register</a></li>
          <li><a href="#">Cart</a></li>
          <li><a href="#">Wishlist</a></li>
          <li><a href="#">Shop</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Quick Link</h3>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms Of Use</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Download App</h3>
        <p>Save $3 with App New User Only</p>
        <div class="app-links">
          <img src="https://i.ibb.co/YD6VqjN/qrcode.png" alt="QR Code">
          <div class="stores">
            <a href="#"><img src="https://developer.android.com/images/brand/en_app_rgb_wo_45.png" alt="Google Play"></a>
            <a href="#"><img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="App Store"></a>
          </div>
        </div>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© Copyright Rimel 2022. All right reserved</p>
    </div>
  </footer>
</body>
</html>
