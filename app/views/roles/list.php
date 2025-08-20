<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Roles</title>
<style>
body {
    margin: 0;
    display: flex;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f6f9;
}

.main-content {
    flex-grow: 1;
    padding: 2rem;
}

h2 {
    text-align: center;
    margin-bottom: 2rem;
    color: #2c3e50;
    font-size: 2rem;
    font-weight: bold;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
}

.card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.card h3 {
    margin: 10px 0;
    color: #34495e;
    font-size: 1.2rem;
}
.card p {
    margin: 5px 0;
    color: #555;
    font-size: 0.95rem;
}

.card a, .card form button, .card-btn, .back-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 18px;
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}
.card a:hover, .card form button:hover, .card-btn:hover, .back-btn:hover {
    background: linear-gradient(135deg, #1a5edb, #4a0fa3);
    transform: scale(1.05);
}
.card form {
    display: inline;
}

.create-container {
    text-align: center;
    margin-bottom: 25px;
}
.create-container .card-btn {
    font-weight: bold;
    font-size: 1rem;
}

.back-container {
    text-align: left;
    margin-bottom: 20px;
}
</style>
</head>
<body>

    <div class="main-content">
        <div class="back-container">
            <a href="http://localhost:8000/admin" class="back-btn">⬅ Back</a>
        </div>

        <h2>Roles</h2>

        <div class="create-container">
            <a href="/role/create" class="card-btn">+ Crear Rol</a>
        </div>

        <div class="grid">
        <?php foreach($roles as $role): ?>
            <div class="card">
                <h3><?= htmlspecialchars($role->name ?? '', ENT_QUOTES, 'UTF-8') ?></h3>
                <p><strong>ID:</strong> <?= htmlspecialchars($role->id ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                <p><?= htmlspecialchars($role->description ?? '', ENT_QUOTES, 'UTF-8') ?></p>

                <a href="/role/edit?id=<?= htmlspecialchars($role->id ?? '', ENT_QUOTES, 'UTF-8') ?>">Editar</a>

                <form class="delete-form" data-id="<?= htmlspecialchars($role->id ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        if (!confirm("¿Seguro que deseas eliminar este rol?")) return;

        const roleId = this.getAttribute('data-id');
        try {
            const res = await fetch('/role/delete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ id: roleId })
            });

            const data = await res.json();

            if (data.status === 200) {
                alert(data.message);
                window.location.href = "/roles/list"; 
            } else {
                alert("Error al eliminar: " + (data.message || "Ocurrió un error"));
            }
        } catch (err) {
            alert("Error de conexión: " + err.message);
        }
    });
});
</script>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>
