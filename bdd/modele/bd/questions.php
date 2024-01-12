<?php

namespace bd;
use PDO;
class Questions{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getQuestionsByQuizz($id) {
        $conn = $this->db->getConnection();
        $query = "SELECT * FROM questions WHERE quizz_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}