<?php

require_once __DIR__ . '/../config/database.php';

class Transaction
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        if (!$this->db) {
            die("Erreur de connexion à la base de données dans le modèle Transaction.");
        }
    }

    public function addTransaction($data)
    {
        $sql = "INSERT INTO transactions (type, compte_id, montant, description, compte_destinataire_id, date_transaction) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['type'], $data['compte_id'], $data['montant'], $data['description'], $data['compte_destinataire_id']]);
    }

    public function getTransactionsByAccountId($accountId)
    {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE compte_id = ? ORDER BY date_transaction DESC");
        $stmt->execute([$accountId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}