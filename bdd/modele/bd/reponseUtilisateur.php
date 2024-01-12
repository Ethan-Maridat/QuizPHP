<?php

namespace bd;
use PDO;
class reponseUtilisateur{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getReponseUtilisateurByQuestion($id) {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM reponse_utilisateurs WHERE question_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}