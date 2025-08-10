<?php

require_once __DIR__ . '/../services/RoleService.php'; 
require_once __DIR__ . '/../utils/JsonResponder.php';
require_once __DIR__ . '/../Error/ErrorHandler.php';

$messages = require __DIR__ . '/../utils/Message.php';

class RoleController {
    private $service;

    public function __construct() {
        $this->service = new RoleService();
    }

    public function create() {
        require_once __DIR__ . '/../views/roles/create.php';
    }

    public function createRole($data) {
        global $messages;

        ErrorHandler::handle(function () use ($data,$messages) {
            $this->service->create(
                $data['name'] ?? '', 
                $data['description'] ?? '');
            
            JsonResponder::success([
                'status' => 201,
                'message' => $messages['created_successfully'],
            ]);
        });
    }


    public function getRoleById($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);

            $role = $this->service->getById($id);
            require_once __DIR__ . '/../views/roles/show.php';
        });
    }

    public function deleteRole($data) {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $id = (int) ($data['id'] ?? 0);

            $this->service->deleteById($id);
            JsonResponder::success([
                'status' => 200,
                'message' => $messages['deleted_successfully'],
            ]);
        });
    
    }

    public function editRole($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            
            $role = $this->service->getById($id);
            require_once __DIR__ . '/../views/roles/edit.php';
        });
    }

    public function updateRole($data) {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $id = (int) ($data['id'] ?? 0);
            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';

            $this->service->update($id, $name, $description);
            JsonResponder::success([
                'status' => 200,
                'message' => $messages['updated_successfully'],
            ]);
        });
    }

    public function listRoles(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $limit = isset($data['limit']) ? (int)$data['limit'] : 100;
            $offset = isset($data['offset']) ? (int)$data['offset'] : 0;

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
        });
    }


}
