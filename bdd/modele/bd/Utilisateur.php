<?php

namespace bd;
use PDO;

class Utilisateur {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM utilisateurs";
        $stmt = $conn->query($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
