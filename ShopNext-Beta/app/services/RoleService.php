<?php

require_once __DIR__ . '/../repositories/RoleRepository.php';
require_once __DIR__ . '/../models/Role.php';
require_once __DIR__ . '/../utils/ValidationUtils.php';

$messages = require __DIR__ . '/../utils/Message.php';

class RoleService {
    private $repository;

    public function __construct() {
        $this->repository = new RoleRepository();
    }

    public function create(string $name, string $description): void {
        global $messages;

        IsNotEmpty($name, 'nombre');

        $existing = $this->repository->findByName($name);
        
        if ($existing !== null) {
            throw new AlreadyExistsException(
                str_replace(
                    ':entity', 'Rol', 
                    $messages['entity_already_exists']
            ));
        }

        $role = new Role($name, $description);
        $success = $this->repository->create($role);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }


    public function getById(int $id): Role {
        global $messages;

        ValidateId($id);

        $role = $this->repository->findById($id);

        if (!$role) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }

        return $role;
    }

    public function getByName(string $name): Role {
        global $messages;

        $role = $this->repository->findByName($name);

        if (!$role) {
            throw new NotFoundException( 
                str_replace(
                    ':value', 'Role con nombre ' . $name, 
                    $messages['not_found']));
        }

        return $role;
    }

    public function deleteById(int $id): void {
        
        global $messages;

        ValidateId($id);

        $role = $this->repository->findById($id);
        if (!$role) {
            throw new NotFoundException( 
                str_replace(
                    ':value', 'Role con ID ' . $id, 
                    $messages['not_found']));
        }

        $success = $this->repository->deleteById($id);
        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function update(int $id, string $name, string $description): void {

        global $messages;

        IsNotEmpty($name, 'nombre');
        ValidateId($id);
 
        $role = $this->repository->findById($id);
        
        if (!$role) {
            throw new NotFoundException(
                str_replace(
                    ':value', 'Role con nombre ' . $name, 
                    $messages['not_found']));
        }

        $updatedRole = new Role($name, $description, $id);
        $success = $this->repository->update($updatedRole);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        global $messages;

        ValidateParamPagination($offset, $limit);

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
