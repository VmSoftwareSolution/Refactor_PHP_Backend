<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Payload.php';

class PayloadRepository {
    private mysqli $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(Payload $payload): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO payloads (id_order, method, status, payment_at)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "isss",
            $payload->id_order,
            $payload->method,
            $payload->status,
            $payload->payment_at
        );
         return $stmt->execute();
    }

   public function findById(int $id): ?Payload {
        $stmt = $this->conn->prepare("
            SELECT id, id_order, method, status, payment_at
            FROM payloads
            WHERE id = ?
            LIMIT 1
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Payload(
                id_order: (int)$row['id_order'],
                method: $row['method'],
                payment_at: $row['payment_at'],
                status: $row['status'],
                id: (int)$row['id']
            );
        }
        return null;
    }

    public function updateStatus(int $id, string $status): bool {
        $stmt = $this->conn->prepare("
            UPDATE payloads
            SET status = ?
            WHERE id = ?
        ");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }
}