<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            padding: 40px;
            color: #333;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .dashboard-header h1 {
            color: #1e1e2f;
            font-size: 2.5em;
            margin: 0;
        }

        .dashboard-header p {
            color: #666;
            font-size: 1.1em;
            margin-top: 10px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            margin-top: 0;
            color: #1e1e2f;
            font-size: 1.5em;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .card-content a {
            text-decoration: none;
            color: #6a11cb;
            font-weight: 600;
            font-size: 1em;
            padding: 10px 0;
            border-radius: 6px;
            transition: background 0.2s ease, color 0.2s ease;
        }
        
        .card-content a:hover {
            background-color: #e2e8f0;
            color: #2b2b3d;
        }

        .card-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #6a11cb;
        }
    </style>
</head>
<body>
<div class="dashboard-header">
    <h1>Panel de Administración</h1>
    <p>Utiliza las tarjetas de abajo para gestionar las distintas secciones de la tienda.</p>
</div>

<div class="dashboard-grid">

    <div class="card">
        <div class="card-icon">👥</div>
        <h3>Roles</h3>
        <div class="card-content">
            <a href="/roles/list">📜 Ver Todos</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-icon">👨‍💻</div>
        <h3>Usuarios</h3>
        <div class="card-content">
            <a href="/users/view">📜 Ver Todos</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-icon">👤</div>
        <h3>Personas</h3>
        <div class="card-content">
            <a href="/persons">📜 Ver Todos</a>
        </div>
    </div>

    <div class="card">
        <div class="card-icon">📦</div>
        <h3>Productos</h3>
        <div class="card-content">
            <a href="/products/list">📜 Ver Todos</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-icon">🛒</div>
        <h3>Órdenes</h3>
        <div class="card-content">
            <a href="/orders/list">🔍 Ver Orden</a>
        </div>
    </div>

    <div class="card">
        <div class="card-icon">🎫</div>
        <h3>Tickets</h3>
        <div class="card-content">
            <a href="/tickets/create">➕ Crear Ticket</a>
            <a href="/tickets/show">🔍 Ver Ticket</a>
            <a href="/tickets/edit">✏️ Editar Ticket</a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-icon">🚚</div>
        <h3>Envíos</h3>
        <div class="card-content">
            <a href="/shipments/create">🚚 Crear Envío</a>
            <a href="/shipments/show">🔍 Ver Envío</a>
        </div>
    </div>

     <div class="card">
        <div class="card-icon">Admin</div>
        <h3>Ver registro</h3>
        <div class="card-content">
            <a href="/dashboardAdmin">Dashboard</a>
        </div>
    </div>
    

</div>

</body>
</html>