<?php
require_once __DIR__ . '/../config/database.php';

class Task {
    public static function create($user_id, $org_id, $title, $priority = 'low', $due_date = null, $description = null) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO tasks (user_id, org_id, title, priority, due_date, description) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $org_id, $title, $priority, $due_date, $description]);
    }


    public static function getByUser($user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByUserAndOrg($user_id, $org_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tasks WHERE user_id = ? AND org_id = ?");
        $stmt->execute([$user_id, $org_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByOrg($org_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tasks WHERE org_id = ?");
        $stmt->execute([$org_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function markComplete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE tasks SET completed = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getStats() {
        $db = Database::connect();
        $stats = [];

        $stats['total_tasks'] = $db->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
        $stats['completed_tasks'] = $db->query("SELECT COUNT(*) FROM tasks WHERE completed=1")->fetchColumn();
        $stats['pending_tasks'] = $db->query("SELECT COUNT(*) FROM tasks WHERE completed=0")->fetchColumn();
        $stats['active_users'] = $db->query("SELECT COUNT(*) FROM users WHERE status='active'")->fetchColumn();

        return $stats;
    }

    public static function getPersonalTasks($userId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM tasks WHERE user_id=? AND org_id IS NULL");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOrgTasks($userId) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT t.*, o.name as org_name
            FROM tasks t
            JOIN organizations o ON t.org_id = o.id
            WHERE t.user_id=? AND t.org_id IS NOT NULL
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateTask($id, $title, $description, $priority, $due_date) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE tasks SET title=?, description=?, priority=?, due_date=? WHERE id=?");
        return $stmt->execute([$title, $description, $priority, $due_date, $id]);
    }

    public static function deleteTask($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM tasks WHERE id=?");
        return $stmt->execute([$id]);
    }
}
