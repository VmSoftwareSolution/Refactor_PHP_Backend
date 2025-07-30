<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Role.php';

class RoleRepository {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(Role $role) {
        $stmt = $this->conn->prepare("INSERT INTO roles (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $role->name, $role->description);
        return $stmt->execute();
    }

    public function findByName(string $name): ?Role {
        $stmt = $this->conn->prepare("SELECT * FROM roles WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Role($row['name'], $row['description']);
        }

        return null;
    }
}
