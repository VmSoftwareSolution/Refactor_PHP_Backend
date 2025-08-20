<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductRepository {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // ✅ Ahora acepta un $excludeId opcional
    public function existsByName(string $name, ?int $excludeId = null): bool {
        if ($excludeId !== null) {
            $stmt = $this->conn->prepare("SELECT id FROM products WHERE name = ? AND id != ?");
            $stmt->bind_param("si", $name, $excludeId);
            error_log("[ProductRepository][existsByName] Checking name='$name' excluding id=$excludeId");
        } else {
            $stmt = $this->conn->prepare("SELECT id FROM products WHERE name = ?");
            $stmt->bind_param("s", $name);
            error_log("[ProductRepository][existsByName] Checking name='$name' with no exclusion");
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $exists = (bool) $row;
        error_log("[ProductRepository][existsByName] exists=" . ($exists ? "true" : "false"));

        return $exists;
    }

    public function create(Product $product): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO products (name, description, price, stock, category, image)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssiiss", 
            $product->name, 
            $product->description, 
            $product->price, 
            $product->stock, 
            $product->category, 
            $product->image
        );
        return $stmt->execute();
    }

    public function findById(int $id): ?Product {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Product(
                $row['name'],
                $row['description'],
                (int) $row['price'],
                (int) $row['stock'],
                $row['category'],
                $row['image'],
                (int) $row['id']
            );
        }

        return null;
    }

    public function deleteById(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function update(Product $product): bool {
        $stmt = $this->conn->prepare("
            UPDATE products 
            SET name = ?, description = ?, price = ?, stock = ?, category = ?, image = ? 
            WHERE id = ?
        ");
        $stmt->bind_param(
            "ssiissi", 
            $product->name, 
            $product->description, 
            $product->price, 
            $product->stock, 
            $product->category, 
            $product->image,
            $product->id
        );

        error_log("[ProductRepository][update] id={$product->id}, name={$product->name}");
        return $stmt->execute();
    }

    public function findAll(int $limit = 100, int $offset = 0): array {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY id ASC LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = new Product(
                $row['name'], 
                $row['description'],  
                (int)$row['price'], 
                (int)$row['stock'], 
                $row['category'], 
                $row['image'], 
                (int)$row['id']
            );
        }

        return $products;
    }

    public function countAll(): int {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM products");
        $row = $result->fetch_assoc();
        return (int)($row['total'] ?? 0);
    }

    public function getProductDetails(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT name, price FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc() ?: null;
    }
}
