<?php

require_once __DIR__ . '/../config/database.php';

class Account
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        if (!$this->db) {
            die("Erreur de connexion à la base de données dans le modèle Account.");
        }
    }

    public function getAllAccounts()
{
    $stmt = $this->db->query("SELECT id, nom, description, solde, RIB FROM accounts");
    if ($stmt === false) {
        var_dump($this->db->errorInfo());
        die("Erreur lors de l'exécution de la requête.");
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getAccountById($id)
    {
        $stmt = $this->db->prepare("SELECT id, nom, description, solde, RIB FROM accounts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addAccount($data)
    {
        $sql = "INSERT INTO accounts (nom, description, RIB, date_creation) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['nom'], $data['description'], $data['RIB']]);
    }

    public function updateAccount($id, $data)
    {
        $sql = "UPDATE accounts SET nom = ?, description = ?, RIB = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['nom'], $data['description'], $data['RIB'], $id]);
    }

    public function deleteAccount($id)
    {
        $sql = "DELETE FROM accounts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function updateAccountBalance($accountId, $newBalance)
    {
        $sql = "UPDATE accounts SET solde = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$newBalance, $accountId]);
    }
    public function getDernieresTransactions(int $limit = 5): array
{
    $sql = "SELECT t.date_transaction, t.montant, t.type, t.description, a.nom AS nom_compte
            FROM transactions t
            JOIN accounts a ON t.compte_id = a.id
            ORDER BY t.date_transaction DESC
            LIMIT :limit";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}