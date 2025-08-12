<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Order.php';

class OrderRepository {
    private mysqli $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(Order $order): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO orders (id_person, products, total_price, created_at, status)
            VALUES (?, ?, ?, ?, ?)
        ");
        $jsonProducts = json_encode($order->products, JSON_UNESCAPED_UNICODE);
        $stmt->bind_param("isiss", $order->id_person, $jsonProducts, $order->total_price, $order->created_at , $order->status);
        return $stmt->execute();
    }

     public function findById(int $id): ?Order {
        $stmt = $this->conn->prepare("
            SELECT id, id_person, products, total_price, created_at, status
            FROM orders
            WHERE id = ?
            LIMIT 1
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Order(
                id_person: (int)$row['id_person'],
                products: json_decode($row['products'], true) ?? [],
                total_price: (int)$row['total_price'],
                created_at: $row['created_at'],
                status: $row['status'],
                id: (int)$row['id']
            );
        }
        return null;
    }

    public function updateStatus(int $id, string $status): bool {
        $stmt = $this->conn->prepare("
            UPDATE orders
            SET status = ?
            WHERE id = ?
        ");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }
}