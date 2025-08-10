<?php

require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../services/TicketsService.php';
require_once __DIR__ . '/../utils/JsonResponder.php'; 

$messages = require __DIR__ . '/../utils/Message.php';

class TicketsController {

    private TicketsService $service;

    function __construct(){
        $this->service = new TicketsService();
    }

    public function create() {
        require_once __DIR__ . '/../views/tickets/create.php';
    }

    public function createTicket(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $tittle = $data['tittle'] ?? '';
            $message = $data['message'] ?? '';
            $id_person = isset($data['id_person']) ? (int)$data['id_person'] : -1;
        
            $this->service->create($tittle, $message, $id_person);

            JsonResponder::success([
                'status' => 201,
                'message' => $messages['created_successfully'],
            ]);
        });
    }

    public function listTickets(array $data): void{

    ErrorHandler::handle(function () use ($data) {
        $limit = isset($data['limit']) ? (int) $data['limit'] : 100;
        $offset = isset($data['offset']) ? (int) $data['offset'] : 0;

        $result = $this->service->getAll($limit, $offset);

        $payload = array_map(function ($tickets) {
            return [
                'id' => $tickets->id,
                'tittle: ' => $tickets->tittle,
                'message:' => $tickets->message,
                'priority:' => $tickets->priority,
                'status:' => $tickets->status,
                'id_person:' => $tickets->id_person,
                'created_at' => $tickets->created_at
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

    public function getTicketById($data) {

        ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $ticket = $this->service->getById($id);
            require_once __DIR__ . '/../views/tickets/show.php';
        });

    }

    public function editTicket($data) {

         ErrorHandler::handle(function () use ($data) {
            $id = (int) ($data['id'] ?? 0);
            $ticket = $this->service->getById($id);
            require_once __DIR__ . '/../views/tickets/edit.php';
        });

    }

    public function updateTicket($data) {
        global $messages;

        ErrorHandler::handle(function () use ($data,$messages) {
        $id = (int) ($data['id'] ?? 0);
        $tittle = $data['tittle'] ?? '';
        $message = $data['message'] ?? '';
        $priority = $data['priority'] ?? '';
        $status = $data['status'] ?? '';
        $id_person = isset($data['id_person']) ? (int)$data['id_person'] : -1;
        $created_at = $data['created_at'] ?? null;

        $this->service->update($id, $tittle, $message, $priority, $status, $id_person, $created_at);
           JsonResponder::success([
                'status' => 200,
                'message' => $messages['updated_successfully'],
            ]);
        });
    }
}