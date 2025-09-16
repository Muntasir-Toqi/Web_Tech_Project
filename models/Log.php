<?php
require_once __DIR__ . '/../config/database.php';

class Log {
    public static function add($user_email, $action, $success = 1) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO logs (user_email, action, success) VALUES (?, ?, ?)");
        return $stmt->execute([$user_email, $action, $success]);
    }

    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM logs ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
