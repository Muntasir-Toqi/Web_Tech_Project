<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Organization.php';
require_once __DIR__ . '/../models/JoinRequest.php';
require_once __DIR__ . '/../models/Log.php';

class OrgController extends BaseController {
    public function dashboard() {
        $orgId = $_SESSION['user']['id'];
        $tasks = Task::getByOrg($orgId);
        $requests = JoinRequest::getByOrg($orgId);
        $members = JoinRequest::getApprovedMembers($orgId);

        $report = [];
        foreach ($tasks as $task) {
            $report[$task['user_id']]['total'] = ($report[$task['user_id']]['total'] ?? 0) + 1;
            if ($task['completed']) {
                $report[$task['user_id']]['completed'] = ($report[$task['user_id']]['completed'] ?? 0) + 1;
            }
        }

        $this->view('org/dashboard.php', [
            'tasks' => $tasks,
            'requests' => $requests,
            'members' => $members,
            'report' => $report
        ]);
    }

   public function assignTask() {
        $orgId = $_SESSION['user']['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $title = $_POST['title'];
            $priority = $_POST['priority'];
            $due_date = $_POST['due_date'];
            $description = $_POST['description'];

            $members = JoinRequest::getApprovedMembers($orgId);
            $valid = false;
            foreach ($members as $m) {
                if ($m['id'] == $userId) {
                    $valid = true;
                    break;
                }
            }

            if ($valid) {
                Task::create($userId, $orgId, $title, $priority, $due_date, $description);
                Log::add($_SESSION['user']['email'], "Assigned Task: $title to User $userId");
            } else {
                Log::add($_SESSION['user']['email'], "Failed Task Assignment: User $userId not approved", 0);
            }
        }
        $this->redirect(BASE_URL . '/public/index.php?p=org/dashboard');
    }


    public function updateRequest() {
        $reqId = $_GET['id'];
        $status = $_GET['status'];
        JoinRequest::updateStatus($reqId, $status);
        Log::add($_SESSION['user']['email'], "Updated Join Request ID: $reqId → $status");
        $this->redirect(BASE_URL . '/public/index.php?p=org/dashboard');
    }
}
