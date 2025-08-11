<?php

require_once __DIR__ . '/../services/PersonService.php';
require_once __DIR__ . '/../Error/ErrorHandler.php';

class PersonController {
    private PersonService $service;

    public function __construct() {
        $this->service = new PersonService();
    }

    public function listPersons(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $limit = isset($data['limit']) ? (int)$data['limit'] : 100;
            $offset = isset($data['offset']) ? (int)$data['offset'] : 0;
                
            $result = $this->service->getAll($limit, $offset);
            $persons = $result['data'];
            require_once __DIR__ . '/../views/persons/index.php';
        });
    }

    public function getPersonById(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id = isset($data['id']) ? (int)$data['id'] : 0;
            
            $person = $this->service->getById($id);
            require_once __DIR__ . '/../views/persons/show.php';
        });
    }

    public function createPersonForm(): void {
        require_once __DIR__ . '/../views/persons/create.php';
    }

    public function createPerson(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $this->service->create($data);
            header('Location: /persons');
            exit;
        });
    }

    public function editPersonForm(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id = isset($data['id']) ? (int)$data['id'] : 0;
            
            $person = $this->service->getById($id);
            require_once __DIR__ . '/../views/persons/edit.php';
        });
    }

    public function updatePerson(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id = isset($data['id']) ? (int)$data['id'] : 0;
            
            $this->service->update($id, $data);
            header('Location: /persons/findById?id=' . $id);
            exit;
        });
    }

    public function deletePerson(array $data): void {
        ErrorHandler::handle(function () use ($data) {
            $id = isset($data['id']) ? (int)$data['id'] : 0;
            
            $this->service->deleteById($id);
            header('Location: /persons');
            exit;
        });
    }
    
}
