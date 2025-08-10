<?php

require_once __DIR__ . '/../repositories/TicketsRepository.php';
require_once __DIR__ . '/../models/Tickets.php';

class TicketsService {

    private TicketsRepository $repository;

    private array $validPriorities = ['low', 'medium', 'high'];
    private array $validStatuses   = ['open', 'in_progress', 'closed'];

    public function __construct() {
        $this->repository = new TicketsRepository();
    }

    public function create(string $tittle, string $message, int $id_person): void {

         if ($tittle === '' || strlen($tittle) > 50) {
            throw new InvalidArgumentException("El campo 'tittle' es requerido y máximo 50 caracteres.");
        }

        if ($message === '' || strlen($message) > 200) {
            throw new InvalidArgumentException("El campo 'message' es requerido y máximo 200 caracteres.");
        }
        
        $priority = 'high';
        $status = 'open';

        $createdAt = date('Y-m-d H:i:s');

        $ticket = new Tickets($tittle, $message, $priority, $status, $id_person, $createdAt);
        $success = $this->repository->create($ticket);

        if (!$success) {
            throw new RuntimeException("Error al crear el ticket.");
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        if ($limit <= 0 || $offset < 0) {
            throw new InvalidArgumentException("Parámetros de paginación inválidos.");
        }

        $products = $this->repository->findAll($limit, $offset);
        $total = $this->repository->countAll();

        return [
            'data' => $products,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }

    public function getById(int $id): Tickets {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID inválido. Debe ser mayor que cero.");
        }

        $ticket = $this->repository->findById($id);

        if (!$ticket) {
            throw new InvalidArgumentException("producto no encontrado.");
        }

        return $ticket;
    }

    public function update(int $id,  string $tittle, string $message, string $priority, string $status, int $id_person, string $created_at): void {
        
        $priority = strtolower(trim($priority));
        $status   = strtolower(trim($status));

       if (!in_array($priority, $this->validPriorities, true)) {
            throw new InvalidArgumentException("Valor inválido para 'priority'. Valores permitidos: " . implode(', ', $this->validPriorities));
        }

        if (!in_array($status, $this->validStatuses, true)) {
            throw new InvalidArgumentException("Valor inválido para 'status'. Valores permitidos: " . implode(', ', $this->validStatuses));
        }

        $ticket = new Tickets($tittle, $message, $priority, $status, $id_person, $created_at, $id);
        $success = $this->repository->update($ticket);

        if (!$success) {
            throw new RuntimeException("Error al actualizar el Ticket.");
        }
    }
}