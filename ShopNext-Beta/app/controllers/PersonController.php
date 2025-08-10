<?php

require_once __DIR__ . '/../services/PersonService.php';

class PersonController {
    private PersonService $service;

    public function __construct() {
        $this->service = new PersonService();
    }

    public function listPersons(array $data): void {
        $limit = isset($data['limit']) ? (int)$data['limit'] : 100;
        $offset = isset($data['offset']) ? (int)$data['offset'] : 0;
        try {
            $result = $this->service->getAll($limit, $offset);
            $persons = $result['data'];
            require_once __DIR__ . '/../views/persons/index.php';
        } catch (Throwable $e) {
            http_response_code(500);
            echo "Error cargando personas.";
        }
    }

    public function getPersonById(array $data): void {
        $id = isset($data['id']) ? (int)$data['id'] : 0;
        try {
            $person = $this->service->getById($id);
            require_once __DIR__ . '/../views/persons/show.php';
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo $e->getMessage();
        } catch (Throwable $e) {
            http_response_code(500);
            echo "Error interno.";
        }
    }

    public function createPersonForm(): void {
        require_once __DIR__ . '/../views/persons/create.php';
    }

    public function createPerson(array $data): void {
        try {
            $this->service->create($data);
            header('Location: /persons');
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();
            require_once __DIR__ . '/../views/persons/create.php';
        }
    }

    public function editPersonForm(array $data): void {
        $id = isset($data['id']) ? (int)$data['id'] : 0;
        try {
            $person = $this->service->getById($id);
            require_once __DIR__ . '/../views/persons/edit.php';
        } catch (Exception $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function updatePerson(array $data): void {
        $id = isset($data['id']) ? (int)$data['id'] : 0;
        try {
            $this->service->update($id, $data);
            header('Location: /persons/findById?id=' . $id);
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();
            $person = $this->service->getById($id);
            require_once __DIR__ . '/../views/persons/edit.php';
        }
    }

    public function deletePerson(array $data): void {
        $id = isset($data['id']) ? (int)$data['id'] : 0;
        try {
            $this->service->deleteById($id);
            header('Location: /persons');
            exit;
        } catch (Exception $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }
}
