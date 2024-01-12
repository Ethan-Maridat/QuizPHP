<?php
namespace bd;
use PDO;
use PDOException;

class Database {
    private $conn;
    public function connect() {
        try {
            $this->conn = new PDO('sqlite:db.sqlite');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
