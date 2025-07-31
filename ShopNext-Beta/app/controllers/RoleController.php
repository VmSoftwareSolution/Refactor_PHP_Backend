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

        try {
            $this->service->create($name, $description);
            echo "Rol creado exitosamente.";
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo $e->getMessage();
        } catch (RuntimeException $e) {
            http_response_code(409);
            echo $e->getMessage();
        } catch (Throwable $e) {
            http_response_code(500);
            echo "Error interno del servidor.";
        }
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

    public function deleteRole($data) {
        $id = (int) ($data['id'] ?? 0);

        try {
            $this->service->deleteById($id);
            echo "Rol eliminado exitosamente.";
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo $e->getMessage();
        } catch (RuntimeException $e) {
            http_response_code(409);
            echo $e->getMessage();
        } catch (Throwable $e) {
            http_response_code(500);
            echo "Error interno del servidor.";
        }
    }



}
