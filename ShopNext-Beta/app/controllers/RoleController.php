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

    public function getRoleById($data) {
        $id = (int) ($data['id'] ?? 0);

        try {
            $role = $this->service->getById($id);
            require_once __DIR__ . '/../views/roles/show.php';

        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }



}
