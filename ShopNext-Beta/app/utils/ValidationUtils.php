<?php

function validateEmail(string $email): void {
    if (trim($email) === '') {
        throw new InvalidArgumentException("El email es requerido.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidArgumentException("Formato de email inválido.");
    }
}

function validatePassword(string $password): void {
    if (trim($password) === '') {
        throw new InvalidArgumentException("La contraseña es requerida.");
    }

    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';

    if (!preg_match($regex, $password)) {
        throw new InvalidArgumentException(
            "La contraseña debe tener al menos 6 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial."
        );
    }
}