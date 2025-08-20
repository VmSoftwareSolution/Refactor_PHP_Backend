<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 {
            margin-bottom: 1rem;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold;
        }
        input[type="email"] {
            width: 100%;
            padding: .5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: .75rem;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        #message {
            margin-top: 1rem;
            padding: .75rem;
            border-radius: 4px;
            display: none;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Restablecer Contraseña</h2>
        <form id="resetForm">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Generar código</button>
        </form>
        <div id="message"></div>
    </div>

    <script>
        document.getElementById("resetForm").addEventListener("submit", async function(event) {
            event.preventDefault();

            const email = document.getElementById("email").value;

            const formData = new URLSearchParams();
            formData.append("email", email);

            try {
                const response = await fetch("/user/generateResetCode", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: formData.toString()
                });

                let data;
                try {
                    data = await response.json();
                } catch (e) {
                    console.error("Error parseando JSON:", e);
                    data = { status: response.status, message: "Respuesta inválida del servidor" };
                }


                const msgDiv = document.getElementById("message");
                msgDiv.style.display = "block";

                if (data.status === 200) {
                    msgDiv.textContent = data.message;
                    msgDiv.className = "success";

                    localStorage.setItem("reset_code", data.reset_code);
                    localStorage.setItem("reset_email", email);
                    window.location.href = 'http://localhost:8000/validateResetCode';
                } else {
                    msgDiv.textContent = `Error ${data.status}: ${data.message}`;
                    msgDiv.className = "error";
                }
            } catch (error) {
                console.error("Error en fetch:", error);
                const msgDiv = document.getElementById("message");
                msgDiv.style.display = "block";
                msgDiv.textContent = "Error de conexión con el servidor.";
                msgDiv.className = "error";
            }
        });
    </script>
</body>
</html>
