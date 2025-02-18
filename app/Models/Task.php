<?php
class Task {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($title, $description, $status, $userId) {
        $query = "INSERT INTO tasks (title, description, status, user_id, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$title, $description, $status, $userId]);
    }
}
?>