<?php

require_once __DIR__ . '/../utils/ErrorHandler.php';
require_once __DIR__ . '/../services/UserService.php'; 

class UserController {
    
    private $service;

    public function __construct() {
        $this->service = new UserService();
    }

    public function create() {
        require_once __DIR__ . '/../views/user/create.php';
    }

    public function createUser($data) {
       
         ErrorHandler::handle(function () use ($data) {
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';
            $this->service->register($email, $password);
            echo "Usuario creado exitosamente.";
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
            require_once __DIR__ . '/../views/user/edit.php';
        });

    }

    public function updateUser($data) {

        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';
            $role_id = (int) ($data['role_id'] ?? 0);

            $this->service->update($id, $email, $password, $role_id);
            echo "User actualizado exitosamente.";
        });
    }

    public function deleteUser($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $this->service->deleteById($id);
            echo "User eliminado exitosamente.";
        });
    }
}