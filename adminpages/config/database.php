<?php 
class Database {
    private $host ="pq5uks.myd.infomaniak.com";
    private $db_name = "pq5uks_bde_lamanu";
    private $username = "pq5uks_admin";
    private $password = "Joluaxdolo76610@";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erreur de connexion : ".$exception->getMessage();
        }

        return $this->conn;
        
        }
    }