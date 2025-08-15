<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Persona</title>
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
    margin-top: 15px;
    font-weight: bold;
    color: #555;
}
input[type="text"], input[type="number"], input[type="date"], select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    margin-top: 20px;
    width: 100%;
    background-color: #2575fc;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}
button:hover {
    background-color: #1a5edb;
}
a.cancel-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #555;
    text-decoration: none;
}
a.cancel-link:hover {
    color: #2575fc;
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
    <h2>Crear Persona</h2>
    <div id="messageContainer"></div>

    <form action="/persons/createPerson" method="post">
        <label>Nombre completo:
            <input type="text" name="full_name" required>
        </label>

        <label>Teléfono:
            <input type="text" name="phone">
        </label>

        <label>Género:
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other" selected>Other</option>
            </select>
        </label>

        <label>Fecha de nacimiento:
            <input type="date" name="date_of_birth">
        </label>

        <label>Avatar URL:
            <input type="text" name="avatar">
        </label>

        <label>ID Usuario:
            <input type="number" name="id_user" required>
        </label>

        <button type="submit">Crear Persona</button>
    </form>
    <a href="/persons" class="cancel-link">Cancelar</a>
</div>

<script>
function showMessage(type, message) {
    const messageContainer = document.getElementById('messageContainer');
    const messageBox = document.createElement('div');
    messageBox.className = `message-box ${type}`;
    const icon = type === 'success' ? '✅' : '⚠️';
    const title = type === 'success' ? '¡Éxito!' : 'Error:';
    messageBox.innerHTML = `<strong>${icon} ${title}</strong> ${message}`;
    messageContainer.appendChild(messageBox);
    if (type === 'success') {
        setTimeout(() => {
            messageBox.style.opacity = '0';
            messageBox.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                if (messageBox.parentNode) messageBox.parentNode.removeChild(messageBox);
            }, 500);
        }, 5000);
    }
}
</script>
</body>
</html>
