<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Menú de navegación</title>
<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .logo img {
        height: 40px;
    }
    .nav-links {
        display: flex;
        gap: 25px;
        align-items: center;
    }
    .nav-links a {
        text-decoration: none;
        color: #000;
        font-size: 16px;
        position: relative;
        font-weight: bold;
    }
    .nav-links a.active::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #000;
        left: 0;
        bottom: -5px;
    }
    .search-bar {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-bar input {
        padding: 8px 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f0f0f0;
        padding-right: 40px; 
    }
    .search-bar .search-icon {
        position: absolute;
        right: 15px;
        cursor: pointer;
    }
    .nav-icons {
        display: flex;
        gap: 20px;
    }
</style>
</head>
<body>

<div class="navbar">
    <div class="logo">
        <img src="/images/logo.png" alt="SHOPNEXTS Logo">
    </div>
    <div class="nav-links">
        <a href="#" class="active">Home</a>
        <a href="#">Contact</a>
        <a href="#">About</a>
        <a href="#">Sign Up</a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="What are you looking for?">
        <span class="search-icon">🔍</span>
    </div>
    <div class="nav-icons">
        <span class="wishlist-icon">♡</span>
        <span class="cart-icon">🛒</span>
    </div>
</div>

</body>
</html>