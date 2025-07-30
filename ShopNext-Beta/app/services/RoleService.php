<?php

require_once __DIR__ . '/../repositories/RoleRepository.php';

class RoleService {
    private $repository;

    public function __construct() {
        $this->repository = new RoleRepository();
    }

    public function create($name, $description) {
        $role = new Role($name, $description);
        //FIX: adding logic
        return $this->repository->create($role);
    }
}
