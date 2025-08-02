<?php

require_once __DIR__ . '/../services/RoleService.php'; 
require_once __DIR__ . '/../utils/JsonResponder.php';

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

    public function editRole($data) {
        $id = (int) ($data['id'] ?? 0);
        try {
            $role = $this->service->getById($id);
            require_once __DIR__ . '/../views/roles/edit.php';
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function updateRole($data) {
        $id = (int) ($data['id'] ?? 0);
        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';

        try {
            $this->service->update($id, $name, $description);
            echo "Rol actualizado exitosamente.";
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

   public function listRoles(array $data): void {
        $limit = isset($data['limit']) ? (int)$data['limit'] : 100;
        $offset = isset($data['offset']) ? (int)$data['offset'] : 0;

        try {
            $result = $this->service->getAll($limit, $offset);
            $payload = array_map(function($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'description' => $role->description,
                ];
            }, $result['data']);

            JsonResponder::success([
                'data' => $payload,
                'total' => $result['total'],
                'limit' => $result['limit'],
                'offset' => $result['offset'],
                'count' => count($payload),
            ]);
        } catch (InvalidArgumentException $e) {
            JsonResponder::error($e->getMessage(), 400);
        } catch (Throwable $e) {
            JsonResponder::error('Error interno del servidor.', 500);
        }
    }


}
