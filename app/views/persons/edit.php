<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Persona</title>
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
    width: 450px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}
label {
    display: block;
    margin-top: 1rem;
    font-weight: bold;
    color: #555;
}
input[type="text"], input[type="number"], input[type="date"], select {
    width: 100%;
    padding: 8px;
    margin-top: 4px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    background-color: #2575fc;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    margin-top: 20px;
}
button:hover {
    background-color: #1a5edb;
}
.btn-back {
    display: inline-block;
    margin-top: 10px;
    background-color: #aaa;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
}
.btn-back:hover {
    background-color: #888;
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
    <h2>Editar Persona #<?= htmlspecialchars($person->id) ?></h2>

    <div id="messageContainer"></div>

    <form id="editPersonForm" action="/persons/update" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($person->id) ?>">

        <label>Nombre completo:
            <input type="text" name="full_name" value="<?= htmlspecialchars($person->full_name) ?>" required>
        </label>

        <label>Teléfono:
            <input type="text" name="phone" value="<?= htmlspecialchars($person->phone) ?>">
        </label>

        <label>Género:
            <select name="gender">
                <option value="male" <?= $person->gender === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?= $person->gender === 'female' ? 'selected' : '' ?>>Female</option>
                <option value="other" <?= $person->gender === 'other' ? 'selected' : '' ?>>Other</option>
            </select>
        </label>

        <label>Fecha de nacimiento:
            <input type="date" name="date_of_birth" value="<?= htmlspecialchars($person->date_of_birth) ?>">
        </label>

        <label>Avatar URL:
            <input type="text" name="avatar" value="<?= htmlspecialchars($person->avatar) ?>">
        </label>

        <label>Usuario:</label>
        <select name="id_user" required>
            <option value="">Seleccione un usuario</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id ?>" <?= $user->id == $person->id_user ? 'selected' : '' ?>>
                    <?= htmlspecialchars($user->email) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Actualizar</button>
    </form>

    <a href="/persons/findById?id=<?= htmlspecialchars($person->id) ?>" class="btn-back">Cancelar</a>
</div>

<script>
const form = document.getElementById('editPersonForm');
const messageContainer = document.getElementById('messageContainer');

form.addEventListener('submit', async function(event) {
    event.preventDefault();

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        });

        if (!response.ok) {
            const errorData = await response.json();
            showMessage('error', errorData.error || 'Ocurrió un error');
        } else {
            showMessage('success', '¡Persona actualizada correctamente!');
            setTimeout(() => window.location.href = '/persons/findById?id=' + data.id, 1500);
        }
    } catch (err) {
        showMessage('error', 'Error de conexión o inesperado');
    }
});

function showMessage(type, message) {
    const msg = document.createElement('div');
    msg.className = `message-box ${type}`;
    const icon = type === 'success' ? '✅' : '⚠️';
    const title = type === 'success' ? '¡Éxito!' : 'Error:';
    msg.innerHTML = `<strong>${icon} ${title}</strong> ${message}`;
    messageContainer.innerHTML = '';
    messageContainer.appendChild(msg);
}
</script>
</body>
</html>
