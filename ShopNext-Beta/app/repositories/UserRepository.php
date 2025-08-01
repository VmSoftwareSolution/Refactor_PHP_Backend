<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';

class UserRepository {
    
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(User $user) {
        $stmt = $this->conn->prepare("INSERT INTO users (email, password, role_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $user->email, $user->password, $user->role_id);
        return $stmt->execute();
    }

    public function existsByEmail(string $email): bool {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return (bool) $result->fetch_assoc();
    }

    public function findById(int $id): ?User {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
        return new User(
            $row['email'],
            (int) $row['role_id'],
            (int) $row['id']
        );
    }

        return null;
    }

    public function findByEmail(string $email): ?User {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new User($row['email'], $row['role_id'], (int)$row['id']);
        }

        return null;
    }
    
    public function getDefaultRoleId(): ?int {
        $stmt = $this->conn->prepare("SELECT id FROM roles WHERE name = 'cliente'");
        if (!$stmt) {
            throw new RuntimeException("Error en prepare(): " . $this->conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? (int)$row['id'] : null;
    }


}

