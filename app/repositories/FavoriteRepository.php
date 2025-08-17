<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Favorite.php';

class FavoriteRepository {
    private mysqli $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(Favorite $Favorite): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO favorites (id_person, products)
            VALUES (?, ?)
        ");
        $jsonProducts = json_encode($Favorite->products, JSON_UNESCAPED_UNICODE);
        $stmt->bind_param("is", $Favorite->id_person, $jsonProducts);
        return $stmt->execute();
    }

    public function findByPersonId(int $id_person): ?Favorite {
        $stmt = $this->conn->prepare("SELECT * FROM favorites WHERE id_person = ?");
        $stmt->bind_param("i", $id_person);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$row = $result->fetch_assoc()) {
            return null;
        }

        $products = json_decode($row['products'], true) ?? [];
        return new Favorite(
            id_person: (int)$row['id_person'],
            products: $products,
            id: (int)$row['id']
        );
    }

    public function updateFav(int $favId, array $products): bool {
        $jsonProducts = json_encode($products, JSON_UNESCAPED_UNICODE);
        $stmt = $this->conn->prepare("
            UPDATE favorites
            SET products = ?
            WHERE id = ?
        ");
        $stmt->bind_param("si", $jsonProducts, $favId);
        return $stmt->execute();
    }
}
