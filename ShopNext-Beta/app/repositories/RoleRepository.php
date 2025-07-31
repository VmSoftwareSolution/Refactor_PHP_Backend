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
            return new Role($row['name'], $row['description'], (int)$row['id']);
        }

        return null;
    }

    public function findById(int $id): ?Role {
        $stmt = $this->conn->prepare("SELECT * FROM roles WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Role($row['name'], $row['description'], (int)$row['id']);
        }

        return null;
    }


    public function deleteById(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM roles WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function update(Role $role): bool {
        $stmt = $this->conn->prepare("UPDATE roles SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $role->name, $role->description, $role->id);
        return $stmt->execute();
    }


}
