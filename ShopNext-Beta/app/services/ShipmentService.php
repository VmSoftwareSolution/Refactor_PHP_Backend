<?php

require_once __DIR__ . '/../repositories/ShipmentRepository.php';
require_once __DIR__ . '/../models/Shipment.php';

$messages = require __DIR__ . '/../utils/Message.php';

class ShipmentService {
    private ShipmentRepository $repository;

    private array $validStatus = [
    'pending',
    'shipped',
    'delivered',];

    public function __construct() {
        $this->repository = new ShipmentRepository();
    }

    public function create(int $id_order, string $address): array {
        if (empty($id_order) || empty($address)) {
            throw new InvalidParameterException("El id_order y address son obligatorios.");
        }

        $status = 'pending';

        $shipment = new Shipment(
            id: null,
            id_order: $id_order,
            address: $address,
            status: $status,
            created_at: date('Y-m-d H:i:s')
        );

        $success = $this->repository->create($shipment);

        if (!$success) {
           throw new UnexcpectedErrorException($messages['unexpected_error']);
        }

        return [
            'id_order'   => $shipment->id_order,
            'address'    => $shipment->address,
            'status'     => $shipment->status,
            'created_at' => $shipment->created_at
        ];
    }

    public function getShipment(int $id): ?Shipment {
        if ($id <= 0) {
             throw new NotFoundException(
                str_replace(':value', 'envio', $messages['not_found'])
            );
        }

        return $this->repository->findById($id);
    }

    public function changeShipmentStatus(int $id, string $status): bool {
        return $this->repository->updateStatus($id, $status);
    }
}