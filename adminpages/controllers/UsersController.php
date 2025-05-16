<?php

require_once __DIR__ . '/../config/database.php';

class UsersController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        if (!$this->db) {
            die("Erreur de connexion à la base de données dans le contrôleur Users.");
        }
    }

    public function signup()
    {
        // ... (ta logique d'inscription)
    }

     public function signin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $mdp = $_POST['mdp'] ?? '';

            // Validation de l'email et du mot de passe (à adapter selon tes besoins)
            if (empty($email) || empty($mdp)) {
                $error = "Veuillez entrer votre email et votre mot de passe.";
                require __DIR__ . '/../views/auth/signin.php';
                return;
            }

            // Requête pour récupérer l'utilisateur par email, s'assurer que 'prenom' est inclus
            $stmt = $this->db->prepare("SELECT id, email, mdp, prenom FROM Users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($mdp, $user['mdp'])) {
                // Authentification réussie
                $_SESSION['user'] = $user; // Stocke TOUTES les informations de l'utilisateur en session
                header('Location: /adminpages/index.php?action=home'); // Redirige vers la page d'accueil
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
                require __DIR__ . '/../views/auth/signin.php';
                return;
            }
        } else {
            // Si la requête n'est pas un POST, affiche le formulaire de connexion
            require __DIR__ . '/../views/auth/signin.php';
        }
    }
}