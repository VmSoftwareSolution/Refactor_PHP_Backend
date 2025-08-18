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
    .nav-icons span {
        cursor: pointer;
    }
</style>
</head>
<body>

<div class="navbar">
    <div class="logo">
        <img src="/images/logo.png" alt="Logo de la tienda">
    </div>
    <div class="nav-links" id="nav-links">
        <a href="http://localhost:8000/products/list" class="active">Home</a>
        <a href="#">Contact</a>
        <a href="#">About</a>
        <a href="#">Sign Up</a>
        <a href="http://localhost:8000/tickets/create">PQR</a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="What are you looking for?">
        <span class="search-icon">🔍</span>
    </div>
    <div class="nav-icons">
        <span class="wishlist-icon" onclick="goToFavorite()">♡</span>
        <span class="cart-icon" onclick="goToShoppingCar()">🛒</span>
        <span class="person-icon" onclick="goToPerson()">👤</span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleId = localStorage.getItem('role_id');
        const navLinks = document.getElementById('nav-links');

        // Muestra el enlace "Admin" solo si el rol es 2 (administrador)
        if (roleId === '2') {
            const adminLink = document.createElement('a');
            adminLink.href = 'http://localhost:8000/admin';
            adminLink.textContent = 'Admin';
            navLinks.appendChild(adminLink);
        }
    });

    function goToShoppingCar() {
        const personId = localStorage.getItem('id_person');
        if (personId) {
            window.location.href = 'http://localhost:8000/shoppingCar/show?id_person=' + personId;
        } else {
            alert('No se encontró el ID de la persona en el almacenamiento local. Inicia sesión para ver tu carrito.');
        }
    }
    
    function goToFavorite() {
        const personId = localStorage.getItem('id_person');
        if (personId) {
            window.location.href = 'http://localhost:8000/favorites/show?id_person=' + personId;
        } else {
            alert('No se encontró el ID de la persona en el almacenamiento local. Inicia sesión para ver tus favoritos.');
        }
    }
    
    function goToPerson() {
        const personId = localStorage.getItem('id_person');
        if (personId) {
            window.location.href = 'http://localhost:8000/persons/edit?id=' + personId;
        } else {
            alert('No se encontró el ID de la persona en el almacenamiento local. Inicia sesión para editar tu perfil.');
        }
    }
</script>

</body>
</html>