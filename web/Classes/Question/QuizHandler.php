<?php
namespace  Classes\Question;

class QuizHandler
{
    private $questions;
    private $action;

    public function __construct(array $questions, $act)
    {
        $this->questions = $questions;
        $this->action = $act;
    }

    public function renderForm(): string
    {
        $html = "<form method='POST' action='{$this->action}'>";
        foreach ($this->questions as $q) {
            $html .= "<li class='question'>";
            $html .= $q->render() . "</li>";
        }
        $html .= "<br><input type='submit' name='submitQuiz' value='Répondre'></form>";

        return $html;
    }

    public function processResults(): array
    {
        $results = [
            'questionTotal' => 0,
            'questionCorrect' => 0,
            'scoreTotal' => 0,
            'scoreCorrect' => 0,
        ];

        foreach ($this->questions as $q) {
            $results['questionTotal'] += 1;
            $userAnswer = $_POST['q' . $q->getName()] ?? null;
            if ($q->checkAnswer($userAnswer)) {
                $results['questionCorrect'] += 1;
                $results['scoreCorrect'] += $q->getScore();
            }

            $results['scoreTotal'] += $q->getScore();
        }

        return $results;
    }
}
?>