<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Organization.php';
require_once __DIR__ . '/../models/JoinRequest.php';
require_once __DIR__ . '/../models/Log.php';

class UserController extends BaseController {
    public function dashboard() {
    $user = $_SESSION['user'];
        $personalTasks = Task::getPersonalTasks($user['id']);
        $orgTasks = Task::getOrgTasks($user['id']);
        $orgs = Organization::all(); // for join requests

        $this->view('user/dashboard.php', [
            'personalTasks' => $personalTasks,
            'orgTasks' => $orgTasks,
            'orgs' => $orgs
        ]);
    }

    public function addTask() {
        $user = $_SESSION['user'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $priority = $_POST['priority'];
            $due_date = $_POST['due_date'];
            $description = $_POST['description'];

            Task::create($user['id'], null, $title, $priority, $due_date, $description);
            Log::add($user['email'], "Added Task: $title");
        }
        $this->redirect(BASE_URL . '/public/index.php?p=user/dashboard');
    }

    public function editTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $priority = $_POST['priority'];
            $due_date = $_POST['due_date'];

            Task::updateTask($id, $title, $description, $priority, $due_date);
            $this->redirect(BASE_URL . '/public/index.php?p=user/dashboard');
        }
    }

    public function deleteTask() {
        $id = $_GET['id'];
        Task::deleteTask($id);
        $this->redirect(BASE_URL . '/public/index.php?p=user/dashboard');
    }


    public function completeTask() {
        $id = $_GET['id'];
        $completed = isset($_GET['done']) && $_GET['done'] == 0 ? 0 : 1; // toggle
        Task::markComplete($id, $completed);
        $this->redirect(BASE_URL . '/public/index.php?p=user/dashboard');
    }


    public function joinOrg() {
        $user = $_SESSION['user'];
        $orgId = $_POST['org_id'];
        JoinRequest::create($user['id'], $orgId);
        Log::add($user['email'], "Requested to join Org ID: $orgId");
        $this->redirect(BASE_URL . '/public/index.php?p=user/dashboard');
    }


    public function profile() {
    $user = $_SESSION['user'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newUsername = $_POST['username'];
        $newPassword = $_POST['password'];

        // Call Model instead of direct query
        User::updateProfile($user['id'], $newUsername, $newPassword);

        // Refresh session
        $_SESSION['user'] = User::findById($user['id']);

        Log::add($user['email'], "Updated Profile");
        $this->redirect(BASE_URL . '/public/index.php?p=user/profile');
    }

    $this->view('user/profile.php', ['user' => $user]);
}


}
