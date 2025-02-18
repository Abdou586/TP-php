<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/TaskController.php';
require_once __DIR__ . '/../app/Models/User.php';
require_once __DIR__ . '/../app/Models/Task.php';

$config = require __DIR__ . '/../config/database.php';

try {
    $db = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$userController = new UserController($db);
$taskController = new TaskController($db);

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($route) {
    case '/NIABALY_php/TP-php/':
    case '/NIABALY_php/TP-php/login':
        $userController->login();
        break;
    case '/NIABALY_php/TP-php/register':
        $userController->register();
        break;
    case '/NIABALY_php/TP-php/logout':
        $userController->logout();
        break;
    case '/NIABALY_php/TP-php/tasks':
        $taskController->index();
        break;
    case '/NIABALY_php/TP-php/tasks/create':
        $taskController->create();
        break;
    default:
        echo "404 Not Found";
        break;
}