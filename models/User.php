<?php
require_once __DIR__ . '/../config/database.php';

class User {
    public static function create($username, $email, $password, $role = 'customer') {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, ?, 'active')");
        return $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $role]);
    }

    public static function findByEmail($email) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function all() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateProfile($id, $username, $password = null) {
        $db = Database::connect();

        if (!empty($password)) {
            $stmt = $db->prepare("UPDATE users SET username=?, password=? WHERE id=?");
            return $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $id]);
        } else {
            $stmt = $db->prepare("UPDATE users SET username=? WHERE id=?");
            return $stmt->execute([$username, $id]);
        }
    }

    public static function addCustomer($username, $email, $password) {
        return self::create($username, $email, $password, 'customer');
    }

    public static function updateCustomer($id, $username, $email, $status) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE users SET username=?, email=?, status=? WHERE id=? AND role='customer'");
        return $stmt->execute([$username, $email, $status, $id]);
    }

    public static function deleteCustomer($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM users WHERE id=? AND role='customer'");
        return $stmt->execute([$id]);
    }

    public static function getCustomers() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM users WHERE role='customer'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
