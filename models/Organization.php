<?php
require_once __DIR__ . '/../config/database.php';

class Organization {
    public static function create($name) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO organizations (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM organizations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM organizations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
