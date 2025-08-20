<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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

    .register-link {
      margin-top: 15px;
      font-size: 14px;
      color: #555;
    }

    .register-link a {
      color: #6a11cb;
      text-decoration: none;
    }

    .register-link a:hover {
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
      <h2>Iniciar Sesión</h2>
      <p class="subtitle">Ingresa tus credenciales</p>

      <div id="messageContainer"></div>
      <form id="loginForm" action="/user/loginUser" method="POST">
        <label>Email</label>
        <input type="email" name="email" id="email" required>

        <label>Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" id="submitBtn">Ingresar</button>
      </form>

      <p class="register-link">
        ¿No tienes cuenta? <a href="http://localhost:8000/user/create">Regístrate aquí</a>
      </p>
    </div>
  </div>

  <script>
    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const messageContainer = document.getElementById('messageContainer');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        messageContainer.innerHTML = '';
        submitBtn.disabled = true;
        submitBtn.textContent = 'Iniciando sesión...';
        form.classList.add('loading');

        try {
            const response = await fetch('/user/loginUser', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (response.ok && result.status === 200) {
                // Guardar datos y tiempo de login
                localStorage.setItem('role_id', result.role_id);
                localStorage.setItem('id_person', result.id_person);
                localStorage.setItem('id_user', result.id_user);
                localStorage.setItem('loginTime', Date.now());

                showMessage('success', result.message || 'Login exitoso');
                form.reset();
                clearInputErrors();

                setTimeout(() => {
                    const idPerson = localStorage.getItem('id_person');
                    if (!idPerson || idPerson === "null") {
                        window.location.href = 'http://localhost:8000/persons/create';
                    } else {
                        window.location.href = 'http://localhost:8000/products/list';
                    }
                }, 500);
            } else {
                showMessage('error', result.message || 'Credenciales inválidas');
                highlightErrorFields(result.errors || {});
            }
        } catch (error) {
            showMessage('error', 'Error de conexión. Intenta nuevamente.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Iniciar Sesión';
            form.classList.remove('loading');
        }
    });

    function showMessage(type, message) {
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
</body>
</html>
