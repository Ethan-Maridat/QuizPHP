<?php
namespace bd;
use PDO;
class Quizz {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllQuizz() {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM quizz";
        $stmt = $conn->query($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
