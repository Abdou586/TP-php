<?php
class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->userModel->create($name, $email, $password)) {
                header('Location: /login');
                exit;
            } else {
                echo "Erreur lors de l'inscription";
            }
        } else {
            include __DIR__ . '/../Views/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->userModel->authenticate($email, $password)) {
                session_start();
                $_SESSION['user_id'] = $this->userModel->getUserIdByEmail($email);
                header('Location: /tasks');
                exit;
            } else {
                echo "Email ou mot de passe incorrect";
            }
        } else {
            include __DIR__ . '/../Views/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
?>