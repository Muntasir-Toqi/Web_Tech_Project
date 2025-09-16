<?php
require_once 'BaseController.php';

class HomeController extends BaseController {
    public function index() {
        if (isset($_SESSION['user'])) {
            $role = $_SESSION['user']['role'];
            if ($role === 'admin') $this->redirect(BASE_URL . '/public/index.php?p=admin/dashboard');
            if ($role === 'organization') $this->redirect(BASE_URL . '/public/index.php?p=org/dashboard');
            if ($role === 'customer') $this->redirect(BASE_URL . '/public/index.php?p=user/dashboard');
        }
        $this->view('home/index.php');
    }
}
