<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductRepository {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function existsByName(string $name): bool {
        $stmt = $this->conn->prepare("SELECT id FROM products WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return (bool) $result->fetch_assoc();
    }

    public function create(Product $product): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO products (name, description, price, stock, category, image)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssiiss", $product->name, $product->description, $product->price, $product->stock, $product->category, $product->image);
        return $stmt->execute();
    }
}