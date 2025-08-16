<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Shipment.php';

class ShipmentRepository {
    private mysqli $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(Shipment $shipment): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO shipments (id_order, address, status, created_at)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "isss",
            $shipment->id_order,
            $shipment->address,
            $shipment->status,
            $shipment->created_at
        );

        return $stmt->execute();
    }

    public function findById(int $id): ?Shipment {
        $stmt = $this->conn->prepare("
            SELECT id, id_order, address, status, created_at
            FROM shipments
            WHERE id = ?
            LIMIT 1
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Shipment(
                id_order: (int)$row['id_order'],
                address: $row['address'],
                status: $row['status'],
                created_at: $row['created_at'],
                id: (int)$row['id']
            );
        }
        return null;
    }

    public function updateStatus(int $id, string $status): bool {
        $stmt = $this->conn->prepare("
            UPDATE shipments
            SET status = ?
            WHERE id = ?
        ");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }
}