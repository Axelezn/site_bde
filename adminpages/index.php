<?php
session_start();
$action = $_GET['action'] ?? 'home';

// Si l'utilisateur n'est pas connecté, redirection vers la page de connexion

if (!isset($_SESSION['user']) && !in_array($action, ['signin', 'signup'])) {
    header('Location : index.php?action=signin');
    exit();
}

// Appeler les contrôleurs

require_once __DIR__.'/controllers/UsersController.php';
$controller = new UsersController();

switch ($action) {
    case 'signup':
        $controller->signup();
        break;
    case 'signin':
        $controller->signin();
        break;
    case 'logout':
    session_destroy();
    header('Location: ../index.html');
    exit();
    break;
}