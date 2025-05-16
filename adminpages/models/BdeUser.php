<?php

require_once __DIR__ . '/../config/database.php';

class BdeUser
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        if (!$this->db) {
            die("Erreur de connexion à la base de données dans le modèle BdeUser.");
        }
    }

    public function getAllBdeUsers()
    {
        $stmt = $this->db->prepare("SELECT id, login FROM BdeUsers"); // Adapte les colonnes selon ta table
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBdeUserById($id)
    {
        $stmt = $this->db->prepare("SELECT id, login FROM BdeUsers WHERE id = ?"); // Adapte les colonnes selon ta table
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBdeUser($id, $login, $mdp = null)
    {
        $sql = "UPDATE BdeUsers SET login = ?";
        $params = [$login];

        if ($mdp !== null) {
            $sql .= ", mdp = ?";
            $params[] = $mdp;
        }

        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function deleteBdeUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM BdeUsers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}