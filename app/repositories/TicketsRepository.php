<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Tickets.php';

class TicketsRepository {
    private mysqli $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    public function create(Tickets $ticket): bool {
        $stmt = $this->conn->prepare("
            INSERT INTO tickets (tittle, message, priority, status, id_person, created_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssssis",
            $ticket->tittle,
            $ticket->message,
            $ticket->priority,
            $ticket->status,
            $ticket->id_person,
            $ticket->created_at
        );
         return $stmt->execute();
    }

    public function findAll(int $limit = 100, int $offset = 0): array {
        $stmt = $this->conn->prepare("SELECT * FROM tickets ORDER BY id ASC LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $tickets = [];
        while ($row = $result->fetch_assoc()) {
            $tickets[] = new Tickets(
                $row['tittle'], 
                $row['message'],  
                $row['priority'], 
                $row['status'], 
                (int)$row['id_person'], 
                $row['created_at'],
                (int)$row['id']);
        }

        return $tickets;
    }

    public function countAll(): int {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM tickets");
        $row = $result->fetch_assoc();
        return (int)($row['total'] ?? 0);
    }

    public function findById(int $id): ?Tickets {
        $stmt = $this->conn->prepare("SELECT * FROM tickets WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
        return new Tickets(
            $row['tittle'], 
            $row['message'],  
            $row['priority'], 
            $row['status'], 
            (int)$row['id_person'], 
            $row['created_at'],
            (int)$row['id']
        );
    }
    }

    public function update(Tickets $ticket): bool {
        $stmt = $this->conn->prepare("UPDATE tickets SET tittle = ?, message = ?, priority = ?, status = ?, id_person = ?, created_at = ? WHERE id = ?");
        $stmt->bind_param("ssssisi", $ticket->tittle, $ticket->message, $ticket->priority, $ticket->status, $ticket->id_person, $ticket->created_at ,$ticket->id);
        
        if (!$stmt->execute()) {
            throw new Exception("Error en UPDATE: " . $stmt->error);
        }
        return $stmt->execute();
    }
}