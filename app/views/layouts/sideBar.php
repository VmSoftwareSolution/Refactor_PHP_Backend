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
.section-content a {
    color: #ccc;
    text-decoration: none;
    padding: 8px;
    border-radius: 5px;
    transition: background 0.2s;
}
.section-content a:hover {
    background: #333;
    color: white;
}
.input-box {
    margin: 8px 0;
    display: none;
    flex-direction: column;
    gap: 6px;
}
.input-box input {
    padding: 6px;
    border-radius: 5px;
    border: none;
    outline: none;
}
.input-box button {
    padding: 6px;
    border: none;
    background: #2575fc;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}
.input-box button:hover {
    background: #1a5fd8;
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
            <a href="#" onclick="toggleInput('ticketEdit')">✏️ Editar Ticket</a>
            <div id="ticketEdit" class="input-box">
                <input type="number" id="ticketEditId" placeholder="ID Ticket">
                <button onclick="goToId('/tickets/edit', 'ticketEditId')">Editar</button>
            </div>
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
            <a href="#" onclick="toggleInput('orderShow')">🔍 Buscar Orden</a>
            <div id="orderShow" class="input-box">
                <input type="number" id="orderId" placeholder="ID Orden">
                <button onclick="goToId('/orders/show', 'orderId')">Ir</button>
            </div>
        </div>
    </div>

    <!-- Carrito -->
    <div class="section" id="shoppingCarSectionWrapper">
        <div class="section-header" onclick="toggleSection('shoppingCarSection', this)">
            Carrito <span class="arrow">▶</span>
        </div>
        <div id="shoppingCarSection" class="section-content">
            <a href="#" onclick="toggleInput('shoppingCar')">🛒 Ver Mi Carrito</a>
            <div id="shoppingCar" class="input-box">
                <input type="number" id="id" placeholder="ID shoppingCar">
                <button onclick="goToId('/shoppingCar/show', 'id', 'id_person')">Buscar</button>
            </div>
            <a href="/shoppingCar/add">➕ Agregar Producto</a>
        </div>
    </div>

    <!-- Favoritos -->
    <div class="section" id="favoritesSectionWrapper">
        <div class="section-header" onclick="toggleSection('favoritesSection', this)">
            Favoritos <span class="arrow">▶</span>
        </div>
        <div id="favoritesSection" class="section-content">
            <a href="#" onclick="toggleInput('favorites')">⭐ Mis Favoritos</a>
            <div id="favorites" class="input-box">
                <input type="number" id="favoriteId" placeholder="ID Favorito">
                <button onclick="goToId('/favorites/show', 'favoriteId', 'id_person')">Buscar</button>
            </div>
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
function toggleInput(id) {
    const box = document.getElementById(id);
    box.style.display = (box.style.display === "flex") ? "none" : "flex";
}
function goToId(baseRoute, inputId, paramName = "id") {
    const id = document.getElementById(inputId).value.trim();
    if (!id) { alert("Por favor ingresa un ID"); return; }
    window.location.href = baseRoute + "?" + paramName + "=" + id;
}
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

document.addEventListener('DOMContentLoaded', function() {
    const roleId = localStorage.getItem('role_id');

    if(roleId === "1"){
        const ticketsContent = document.getElementById("ticketsSection");
        Array.from(ticketsContent.children).forEach(el => {
            if(!el.textContent.includes("Crear Ticket")) el.style.display = "none";
        });

        const ordersContent = document.getElementById("ordersSection");
        Array.from(ordersContent.children).forEach(el => {
            if(el.textContent.includes("Buscar Orden")) el.style.display = "none";
        });

        const payloadsContent = document.getElementById("payloadsSection");
        Array.from(payloadsContent.children).forEach(el => {
            if(!el.textContent.includes("Crear Pago")) el.style.display = "none";
        });

        ["shoppingCarSectionWrapper", "favoritesSectionWrapper"].forEach(id => {
            document.getElementById(id).style.display = "block";
        });

    } else if(roleId === "2"){
        ["ticketsSectionWrapper","ordersSectionWrapper","shoppingCarSectionWrapper","favoritesSectionWrapper","payloadsSectionWrapper"].forEach(id => {
            document.getElementById(id).style.display = "block";
        });
    }
});
</script>

</body>
</html>
