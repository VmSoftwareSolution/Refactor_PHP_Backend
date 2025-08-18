<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Perfil</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f0f0f0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 700px;
    }
    h2 {
        color: #8b5cf6;
        font-size: 24px;
        margin-bottom: 30px;
        text-align: left;
    }
    .form-section {
        margin-bottom: 25px;
    }
    .form-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-field {
        display: flex;
        flex-direction: column;
    }
    .form-field label {
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
    }
    .form-field input, .form-field select {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: #f9f9f9;
        font-size: 14px;
        color: #333;
    }
    .form-field input:focus, .form-field select:focus {
        border-color: #8b5cf6;
        background-color: #fff;
        outline: none;
    }
    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }
    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s, opacity 0.3s;
    }
    .btn-cancel {
        background-color: transparent;
        color: #555;
    }
    .btn-cancel:hover {
        opacity: 0.8;
    }
    .btn-save {
        background-color: #8b5cf6;
        color: white;
    }
    .btn-save:hover {
        background-color: #7c3aed;
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
    <div class="breadcrumb">
            <a href="http://localhost:8000/products/list">Home</a>
            <span>/</span>
            <span class="current">Person</span>
    </div>
    <h2>Edit Your Profile</h2>

    <div id="messageContainer"></div>

    <form id="editPersonForm" action="/persons/update" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($person->id) ?>">
        <input type="hidden" name="id_user" value="<?= htmlspecialchars($person->id_user) ?>">

        <div class="form-section">
            <div class="form-group">
                <div class="form-field">
                    <label>Nombre completo</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($person->full_name) ?>" required>
                </div>
                <div class="form-field">
                    <label>Teléfono</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($person->phone) ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="form-field">
                    <label>Género</label>
                    <select name="gender">
                        <option value="male" <?= $person->gender === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= $person->gender === 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= $person->gender === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="form-field">
                    <label>Fecha de nacimiento</label>
                    <input type="date" name="date_of_birth" value="<?= htmlspecialchars($person->date_of_birth) ?>">
                </div>
            </div>
            <div class="form-field">
                <label>Avatar URL</label>
                <input type="text" name="avatar" value="<?= htmlspecialchars($person->avatar) ?>">
            </div>
        </div>


        <div class="btn-container">
            <a href="/persons/findById?id=<?= htmlspecialchars($person->id) ?>" class="btn btn-cancel">Cancel</a>
            <button type="submit" class="btn btn-save">Save Changes</button>
        </div>
    </form>
</div>

<script>
    const form = document.getElementById('editPersonForm');
    const messageContainer = document.getElementById('messageContainer');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(form);

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