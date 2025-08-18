<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/ShoppingCar.php';

class ShoppingCarRepository {
    private mysqli $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(ShoppingCar $cart): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO shopping_car (id_person, total_price, products)
            VALUES (?, ?, ?)
        ");
        $jsonProducts = json_encode($cart->products, JSON_UNESCAPED_UNICODE);
        $stmt->bind_param("iis", $cart->id_person, $cart->total_price, $jsonProducts);
        return $stmt->execute();
    }

    public function findByPersonId(int $id_person): ?ShoppingCar {
        $stmt = $this->conn->prepare("SELECT * FROM shopping_car WHERE id_person = ?");
        $stmt->bind_param("i", $id_person);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$row = $result->fetch_assoc()) {
            return null;
        }

        $products = json_decode($row['products'], true) ?? [];
        return new ShoppingCar(
            id_person: (int)$row['id_person'],
            products: $products,
            total_price: (int)$row['total_price'],
            id: (int)$row['id']
        );
    }

    public function updateCar(int $cartId, array $products, int $totalPrice): bool {
        $jsonProducts = json_encode($products, JSON_UNESCAPED_UNICODE);
        $stmt = $this->conn->prepare("
            UPDATE shopping_car
            SET products = ?, total_price = ?
            WHERE id = ?
        ");
        $stmt->bind_param("sii", $jsonProducts, $totalPrice, $cartId);
        return $stmt->execute();
    }


}
