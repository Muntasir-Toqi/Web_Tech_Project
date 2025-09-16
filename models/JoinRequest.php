<?php
require_once __DIR__ . '/../config/database.php';

class JoinRequest {
    public static function create($user_id, $org_id) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO join_requests (user_id, org_id, status) VALUES (?, ?, 'pending')");
        return $stmt->execute([$user_id, $org_id]);
    }

    public static function getByOrg($org_id) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT jr.*, u.username 
            FROM join_requests jr 
            JOIN users u ON jr.user_id = u.id 
            WHERE jr.org_id = ?
        ");
        $stmt->execute([$org_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getApprovedMembers($org_id) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT u.id, u.username, u.email 
            FROM join_requests jr 
            JOIN users u ON jr.user_id = u.id 
            WHERE jr.org_id = ? AND jr.status = 'approved'
        ");
        $stmt->execute([$org_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateStatus($id, $status) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE join_requests SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
