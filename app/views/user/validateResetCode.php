<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validar Código</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 1.5rem;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            text-align: left;
            font-weight: bold;
            color: #444;
        }
        input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            background: #f1f1f1;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            background: #28a745;
            color: white;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #218838;
        }
        #message {
            margin-top: 1rem;
            padding: 0.75rem;
            border-radius: 6px;
            display: none;
        }
        #message.success {
            background: #d4edda;
            color: #155724;
        }
        #message.error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Validar Código de Restablecimiento</h2>
        <form id="validateForm">
            <label for="resetCode">Código de verificación:</label>
            <input type="text" id="resetCode" name="resetCode" readonly>

            <button type="submit">Validar</button>
        </form>
        <div id="message"></div>
    </div>

    <script>
        const savedCode = localStorage.getItem("reset_code");

        const inputCode = document.getElementById("resetCode");
        inputCode.value = "";

        setTimeout(() => {
            inputCode.value = savedCode ?? "";
        }, 1500);

        document.getElementById("validateForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const code = inputCode.value;

            const msgDiv = document.getElementById("message");
            msgDiv.style.display = "block";
            msgDiv.className = "success";
            msgDiv.textContent = "Validación pendiente de implementación.";
            window.location.href = 'http://localhost:8000/forgetPassword';
        });
    </script>
</body>
</html>
