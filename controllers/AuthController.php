<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Organization.php';
require_once __DIR__ . '/../models/Log.php';

class AuthController extends BaseController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                Log::add($email, "Login", 1);
                $this->redirect(BASE_URL . '/public/index.php?p=home/index');
            } else {
                Log::add($email, "Login Failed", 0);
                $this->view('auth/login.php', ['error' => 'Invalid credentials']);
            }
        } else {
            $this->view('auth/login.php');
        }
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (User::create($username, $email, $password, $role)) {
                $user = User::findByEmail($email);

                // Auto create org entry if role is organization
               if ($role === 'organization') {
                    $db = Database::connect();
                    $stmt = $db->prepare("INSERT INTO organizations (id, name) VALUES (?, ?)");
                    $stmt->execute([$user['id'], $username]);
                }


                Log::add($email, "Signup as $role", 1);
                $this->redirect(BASE_URL . '/public/index.php?p=auth/login');
            } else {
                $this->view('auth/signup.php', ['error' => 'Signup failed']);
            }
        } else {
            $this->view('auth/signup.php');
        }

    }

    public function logout() {
        session_destroy();
        $this->redirect(BASE_URL . '/public/index.php?p=home/index');
    }
}
