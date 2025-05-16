<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        if (! $this->db) {
            die("Erreur de connexion à la base de données dans le modèle User.");
        }
    }

    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT id, email FROM Users"); // Sélectionne l'email (login)
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
{
    $stmt = $this->db->prepare("SELECT id, email, prenom, prenom FROM Users WHERE id = ?"); // ERREUR : 'prenom' répété
    // Correction si tu as une colonne 'nom' :
    // $stmt = $this->db->prepare("SELECT id, email, prenom, nom FROM Users WHERE id = ?");
    // Correction si tu n'as pas de colonne 'nom' :
    $stmt = $this->db->prepare("SELECT id, email, prenom FROM Users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function createUser($prenom, $email, $mdp)
    {
        $stmt = $this->db->prepare("INSERT INTO Users (prenom, email, mdp) VALUES (?, ?, ?)");
        return $stmt->execute([$prenom, $email, $mdp]);
    }

    public function updateUser($id, $nom = null, $prenom = null, $email = null, $mdp = null)
    {
        $sql        = "UPDATE Users SET ";
        $params     = [];
        $setClauses = [];

        if ($nom !== null) {
            $setClauses[] = "nom = ?";
            $params[]     = $nom;
        }
        if ($prenom !== null) {
            $setClauses[] = "prenom = ?";
            $params[]     = $prenom;
        }
        if ($email !== null) {
            $setClauses[] = "email = ?";
            $params[]     = $email;
        }
        if ($mdp !== null) {
            $setClauses[] = "mdp = ?";
            $params[]     = $mdp;
        }

        $sql .= implode(', ', $setClauses);
        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
