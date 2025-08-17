<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Menú</title>
<style>
.navbar {
    background-color: #1e1e2f;
    color: white;
    padding: 15px;
    display: flex;
    flex-direction: column;
    width: 250px;
    min-height: 100vh;
    transition: all 0.3s;
    overflow-y: auto;
}
.navbar h2 {
    margin: 0 0 20px;
    font-size: 20px;
    text-align: center;
    color: #f0f0f0;
}
.section {
    margin-bottom: 10px;
}
.section-header {
    background: #2b2b3d;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #f0f0f0;
    font-weight: bold;
    transition: background 0.2s;
}
.section-header:hover {
    background: #3a3a4f;
}
.section-content {
    display: none;
    flex-direction: column;
    margin-left: 10px;
    margin-top: 5px;
}
.section-content a, .section-content button {
    color: #ccc;
    text-decoration: none;
    padding: 8px;
    border-radius: 5px;
    transition: background 0.2s;
    background: none;
    border: none;
    text-align: left;
    cursor: pointer;
}
.section-content a:hover, .section-content button:hover {
    background: #333;
    color: white;
}
.arrow {
    transition: transform 0.3s;
}
.arrow.open {
    transform: rotate(90deg);
}
</style>
</head>
<body>

<div class="navbar">
    <h2>Menú</h2>

    <!-- Tickets -->
    <div class="section" id="ticketsSectionWrapper">
        <div class="section-header" onclick="toggleSection('ticketsSection', this)">
            Tickets <span class="arrow">▶</span>
        </div>
        <div id="ticketsSection" class="section-content">
            <a href="/tickets/create">➕ Crear Ticket</a>
            <a href="/tickets/edit">✏️ Editar Ticket</a>
        </div>
    </div>

    <!-- Órdenes -->
    <div class="section" id="ordersSectionWrapper">
        <div class="section-header" onclick="toggleSection('ordersSection', this)">
            Órdenes <span class="arrow">▶</span>
        </div>
        <div id="ordersSection" class="section-content">
            <a href="/orders/fromCar">🛒 Orden desde Carrito</a>
            <a href="/orders/fromProduct">📦 Orden desde Producto</a>
        </div>
    </div>

    <!-- Carrito -->
    <div class="section" id="shoppingCarSectionWrapper">
        <div class="section-header" onclick="toggleSection('shoppingCarSection', this)">
            Carrito <span class="arrow">▶</span>
        </div>
        <div id="shoppingCarSection" class="section-content">
            <button onclick="goToShoppingCar()">
                🛒 Ver Mi Carrito
            </button>
            <a href="/shoppingCar/add">➕ Agregar Producto</a>
        </div>
    </div>

    <!-- Favoritos -->
    <div class="section" id="favoritesSectionWrapper">
        <div class="section-header" onclick="toggleSection('favoritesSection', this)">
            Favoritos <span class="arrow">▶</span>
        </div>
        <div id="favoritesSection" class="section-content">
            <button onclick="goToFavorites()">
                ⭐ Mis Favoritos
            </button>
            <a href="/favorites/add">➕ Agregar a Favoritos</a>
        </div>
    </div>

    <!-- Pagos -->
    <div class="section" id="payloadsSectionWrapper">
        <div class="section-header" onclick="toggleSection('payloadsSection', this)">
            Pagos <span class="arrow">▶</span>
        </div>
        <div id="payloadsSection" class="section-content">
            <a href="/payloads/create">💳 Crear Pago</a>
        </div>
    </div>

</div>

<script>
function toggleSection(sectionId, header) {
    const section = document.getElementById(sectionId);
    const arrow = header.querySelector(".arrow");
    if (section.style.display === "flex") {
        section.style.display = "none";
        arrow.classList.remove("open");
    } else {
        section.style.display = "flex";
        section.style.flexDirection = "column";
        arrow.classList.add("open");
    }
}

function goToShoppingCar() {
    const personId = localStorage.getItem('id_person');
    if (!personId) {
        alert("No se encontró el ID de la persona en localStorage");
        return;
    }
    window.location.href = '/shoppingCar/show?id_person=' + personId;
}

function goToFavorites() {
    const personId = localStorage.getItem('id_person');
    if (!personId) {
        alert("No se encontró el ID de la persona en localStorage");
        return;
    }
    window.location.href = '/favorites/show?id_person=' + personId;
}

// Mostrar/ocultar secciones según rol
document.addEventListener('DOMContentLoaded', function() {
    const roleId = localStorage.getItem('role_id');

    if(roleId === "1"){ // Cliente
        ["shoppingCarSectionWrapper", "favoritesSectionWrapper"].forEach(id => {
            document.getElementById(id).style.display = "block";
        });
    } else if(roleId === "2"){ // Admin
        ["ticketsSectionWrapper","ordersSectionWrapper","shoppingCarSectionWrapper","favoritesSectionWrapper","payloadsSectionWrapper"].forEach(id => {
            document.getElementById(id).style.display = "block";
        });
    }
});
</script>

</body>
</html>
