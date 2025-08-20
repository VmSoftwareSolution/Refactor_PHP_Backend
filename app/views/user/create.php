<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
        }

        .left-side {
            flex: 1;
            background: #f5f8fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-side img {
            max-width: 80%;
            height: auto;
            border-radius: 12px;
        }

        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            padding: 40px;
        }

        .form-container {
            max-width: 350px;
            width: 100%;
        }

        h2 {
            margin-bottom: 10px;
            color: #000;
        }

        p.subtitle {
            margin-bottom: 25px;
            font-size: 14px;
            color: #555;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106,17,203,0.5);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #6a11cb;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #4b0fa5;
        }

        button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .message-box {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            text-align: left;
            animation: slideDown 0.5s ease-in-out;
            font-size: 14px;
        }

        .message-box.error {
            background: #ffe0e0;
            border-left: 5px solid #ff4b5c;
            color: #900;
        }

        .message-box.success {
            background: #e8f5e8;
            border-left: 5px solid #4caf50;
            color: #2e7d32;
        }

        .message-box strong {
            font-weight: bold;
        }

        @keyframes slideDown {
            from {opacity: 0; transform: translateY(-10px);}
            to {opacity: 1; transform: translateY(0);}
        }

        input.error {
            border-color: #ff4b5c !important;
            box-shadow: 0 0 5px rgba(255, 75, 92, 0.5) !important;
        }

        .loading {
            opacity: 0.7;
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .login-link a {
            color: #6a11cb;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="left-side">
        <img src="/images/login.png" alt="Imagen ilustrativa">
    </div>

    <div class="right-side">
        <div class="form-container">
            <h2>Crear Usuario</h2>
            <p class="subtitle">Ingresa tus datos a continuación</p>

            <div id="messageContainer"></div>
            <form id="createUserForm" action="/user/createUser" method="POST">
                <label>Email</label>
                <input type="email" name="email" id="email" required>

                <label>Password</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" id="submitBtn">Crear Usuario</button>
            </form>

            <p class="login-link">
                ¿Ya tienes cuenta? <a href="http://localhost:8000/user/login">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
    <script>
        document.getElementById('createUserForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            const messageContainer = document.getElementById('messageContainer');
            const formData = new FormData(form);
            messageContainer.innerHTML = '';
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creando usuario...';
            form.classList.add('loading');
            try {
                const response = await fetch('/user/createUser', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (response.ok && result.status === 201) {
                    window.location.href = 'http://localhost:8000/persons/create';
                    showMessage('success', result.message || 'Usuario creado exitosamente');
                    form.reset();
                    clearInputErrors();
                } else {
                    showMessage('error', result.message || 'Error al crear el usuario');
                    highlightErrorFields(result.errors || {});
                }
            } catch (error) {
                showMessage('error', 'Error de conexión. Intenta nuevamente.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Crear Usuario';
                form.classList.remove('loading');
            }
        });

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

        function clearInputErrors() {
            document.querySelectorAll('input.error').forEach(input => input.classList.remove('error'));
        }

        function highlightErrorFields(errors) {
            Object.keys(errors).forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field) field.classList.add('error');
            });
        }
    </script>
<script src="/js/sessionCheck.js"></script>
</body>
</html>
