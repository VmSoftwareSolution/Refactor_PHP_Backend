<?php

require_once __DIR__ . '/../Error/ErrorHandler.php';
require_once __DIR__ . '/../services/ShipmentService.php';
require_once __DIR__ . '/../utils/JsonResponder.php'; 

$messages = require __DIR__ . '/../utils/Message.php';

class ShipmentController {

private ShipmentService $service;

    function __construct(){
        $this->service = new ShipmentService();
    }

    public function create() {
        require_once __DIR__ . '/../views/shipments/create.php';
    }

    public function createShipment(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data, $messages) {
            
            $id_order = isset($data['id_order']) ? (int)$data['id_order'] : -1;
            $address = $data['address'] ?? '';
        
            $this->service->create($id_order, $address);

            JsonResponder::success([
                'status' => 201,
                'message' => $messages['created_successfully'],
            ]);
        });
    }

    public function getShipmentById($data) {
        ErrorHandler::handle(function () use ($data) {
            $id = (int)($data['id'] ?? 0);
            $shipment = $this->service->getShipment($id);

            require __DIR__ . '/../views/shipments/show.php';
        });
    }

    public function updateStatus(array $data): void {
        global $messages;

        ErrorHandler::handle(function () use ($data,$messages) {
            $id = isset($data['id']) ? (int)$data['id'] : 0;
            $status = isset($data['status']) ? (string)$data['status'] : 0;


            $result = $this->service->changeShipmentStatus($id, $status);

            JsonResponder::success([
                'status' => 200,
                'message' => $messages['updated_successfully'],
                'envio' => $result
            ]);
        });
    }

    public function listShipments() {
    ErrorHandler::handle(function () {
        $shipments = $this->service->getAllShipments();
        require __DIR__ . '/../views/shipments/list.php';
    });
}

}
