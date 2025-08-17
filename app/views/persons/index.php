<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Personas</title>
<style>
/* Layout general con sidebar */
body {
    margin: 0;
    display: flex;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f0f0;
}

/* Sidebar ocupa el lado izquierdo */
.navbar {
    flex-shrink: 0; /* evita que se reduzca */
}

/* Contenido principal */
.main-content {
    flex-grow: 1;
    padding: 2rem;
}

/* Estilos internos */
h2 {
    text-align: center;
    margin-bottom: 2rem;
    color: #333;
}
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}
.card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    text-align: center;
}
.card h3 {
    margin: 10px 0;
}
.card p {
    margin: 5px 0;
    color: #555;
}
.card a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 15px;
    background-color: #2575fc;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
}
.card a:hover {
    background-color: #1a5edb;
}
</style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>

    <div class="main-content">
        <h2>Personas</h2>
        <div class="grid">
        <?php foreach($persons as $person): ?>
            <div class="card">
                <h3><?= htmlspecialchars($person->full_name) ?></h3>
                <p>Teléfono: <?= htmlspecialchars($person->phone) ?></p>
                <p>Género: <?= htmlspecialchars($person->gender) ?></p>
                <a href="/persons/findById?id=<?= htmlspecialchars($person->id) ?>">Ver detalle</a>
                <a href="/persons/edit?id=<?= htmlspecialchars($person->id) ?>">Editar</a>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
