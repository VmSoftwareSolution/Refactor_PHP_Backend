<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Person.php';

class PersonRepository {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function findById(int $id): ?Person {
        $stmt = $this->conn->prepare("SELECT * FROM persons WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return new Person(
                $row['full_name'],
                (int)$row['id_user'],
                $row['phone'],
                $row['gender'],
                $row['date_of_birth'],
                $row['avatar'],
                (int)$row['id'],
                $row['create_at']
            );
        }
        return null;
    }

    public function findAll(int $limit = 100, int $offset = 0): array {
        $stmt = $this->conn->prepare("SELECT * FROM persons ORDER BY id ASC LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $persons = [];
        while ($row = $result->fetch_assoc()) {
            $persons[] = new Person(
                $row['full_name'],
                (int)$row['id_user'],
                $row['phone'],
                $row['gender'],
                $row['date_of_birth'],
                $row['avatar'],
                (int)$row['id'],
                $row['create_at']
            );
        }
        return $persons;
    }

    public function create(Person $person): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO persons (full_name, phone, gender, date_of_birth, avatar, id_user)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "sssssi",
            $person->full_name,
            $person->phone,
            $person->gender,
            $person->date_of_birth,
            $person->avatar,
            $person->id_user
        );
         return $stmt->execute();
    }

    public function update(Person $person): bool {
        $stmt = $this->conn->prepare("
            UPDATE persons SET full_name = ?, phone = ?, gender = ?, date_of_birth = ?, avatar = ?, id_user = ?
            WHERE id = ?
        ");
        $stmt->bind_param(
            "sssssii",
            $person->full_name,
            $person->phone,
            $person->gender,
            $person->date_of_birth,
            $person->avatar,
            $person->id_user,
            $person->id
        );
        return $stmt->execute();
    }

    public function deleteById(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM persons WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function countAll(): int {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM persons");
        $row = $result->fetch_assoc();
        return (int)($row['total'] ?? 0);
    }

    public function getLastInsertId(): int {
        return (int) $this->conn->insert_id; 
    }

    public function existsByUserId(int $id_user, ?int $excludePersonId = null): bool {
        if ($excludePersonId) {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM persons WHERE id_user = ? AND id != ?");
            $stmt->bind_param("ii", $id_user, $excludePersonId);
        } else {
            $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM persons WHERE id_user = ?");
            $stmt->bind_param("i", $id_user);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return (int)$row['total'] > 0;
    }

}
