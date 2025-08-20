<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Usuarios Registrados</title>
<style>
body {
    display: flex;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    margin: 0;
    padding: 2rem;
}
.container {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    width: 900px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
.back-container {
    text-align: left;
    margin-bottom: 20px;
}
.back-btn {
    display: inline-block;
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
.back-btn:hover {
    background: linear-gradient(135deg, #1a5edb, #4a0fa3);
    transform: scale(1.05);
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-size: 1.8rem;
}
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 25px;
}
.card {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    min-height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}
.card h3 {
    margin: 0 0 15px 0;
    color: #34495e;
    font-size: 1.3rem;
    word-wrap: break-word;
}
.card p {
    margin: 5px 0;
    color: #555;
    font-size: 1rem;
}
.card-actions {
    margin-top: 15px;
    display: flex;
    justify-content: center;
    gap: 10px;
}
.card-btn {
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}
.card-btn.update {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    color: #fff;
}
.card-btn.update:hover {
    background: linear-gradient(135deg, #1a5edb, #4a0fa3);
    transform: scale(1.05);
}
.card-btn.delete {
    background: #e74c3c;
    color: #fff;
}
.card-btn.delete:hover {
    background: #c0392b;
    transform: scale(1.05);
}
.message-box {
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
}
.message-box.error {
    background: #ffe0e0;
    color: #900;
}
.message-box.success {
    background: #e8f5e8;
    color: #2e7d32;
}
</style>
</head>
<body>
<div class="container">
    <div class="back-container">
        <a href="http://localhost:8000/admin" class="back-btn">⬅ Back</a>
    </div>

    <h2>Usuarios Registrados</h2>

    <div id="messageContainer"></div>

    <div class="grid" id="userGrid"></div>
</div>

<script>
async function loadUsers() {
    const grid = document.getElementById('userGrid');
    const messageContainer = document.getElementById('messageContainer');
    grid.innerHTML = '';
    messageContainer.innerHTML = '';

    try {
        const response = await fetch('/users');
        const result = await response.json();

        if (response.ok && result.data) {
            result.data.forEach(user => {
                const card = document.createElement('div');
                card.className = 'card';
                card.id = 'user-' + user.id;
                card.innerHTML = `
                    <h3>👤 ${user.email}</h3>
                    <p><strong>ID:</strong> ${user.id}</p>
                    <p><strong>Rol:</strong> ${user.role_id}</p>
                    <div class="card-actions">
                        <a href="/user/edit?id=${user.id}" class="card-btn update">Editar</a>
                        <button class="card-btn delete" data-id="${user.id}">Eliminar</button>
                    </div>
                `;
                grid.appendChild(card);
            });

            // Asignar eventos de delete
            document.querySelectorAll('.card-btn.delete').forEach(btn => {
                btn.addEventListener('click', async function() {
                    if(!confirm('¿Seguro que deseas eliminar este usuario?')) return;

                    const userId = this.dataset.id;
                    try {
                        const res = await fetch('/user/delete', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'id=' + encodeURIComponent(userId)
                        });
                        const data = await res.json();
                        showMessage('success', data.message || 'Usuario eliminado');
                        const userCard = document.getElementById('user-' + userId);
                        if(userCard) userCard.remove();
                    } catch (err) {
                        showMessage('error', 'Error al eliminar el usuario');
                    }
                });
            });

        } else {
            showMessage('error', 'No se pudieron cargar los usuarios');
        }
    } catch (error) {
        showMessage('error', 'Error de conexión al cargar usuarios');
    }
}

function showMessage(type, message) {
    const container = document.getElementById('messageContainer');
    const box = document.createElement('div');
    box.className = `message-box ${type}`;
    box.textContent = message;
    container.appendChild(box);

    // Eliminar mensaje automáticamente después de 3 segundos
    setTimeout(() => box.remove(), 3000);
}

window.onload = loadUsers;
</script>
</body>
</html>
