<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
            color: #333;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #1e1e2f;
            margin-bottom: 30px;
            font-size: 1.8em;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            background: #f9f9f9;
            font-family: inherit;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.2);
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #6a11cb;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #2575fc;
        }

        .submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .message-box {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: left;
            animation: slideDown 0.5s ease-in-out;
        }

        .message-box.error {
            background: #ffe0e0;
            color: #900;
        }

        .message-box.success {
            background: #e8f5e8;
            color: #2e7d32;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cambiar Contraseña</h2>
    <div id="messageContainer"></div>
    <form id="changePasswordForm">
        <input type="hidden" name="id" id="userId" value="<?= htmlspecialchars($user->id) ?>">

        <div class="form-group">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" id="submitBtn" class="submit-btn">Actualizar Contraseña</button>
    </form>
</div>

<script>
    document.getElementById('changePasswordForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const submitBtn = document.getElementById('submitBtn');
        const messageContainer = document.getElementById('messageContainer');
        const formData = new FormData(form);

        // Opcionalmente, puedes tomar el id del localStorage si no se pasa desde el servidor
        const userId = localStorage.getItem('id_person');
        if (userId) {
            formData.set('id', userId);
        }

        messageContainer.innerHTML = '';
        submitBtn.disabled = true;
        submitBtn.textContent = 'Actualizando...';

        try {
            const response = await fetch('/user/changePassword', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.status === 200) {
                showMessage('success', result.message || 'Contraseña actualizada exitosamente');
                form.reset();
            } else {
                showMessage('error', result.message || 'Error al actualizar la contraseña');
            }
        } catch (error) {
            showMessage('error', 'Error de conexión. Intenta nuevamente.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Actualizar Contraseña';
        }
    });

    function showMessage(type, message) {
        const messageContainer = document.getElementById('messageContainer');
        const messageBox = document.createElement('div');
        messageBox.className = `message-box ${type}`;
        const icon = type === 'success' ? '✅' : '⚠️';
        const title = type === 'success' ? '¡Éxito!' : 'Error:';
        messageBox.innerHTML = `<strong>${icon} ${title}</strong> ${message}`;
        messageContainer.innerHTML = ''; // Limpiar mensaje anterior
        messageContainer.appendChild(messageBox);
    }
</script>
<script src="/js/sessionCheck.js"></script>
<script src="/js/accessControl.js"></script>
</body>
</html>