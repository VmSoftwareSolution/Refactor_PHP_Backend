<?php
require_once __DIR__ . '/../Error/CustomException.php';

    function validateEmail(string $email): void {
        if (trim($email) === '') {
            throw new EmailRequiredException("El email es requerido.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailFormatException("Formato de email inválido.");
        }
    }

    function validatePassword(string $password): void {
        if (trim($password) === '') {
            throw new PasswordRequiredException("La contraseña es requerida.");
        }

        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';

        if (!preg_match($regex, $password)) {
            throw new WeakPasswordException(
                "La contraseña debe tener al menos 6 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial."
            );
        }
    }

    function IsNotEmpty(string $value, string $field): void {
        if (trim($value) === '') {
            throw new EmptyFieldException("El campo '$field' no puede estar vacío.");
        }
    }

    function IsNotNegativeNumber(int $value, string $field): void {
        if ($value < 0) {
            throw new NegativeValueException("El campo '$field' no puede ser negativo.");
        }
    }