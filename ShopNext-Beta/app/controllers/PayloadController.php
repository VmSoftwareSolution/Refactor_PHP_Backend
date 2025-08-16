<?php

require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../services/PayloadService.php';
require_once __DIR__ . '/../utils/JsonResponder.php'; 

$messages = require __DIR__ . '/../utils/Message.php';

class PayloadController {

    private PayloadService $service;

    function __construct(){
        $this->service = new PayloadService();
    }

    public function create() {
        require_once __DIR__ . '/../views/payloads/create.php';
    }

    public function createPayload(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            $id_order = isset($data['id_order']) ? (int)$data['id_order'] : -1;
            $method = isset($data['method']) ? trim($data['method']) : '';
            
        
            $this->service->create($id_order, $method);

            JsonResponder::success([
                'status' => 201,
                'message' => $messages['created_successfully'],
            ]);
        });
    }

    public function getPayloadById($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int)($data['id'] ?? 0);
            $payload = $this->service->getPayload($id);

            require __DIR__ . '/../views/payloads/show.php';
        });
    }

    public function updateStatus(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data,$messages) {
            $id = isset($data['id']) ? (int)$data['id'] : 0;
            $status = isset($data['status']) ? (string)$data['status'] : 0;


            $result = $this->service->changePayloadStatus($id, $status);

            JsonResponder::success([
                'message' => $messages['updated_successfully'],
                'order' => $result
            ]);
        });
    }
}