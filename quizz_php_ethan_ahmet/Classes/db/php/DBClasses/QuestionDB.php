<?php
namespace db\php\DBClasses;

require_once __DIR__ . '/../../../Autoloader.php';
use \Classes\Autoloader;
Autoloader::register();


use mysqli;
use  db\php\DB_connection;
use  Questions\Question;
use  Questions\QuestionRadio;
use  Questions\QuestionCheckbox;
use  Questions\QuestionText;
use  Questions\QuizHandler;
use  Answer\Answer;
use  Choice\Choice;

class QuestionDB
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    private function createQuestion(array $data): Question
    {
        $name = $data['question_id'];
        $text = $data['question_text'];
        $type = $data['type'];
        $score = $data['score'];

        $answers = $this->getAnswersForQuestion($name);

        switch ($type) {
            case 'radio':
                $choices = $this->getChoicesForQuestion($name);
                return new QuestionRadio($name, $type, $text, $answers, $score, $choices);

            case 'checkbox':
                $choices = $this->getChoicesForQuestion($name);
                return new QuestionCheckbox($name, $type, $text, $answers, $score, $choices);

            case 'text':
                return new QuestionText($name, $type, $text, $answers, $score);

            default:
                throw new \Exception("Type de question non pris en charge : $type");
        }
    }

    private function getAnswersForQuestion($questionId): array
    {
        $query = "SELECT * FROM ANSWER WHERE question_id = ? AND est_valide = TRUE";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();

        $answers = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $answers[] = new Answer($row['answer_id'], $row['answer_text'], $row['question_id'], $row['est_valide']);
            }
        }

        return $answers;
    }

    private function getChoicesForQuestion($questionId): array
    {
        $query = "SELECT * FROM ANSWER WHERE question_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();

        $choices = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $choices[] = new Choice($row['answer_text'], $row['answer_id']);
            }
        }

        return $choices;
    }

    public function getQuestionByID($questionId): Question
    {
        $query = "SELECT * FROM QUESTION WHERE question_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $this->createQuestion($row);
            }
        }

        throw new \Exception("La question avec l'identifiant " . (string) $questionId . " n'existe pas.");
    }
}

?>