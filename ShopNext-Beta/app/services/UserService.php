<?php

require_once __DIR__ . '/../utils/ValidationUtils.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../repositories/RoleRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';

class UserService {

    private UserRepository $repository;
    private RoleRepository $roleRepository;

    public function __construct() {
        $this->repository = new UserRepository();
        $this->roleRepository = new RoleRepository();
    }

    public function register(string $email, string $password): void {
        
        validateEmail($email);
        validatePassword($password);

        $existing = $this->repository->existsByEmail($email);
        if ($existing) {
            throw new InvalidArgumentException("El email ya está registrado.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $defaultRole = $this->roleRepository->findByName('cliente');
        if (!$defaultRole) {
            throw new RuntimeException("Rol por defecto 'cliente' no encontrado.");
        }

        $rolde_id = $defaultRole->id;
        $user = new User($email, $hashedPassword, $rolde_id);

        $success = $this->repository->create($user);

        if (!$success) {
            throw new RuntimeException("Error al registrar el usuario.");
        }
    }

    public function getById(int $id): User {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $user = $this->repository->findById($id);

        if (!$user) {
            throw new InvalidArgumentException("Rol no encontrado.");
        }

        return $user;
    }

    public function update(int $id, string $email, string $password, int $roleId): void {
        
        validateEmail($email);
        validatePassword($password);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$this->roleRepository->findById($roleId)) {
            throw new InvalidArgumentException("El rol indicado no existe.");
        }

        $user = new User($email, $hashedPassword, $roleId ,$id);

        $success = $this->repository->update($user);

        if (!$success) {
            throw new RuntimeException("Error al actualizar el usuario.");
        }
    }

    public function deleteById(int $id): void {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $user = $this->repository->findById($id);
        if (!$user) {
            throw new InvalidArgumentException("User no encontrado.");
        }

        $success = $this->repository->deleteById($id);
        if (!$success) {
            throw new RuntimeException("No se pudo eliminar el User.");
        }
    }
}