<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Roles</title>
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
    width: 700px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #ccc;
    text-align: left;
}
th {
    background: #2575fc;
    color: #fff;
    border-radius: 8px 8px 0 0;
}
tr:hover {
    background: #f2f2f2;
}
button {
    padding: 8px 15px;
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-right: 5px;
}
button:hover {
    background: #c0392b;
}
.actions button.show {
    background: #2ecc71;
}
.actions button.show:hover {
    background: #27ae60;
}
.actions button.edit {
    background: #3498db;
}
.actions button.edit:hover {
    background: #217dbb;
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
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
<div class="container">
    <h2>Roles Registrados</h2>
    <div id="messageContainer"></div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody id="roleTableBody">
        </tbody>
    </table>
</div>

<script>
async function loadRoles() {
    const tableBody = document.getElementById('roleTableBody');
    const messageContainer = document.getElementById('messageContainer');
    tableBody.innerHTML = '';
    messageContainer.innerHTML = '';

    try {
        const response = await fetch('/roles');
        const result = await response.json();

        if (response.ok && result.data) {
            result.data.forEach(role => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${role.id}</td>
                    <td>${role.name}</td>
                    <td>${role.description ?? ''}</td>
                `;
                tableBody.appendChild(tr);
            });
        } else {
            showMessage('error', 'No se pudieron cargar los roles');
        }
    } catch (error) {
        showMessage('error', 'Error de conexión al cargar roles');
    }
}

function showMessage(type, message) {
    const container = document.getElementById('messageContainer');
    const box = document.createElement('div');
    box.className = `message-box ${type}`;
    box.textContent = message;
    container.appendChild(box);
}

window.onload = loadRoles;
</script>
</body>
</html>
