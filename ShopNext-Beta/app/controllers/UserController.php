<?php

require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../services/UserService.php'; 
require_once __DIR__ . '/../utils/JsonResponder.php';

$messages = require __DIR__ . '/../utils/Message.php';

class UserController {
    
    private $service;

    public function __construct() {
        $this->service = new UserService();
    }

    public function create() {
        require_once __DIR__ . '/../views/user/create.php';
    }

    public function createUser($data) {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';
            $this->service->register($email, $password);

            JsonResponder::success([
                'status' => 201,
                'message' => $messages['created_successfully'],
            ]);
        });
    }

    public function getUserById($data) {

        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $user = $this->service->getById($id);
            require_once __DIR__ . '/../views/user/show.php';
        });

    }

    public function editUser($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $user = $this->service->getById($id);

            require_once __DIR__ . '/../services/RoleService.php';
            $roleService = new RoleService();
            $rolesResult = $roleService->getAll();
            $roles = $rolesResult['data'];

            require_once __DIR__ . '/../views/user/edit.php';
        });
    }


    public function updateUser($data) {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $id = (int) ($data['id'] ?? 0);
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';
            $role_id = (int) ($data['role_id'] ?? 0);

            $this->service->update($id, $email, $password, $role_id);
            JsonResponder::success([
                'status' => 200,
                'message' => $messages['updated_successfully'],
            ]);
        });
    }

    public function deleteUser($data) {
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
    
    public function listUsers(array $data): void{

    ErrorHandler::handle(function () use ($data) {
        $limit = isset($data['limit']) ? (int) $data['limit'] : 100;
        $offset = isset($data['offset']) ? (int) $data['offset'] : 0;

        $result = $this->service->getAll($limit, $offset);

        $payload = array_map(function ($user) {
            return [
                'id' => $user->id,
                'email' => $user->email,
                'role_id' => $user->role_id,
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

    public function changePasswordUser($data) {

         ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $user = $this->service->getById($id);
            require_once __DIR__ . '/../views/user/editUser.php';
        });

    }

    public function changePassword($data){
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $id = (int) ($data['id'] ?? 0);
            $password = $data['password'] ?? '';
            $this->service->changePassword($id, $password);
            
            JsonResponder::success([
                'status' => 200,
                'message' => $messages['update_password_success'],
            ]);
        });
    }

    public function usersView() {
        ErrorHandler::handle(function () {
            require_once __DIR__ . '/../views/user/list.php';
        });
    }



}