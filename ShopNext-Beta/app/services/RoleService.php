<?php

require_once __DIR__ . '/../repositories/RoleRepository.php';
require_once __DIR__ . '/../models/Role.php';

class RoleService {
    private $repository;

    public function __construct() {
        $this->repository = new RoleRepository();
    }

    public function create(string $name, string $description): string {
        if (!isset($name) || trim($name) === '') {
            return "El nombre es requerido, no puede ir vacio.";
        }

        $existing = $this->repository->findByName($name);
        if ($existing !== null) {
            return "Ya existe un rol con ese nombre.";
        }

        $role = new Role($name, $description);
        $success = $this->repository->create($role);

        return $success ? "Rol creado exitosamente." : "Error al crear el rol.";
    }

    public function getById(int $id): Role {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $role = $this->repository->findById($id);

        if (!$role) {
            throw new RuntimeException("Rol no encontrado.");
        }

        return $role;
    }


}
