<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ver Persona</title>
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
.label {
    font-weight: bold;
    margin-top: 1rem;
    color: #555;
}
.value {
    margin-bottom: 1rem;
    font-size: 1.1em;
    color: #333;
    padding: 8px;
    background: #f4f4f4;
    border-radius: 8px;
}
.actions {
    margin-top: 20px;
    text-align: center;
}
.btn-edit {
    background-color: #2575fc;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    font-size: 1rem;
    margin-right: 10px;
}
.btn-edit:hover {
    background-color: #1a5edb;
}
.btn-back {
    background-color: #aaa;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-size: 1rem;
}
.btn-back:hover {
    background-color: #888;
}
</style>
</head>
<body>
<div class="container">
    <h2>Persona #<?= htmlspecialchars($person->id) ?></h2>

    <div>
        <div class="label">Nombre completo:</div>
        <div class="value"><?= htmlspecialchars($person->full_name) ?></div>
    </div>

    <div>
        <div class="label">Teléfono:</div>
        <div class="value"><?= htmlspecialchars($person->phone) ?></div>
    </div>

    <div>
        <div class="label">Género:</div>
        <div class="value"><?= htmlspecialchars($person->gender) ?></div>
    </div>

    <div>
        <div class="label">Fecha de nacimiento:</div>
        <div class="value"><?= htmlspecialchars($person->date_of_birth) ?></div>
    </div>

    <div>
        <div class="label">Avatar:</div>
        <div class="value"><?= htmlspecialchars($person->avatar) ?></div>
    </div>

    <div>
        <div class="label">Usuario asociado:</div>
        <div class="value"><?= htmlspecialchars($person->id_user) ?></div>
    </div>

    <div>
        <div class="label">Creado en:</div>
        <div class="value"><?= htmlspecialchars($person->create_at) ?></div>
    </div>

    <div class="actions">
        <a href="/persons/edit?id=<?= htmlspecialchars($person->id) ?>" class="btn-edit">Editar</a>
        <a href="/persons" class="btn-back">Volver al listado</a>
    </div>
</div>
<script src="/js/sessionCheck.js"></script>
</body>
</html>
