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

    public function getByName(string $name): Role {

        $role = $this->repository->findByName($name);

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

    public function update(int $id, string $name, string $description): void {
        if ($id <= 0 || trim($name) === '') {
            throw new InvalidArgumentException("Datos inválidos para actualizar.");
        }

        $role = $this->repository->findById($id);
        
        if (!$role) {
            throw new InvalidArgumentException("Rol no encontrado.");
        }

        $updatedRole = new Role($name, $description, $id);
        $success = $this->repository->update($updatedRole);

        if (!$success) {
            throw new RuntimeException("No se pudo actualizar el rol.");
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        if ($limit <= 0 || $offset < 0) {
            throw new InvalidArgumentException("Parámetros de paginación inválidos.");
        }

        $roles = $this->repository->findAll($limit, $offset);
        $total = $this->repository->countAll();

        return [
            'data' => $roles,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }

}
