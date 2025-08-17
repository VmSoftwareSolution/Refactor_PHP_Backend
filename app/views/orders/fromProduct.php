<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Orden Desde Producto</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        h1 {
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: #333;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 0.3rem;
            font-weight: 600;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 0.7rem;
            margin-bottom: 1.2rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            appearance: none; /* quita estilos por defecto */
            background-color: #fff;
            background-image: url("data:image/svg+xml;utf8,<svg fill='%23666' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
            background-size: 1.2rem;
            cursor: pointer;
        }

        select:focus, input:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.4);
        }

        button {
            background: #6a11cb;
            color: #fff;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        button:hover {
            background: #2575fc;
        }

        .message {
            margin-bottom: 1rem;
            padding: 0.8rem;
            border-radius: 8px;
            font-size: 0.95rem;
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
    <?php include __DIR__ . '/../layouts/sideBar.php'; ?>
    <div class="container">
        <h1>Crear Orden Desde Producto</h1>

        <div id="message" class="message"></div>

        <form id="orderForm">
            <label for="id_person">Selecciona Persona:</label>
            <select id="id_person" name="id_person" required>
                <?php foreach ($persons as $person): ?>
                    <option value="<?= htmlspecialchars($person->id) ?>">
                        <?= htmlspecialchars($person->full_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="id_product">Selecciona Producto:</label>
            <select id="id_product" name="id_product" required>
                <?php foreach ($products as $product): ?>
                    <option value="<?= htmlspecialchars($product->id) ?>">
                        <?= htmlspecialchars($product->name) ?> - $<?= htmlspecialchars($product->price) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Crear Orden</button>
        </form>
    </div>

    <script>
        document.getElementById("orderForm").addEventListener("submit", async function(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            try {
                const response = await fetch("/orders/OrderFromProduct", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();
                const messageDiv = document.getElementById("message");

                if (response.ok && result.message) {
                    messageDiv.textContent = result.message;
                    messageDiv.className = "message success";
                    messageDiv.style.display = "block";
                    form.reset();
                } else {
                    messageDiv.textContent = result.error || "Error al crear la orden.";
                    messageDiv.className = "message error";
                    messageDiv.style.display = "block";
                }
            } catch (err) {
                const messageDiv = document.getElementById("message");
                messageDiv.textContent = "Error en la conexión con el servidor.";
                messageDiv.className = "message error";
                messageDiv.style.display = "block";
            }
        });
    </script>
</body>
</html>
