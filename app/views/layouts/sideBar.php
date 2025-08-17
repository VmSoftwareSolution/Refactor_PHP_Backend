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

<div class="navbar">
    <h2>Menú</h2>

    <!-- Roles -->
    <div class="section">
        <div class="section-header" onclick="toggleSection('rolesSection', this)">
            Roles <span class="arrow">▶</span>
        </div>
        <div id="rolesSection" class="section-content">
            <a href="/roles/list">📋 Listar Roles</a>
            <a href="/role/create">➕ Crear Rol</a>
            <a href="#" onclick="toggleInput('roleEdit')">✏️ Editar Rol</a>
            <div id="roleEdit" class="input-box">
                <input type="number" id="roleEditId" placeholder="ID Rol">
                <button onclick="goToId('/role/edit', 'roleEditId')">Editar</button>
            </div>
        </div>
    </div>

    <!-- Usuarios -->
    <div class="section">
        <div class="section-header" onclick="toggleSection('usersSection', this)">
            Usuarios <span class="arrow">▶</span>
        </div>
        <div id="usersSection" class="section-content">
            <a href="/users/view">👥 Listar Usuarios</a>
            <a href="/user/create">➕ Crear Usuario</a>
            <a href="#" onclick="toggleInput('Edit')">✏️ Editar Usuario</a>
            <div id="Edit" class="input-box">
                <input type="number" id="editId" placeholder="ID Usuario">
                <button onclick="goToId('/user/edit', 'editId')">Editar</button>
            </div>
            <a href="#" onclick="toggleInput('EditPassword')">✏️ Editar Contraseña</a>
             <div id="EditPassword" class="input-box">
                <input type="number" id="userEditId" placeholder="ID Usuario">
                <button onclick="goToId('/user/editUser', 'userEditId')">Editar</button>
            </div>
        </div>
    </div>

    <!-- Personas -->
    <div class="section">
        <div class="section-header" onclick="toggleSection('personsSection', this)">
            Personas <span class="arrow">▶</span>
        </div>
        <div id="personsSection" class="section-content">
            <a href="/persons">👤 Listar Personas</a>
            <a href="/persons/create">➕ Crear Persona</a>
            <a href="#" onclick="toggleInput('personShow')">🔍 Buscar Persona</a>
            <div id="personShow" class="input-box">
                <input type="number" id="personId" placeholder="ID Persona">
                <button onclick="goToId('/persons/findById', 'personId')">Ir</button>
            </div>
            <a href="#" onclick="toggleInput('personEdit')">✏️ Editar Persona</a>
            <div id="personEdit" class="input-box">
                <input type="number" id="personEditId" placeholder="ID Persona">
                <button onclick="goToId('/persons/edit', 'personEditId')">Editar</button>
            </div>
        </div>
    </div>

    <!-- Productos -->
    <div class="section">
        <div class="section-header" onclick="toggleSection('productsSection', this)">
            Productos <span class="arrow">▶</span>
        </div>
        <div id="productsSection" class="section-content">
            <a href="/products/list">📦 Listar Productos</a>
            <a href="/products/create">➕ Crear Producto</a>
            <a href="#" onclick="toggleInput('productShow')">🔍 Buscar Producto</a>
            <div id="productShow" class="input-box">
                <input type="number" id="productId" placeholder="ID Producto">
                <button onclick="goToId('/products/findById', 'productId')">Ir</button>
            </div>
            <a href="#" onclick="toggleInput('productEdit')">✏️ Editar Producto</a>
            <div id="productEdit" class="input-box">
                <input type="number" id="productEditId" placeholder="ID Producto">
                <button onclick="goToId('/products/edit', 'productEditId')">Editar</button>
            </div>
        </div>
    </div>

    <!-- Tickets -->
    <div class="section">
        <div class="section-header" onclick="toggleSection('ticketsSection', this)">
            Tickets <span class="arrow">▶</span>
        </div>
        <div id="ticketsSection" class="section-content">
            <a href="/tickets/list">🎟️ Listar Tickets</a>
            <a href="/tickets/create">➕ Crear Ticket</a>
            <a href="#" onclick="toggleInput('ticketEdit')">✏️ Editar Ticket</a>
            <div id="ticketEdit" class="input-box">
                <input type="number" id="ticketEditId" placeholder="ID Ticket">
                <button onclick="goToId('/tickets/edit', 'ticketEditId')">Editar</button>
            </div>
        </div>
    </div>

       <!-- ShoppingCar -->
    <div class="section">
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

    <!-- Favorites -->
    <div class="section">
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

    <!-- Orders -->
    <div class="section">
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

    <!-- Shipments -->
    <div class="section">
        <div class="section-header" onclick="toggleSection('shipmentsSection', this)">
            Envíos <span class="arrow">▶</span>
        </div>
        <div id="shipmentsSection" class="section-content">
            <a href="/shipments/create">🚚 Crear Envío</a>
            <a href="#" onclick="toggleInput('shipmentShow')">🔍 Buscar Envío</a>
            <div id="shipmentShow" class="input-box">
                <input type="number" id="shipmentId" placeholder="ID Envío">
                <button onclick="goToId('/shipments/show', 'shipmentId')">Ir</button>
            </div>
        </div>
    </div>

    <!-- Payloads -->
    <div class="section">
        <div class="section-header" onclick="toggleSection('payloadsSection', this)">
            Pagos <span class="arrow">▶</span>
        </div>
        <div id="payloadsSection" class="section-content">
            <a href="/payloads/create">💳 Crear Pago</a>
            <a href="#" onclick="toggleInput('payloadShow')">🔍 Buscar Pago</a>
            <div id="payloadShow" class="input-box">
                <input type="number" id="payloadId" placeholder="ID Pago">
                <button onclick="goToId('/payloads/show', 'payloadId')">Ir</button>
            </div>
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
    if (!id) {
        alert("Por favor ingresa un ID");
        return;
    }
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
</script>
