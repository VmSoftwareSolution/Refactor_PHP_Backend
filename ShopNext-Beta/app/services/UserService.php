<?php

require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';

class UserService {
    private UserRepository $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }
    

    public function register(string $email, string $password): void {
        
        if (trim($email) === '' || trim($password) === '') {
            throw new InvalidArgumentException("Email y contraseña son requeridos.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Formato de email inválido.");
        }

        $existing = $this->repository->existsByEmail($email);
        if ($existing !== null) {
            throw new InvalidArgumentException("El email ya está registrado.");
        }

        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';
        if (!preg_match($regex, $password)) {
            throw new InvalidArgumentException(
                "La contraseña debe tener al menos 6 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial."
            );
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $roleId = $this->repository->getDefaultRoleId();

        if (!$roleId) {
            throw new RuntimeException("Rol por defecto 'cliente' no encontrado.");
        }

        $user = new User($email, $hashedPassword, $roleId);

        $success = $this->repository->create($user);

        if (!$success) {
            throw new RuntimeException("Error al registrar el usuario.");
        }
    }
}