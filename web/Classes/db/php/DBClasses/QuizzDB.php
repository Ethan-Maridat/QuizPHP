<?php
namespace Classes\db\php\DBClasses;

require_once __DIR__ . '/../../../Autoloader.php';
Autoloader::register();

require_once __DIR__ . '/../DB_connection.php';
require_once __DIR__ . '/QuestionDB.php';

use mysqli;
use  db\php\DB_connection;
use  db\php\DBClasses\QuestionDB;
use  Quizz;


class QuizzDB
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function getAllQuizz(): array
    {
        $quizzArray = array();

        $query = "SELECT * FROM QUIZZ";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quizz = $this->mapToQuizz($row);
                $quizzArray[] = $quizz;
            }
        }
        return $quizzArray;
    }

    private function addQuestions($quizz_id): array
    {
        $DBQuestion = new QuestionDB($this->conn);
        $questions = [];
        $query = "SELECT question_id FROM QUESTION_QUIZZ WHERE quizz_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $quizz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $questions[] = $DBQuestion->getQuestionByID((int)$row['question_id']);
            }
        }
        return $questions;
    }

    public function mapToQuizz($row): Quizz
    {
        $questions = $this->addQuestions($row['quizz_id']);
        $quizz = new Quizz((int)$row['quizz_id'], $row['quizz_name'], $questions, $row['quizz_description'], (int) $row['quizz_difficulte']);
        return $quizz;
    }

    public function getQuizzById(int $id): Quizz
    {
        $query = ("SELECT * FROM QUIZZ WHERE quizz_id = ?");
        $quizz = null;
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quizz = $this->mapToQuizz($row);
            }
        }
        return $quizz;
    }

    public function getScoreOnQuizz(string $pseudo, int $quiz_id)
    {
        $query = "SELECT score FROM QUIZZ_TERMINE WHERE pseudo = ? AND quizz_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $pseudo, $quiz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $score = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $score = $row['score'];
            }
        }
        return $score;
    }


}
?>