<?php

require_once __DIR__ . '/../repositories/RoleRepository.php';
require_once __DIR__ . '/../models/Role.php';

class RoleService {
    private $repository;

    public function __construct() {
        $this->repository = new RoleRepository();
    }

    public function create(string $name, string $description): void {
        if (!isset($name) || trim($name) === '') {
            throw new InvalidArgumentException("El nombre es requerido, no puede ir vacío.");
        }

        $existing = $this->repository->findByName($name);
        if ($existing !== null) {
            throw new DomainException("Ya existe un rol con ese nombre.");
        }

        $role = new Role($name, $description);
        $success = $this->repository->create($role);

        if (!$success) {
            throw new RuntimeException("Error al crear el rol.");
        }
    }


    public function getById(int $id): Role {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $role = $this->repository->findById($id);

        if (!$role) {
            throw new InvalidArgumentException("Rol no encontrado.");
        }

        return $role;
    }

    public function deleteById(int $id): void {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $role = $this->repository->findById($id);
        if (!$role) {
            throw new InvalidArgumentException("Rol no encontrado.");
        }

        $success = $this->repository->deleteById($id);
        if (!$success) {
            throw new RuntimeException("No se pudo eliminar el rol.");
        }
    }

}
