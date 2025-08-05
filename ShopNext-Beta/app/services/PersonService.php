<?php

require_once __DIR__ . '/../repositories/PersonRepository.php';
require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/Person.php';

class PersonService {
    private PersonRepository $repository;
    private UserRepository $userRepository;

    public function __construct() {
        $this->repository = new PersonRepository();
        $this->userRepository = new UserRepository();
    }

    public function getById(int $id): Person {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido.");
        }
        $person = $this->repository->findById($id);
        if (!$person) {
            throw new InvalidArgumentException("Persona no encontrada.");
        }
        return $person;
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        if ($limit <= 0 || $offset < 0) {
            throw new InvalidArgumentException("Parámetros de paginación inválidos.");
        }
        $persons = $this->repository->findAll($limit, $offset);
        $total = $this->repository->countAll();
        return [
            'data' => $persons,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }

    public function create(array $data): void {
        if (empty($data['full_name']) || empty($data['id_user'])) {
            throw new InvalidArgumentException("full_name e id_user son requeridos.");
        }

        $id_user = (int)$data['id_user'];
        if (!$this->userRepository->findById($id_user)) {
            throw new InvalidArgumentException("Usuario con id {$id_user} no existe.");
        }

        $person = new Person(
            $data['full_name'],
            $id_user,
            $data['phone'] ?? null,
            $data['gender'] ?? null,
            $data['date_of_birth'] ?? null,
            $data['avatar'] ?? null
        );
        $success = $this->repository->create($person);
        if (!$success) {
            throw new RuntimeException("No se pudo crear la persona.");
        }
    }

    public function update(int $id, array $data): void {
        $existing = $this->repository->findById($id);
        if (!$existing) {
            throw new InvalidArgumentException("Persona no encontrada.");
        }
        $full_name = $data['full_name'] ?? $existing->full_name;
        $id_user = isset($data['id_user']) ? (int)$data['id_user'] : $existing->id_user;
        $phone = $data['phone'] ?? $existing->phone;
        $gender = $data['gender'] ?? $existing->gender;
        $date_of_birth = $data['date_of_birth'] ?? $existing->date_of_birth;
        $avatar = $data['avatar'] ?? $existing->avatar;

        $person = new Person(
            $full_name,
            $id_user,
            $phone,
            $gender,
            $date_of_birth,
            $avatar,
            $id,
            $existing->create_at
        );
        $success = $this->repository->update($person);
        if (!$success) {
            throw new RuntimeException("No se pudo actualizar la persona.");
        }
    }

    public function deleteById(int $id): void {
        $existing = $this->repository->findById($id);
        if (!$existing) {
            throw new InvalidArgumentException("Persona no encontrada.");
        }
        $success = $this->repository->deleteById($id);
        if (!$success) {
            throw new RuntimeException("No se pudo eliminar la persona.");
        }
    }
}
