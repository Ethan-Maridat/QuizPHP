<?php
namespace Classes\db\php\DBClasses;

require_once __DIR__ . '/../../../Autoloader.php';
Autoloader::register();

use mysqli;
use  QuizzTermine\QuizzTermine;

class QuizzTermineDB
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }
    
    public function getAllQuizzTermine(): array
    {
        $quizzTermineArray = array();

        $query = "SELECT * FROM QUIZZ_TERMINE";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quizzTermine = $this->mapToQuizzTermine($row);
                $quizzTermineArray[] = $quizzTermine;
            }
        }
        return $quizzTermineArray;
    }

    public function getAllQuizzTermineByPseudo(string $pseudo): array
    {
        $quizzTermineArray = array();

        $query = "SELECT * FROM QUIZZ_TERMINE WHERE pseudo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quizzTermine = $this->mapToQuizzTermine($row);
                $quizzTermineArray[] = $quizzTermine;
            }
        }
        return $quizzTermineArray;
    }

    public function getAllQuizzFini(string $pseudo): array
    {
        $quizzTermineArray = array();

        $query = "SELECT quizz_id, quizz_name, quizz_description, quizz_difficulte FROM QUIZZ_TERMINE NATURAL JOIN QUIZZ WHERE pseudo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $pseudo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $__QUIZZ_DB__ = new QuizzDB($this->conn);
                $quizzTermine = $__QUIZZ_DB__->mapToQuizz($row);
                $quizzTermineArray[] = $quizzTermine;
            }
        }
        return $quizzTermineArray;
    }

    public function getScoreByPseudoAndQuizzId(string $pseudo, int $quizzId): ?int
    {
        $query = "SELECT score FROM QUIZZ_TERMINE WHERE pseudo = ? AND quizz_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $pseudo, $quizzId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return (int)$row['score'];
        } else {
            return null;
        }
    }

    public function getMaxScore(int $quizz_id): ?array
    {
        $query = "SELECT pseudo, score AS max_score
        FROM QUIZZ_TERMINE
        WHERE quizz_id = ?
        AND score = (SELECT MAX(score) FROM QUIZZ_TERMINE WHERE quizz_id = ?);
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $quizz_id, $quizz_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return [
                'max_score' => (int)$row['max_score'],
                'pseudo' => $row['pseudo']
            ];
        } else {
            return null;
        }
    }

    private function mapToQuizzTermine($row): QuizzTermine
    {
        $pseudo = $row['pseudo'];
        $quizzId = (int)$row['quizz_id'];
        $score = (int)$row['score'];
        return new QuizzTermine($pseudo, $quizzId, $score);
    }

    public function insertQuizzTermine(string $pseudo, int $quizzId, int $score): bool
    {
        $query = "INSERT INTO QUIZZ_TERMINE (pseudo, quizz_id, score) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sid", $pseudo, $quizzId, $score);
    
        return $stmt->execute();
    }
    
}

?>