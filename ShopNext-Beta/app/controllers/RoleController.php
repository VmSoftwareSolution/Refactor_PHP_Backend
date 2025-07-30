<?php

require_once __DIR__ . '/../services/RoleService.php'; 

class RoleController {
    private $service;

    public function __construct() {
        $this->service = new RoleService();
    }

    public function create() {
        require_once __DIR__ . '/../views/roles/create.php';
    }

    public function createRole($data) {
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';

        $message = $this->service->create($name, $description);
        echo $message;
    }
}
