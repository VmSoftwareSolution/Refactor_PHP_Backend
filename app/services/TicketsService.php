<?php

require_once __DIR__ . '/../repositories/TicketsRepository.php';
require_once __DIR__ . '/../models/Tickets.php';
require_once __DIR__ . '/../utils/ValidationUtils.php';

$messages = require __DIR__ . '/../utils/Message.php';

class TicketsService {

    private TicketsRepository $repository;

    private array $validPriorities = ['low', 'medium', 'high'];
    private array $validStatuses   = ['open', 'in_progress', 'closed'];

    public function __construct() {
        $this->repository = new TicketsRepository();
    }

    public function create(string $tittle, string $message, int $id_person): void {
        global $messages;

        ValidateTittle($tittle, "Titulo");
        ValidateMessage($message);

        $priority = 'high';
        $status = 'open';

        $createdAt = date('Y-m-d H:i:s');

        $ticket = new Tickets($tittle, $message, $priority, $status, $id_person, $createdAt);
        $success = $this->repository->create($ticket);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }

    public function getAll(int $limit = 100, int $offset = 0): array {
        ValidateParamPagination($offset, $limit);

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
        global $messages;

        ValidateId($id);

        $ticket = $this->repository->findById($id);

        if (!$ticket) {
           throw new NotFoundException(
                str_replace(
                    ':value', 'Ticket con ID ' . $id, 
                    $messages['not_found']));;
        }

        return $ticket;
    }

    public function update(
        int $id,  
        string $tittle, 
        string $message, 
        string $priority, 
        string $status, 
        int $id_person, 
        string $created_at
    ): void {
        global $messages;
        
        $priority = strtolower(trim($priority));
        $status   = strtolower(trim($status));

       if (!in_array($priority, $this->validPriorities, true)) {
            throw new InvalidDataException($messages['invalid_data'] . implode(', ', $this->validPriorities));
        }

        if (!in_array($status, $this->validStatuses, true)) {
            throw new InvalidDataException($messages['invalid_data']  . implode(', ', $this->validStatuses));
        }

        $ticket = new Tickets($tittle, $message, $priority, $status, $id_person, $created_at, $id);
        $success = $this->repository->update($ticket);

        if (!$success) {
            throw new UnexcpectedErrorException($messages['unexpected_error']);
        }
    }
}