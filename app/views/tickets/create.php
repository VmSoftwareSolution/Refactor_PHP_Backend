<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Ticket</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #1e1e2f;
            margin-bottom: 30px;
            font-size: 1.8em;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
        }
        
        input[type="text"],
        input[type="number"],
        textarea {
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
        
        input:focus,
        textarea:focus {
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
            <span class="current">PQR</span>
        </div>
        <h2>Crear Ticket</h2>
        <div id="messageContainer"></div>
        <form id="createTicketForm">
            <div class="form-group">
                <label for="tittle">Título:</label>
                <input type="text" id="tittle" name="tittle" required>
            </div>

            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="5"></textarea>
            </div>
            
            <input type="hidden" id="id_person" name="id_person">

            <button type="submit" id="submitBtn" class="submit-btn">Crear Ticket</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const id_person_input = document.getElementById('id_person');
            const storedId = localStorage.getItem('id_person');
            if (storedId) {
                id_person_input.value = storedId;
            } else {
                alert('No se encontró el ID de la persona en el almacenamiento local. Por favor, inicie sesión.');
                // Redirigir al inicio de sesión o manejar el error
                // window.location.href = '/user/login';
            }
        });

        document.getElementById('createTicketForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            const messageContainer = document.getElementById('messageContainer');
            const formData = new FormData(form);

            messageContainer.innerHTML = '';
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creando ticket...';

            try {
                const response = await fetch('/tickets/createTicket', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok && result.status === 201) {
                    showMessage('success', result.message || 'Ticket creado exitosamente');
                    form.reset();
                } else {
                    showMessage('error', result.message || 'Error al crear el ticket');
                }
            } catch (error) {
                showMessage('error', 'Error de conexión. Intenta nuevamente.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Crear Ticket';
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
        }
    </script>
</body>
</html>