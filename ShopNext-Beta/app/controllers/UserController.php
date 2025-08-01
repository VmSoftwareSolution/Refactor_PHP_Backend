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
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        try {
            $this->service->register($email, $password);
            echo "Usuario creado exitosamente.";
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

    public function getUserById($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $user = $this->service->getById($id);
            require_once __DIR__ . '/../views/user/show.php';
        });
    }

    

}