<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Organization.php';
require_once __DIR__ . '/../models/Log.php';

class AdminController extends BaseController {
    public function dashboard() {
        $customers = User::getCustomers();
        $orgs = Organization::all();
        $logs = Log::all();
        $stats = Task::getStats();

        $this->view('admin/dashboard.php', [
            'customers' => $customers,
            'orgs' => $orgs,
            'logs' => $logs,
            'stats' => $stats
        ]);
    }

    public function addCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            User::addCustomer($username, $email, $password);
            $this->redirect(BASE_URL . '/public/index.php?p=admin/dashboard');
        }
    }

    public function editCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $status = $_POST['status'];
            User::updateCustomer($id, $username, $email, $status);
            $this->redirect(BASE_URL . '/public/index.php?p=admin/dashboard');
        }
    }

    public function deleteCustomer() {
        $id = $_GET['id'];
        User::deleteCustomer($id);
        $this->redirect(BASE_URL . '/public/index.php?p=admin/dashboard');
    }
}
