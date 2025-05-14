<?php

require_once __DIR__ . '/../config/database.php';

class User {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        if (!$this->db) {
            // Gérez l'erreur de connexion ici, par exemple lancer une exception
            die("Erreur de connexion à la base de données dans le modèle User.");
        }
    }

    public function register($data) {
        $sql = "INSERT INTO Users (prenom, email, mdp, date_inscription) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['prenom'], $data['email'], $data['mdp']]);
    }

    public function login($email) {
        $sql = "SELECT * FROM Users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vous pourriez avoir d'autres méthodes ici pour la gestion des utilisateurs
}