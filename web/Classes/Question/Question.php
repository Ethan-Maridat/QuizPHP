<?php
namespace  Classes\Question;

use  Classes\Answer\Answer;

abstract class Question implements Render
{
    protected $name;
    protected $type;
    protected $text;
    protected $answers;
    protected $score;

    public function __construct(string $name, string $type, string $text, array $answers, int $score)
    {
        $this->name = $name;
        $this->type = $type;
        $this->text = $text;
        $this->answers = $answers;
        $this->score = $score;
    }

    abstract public function render(): string;

    public function answer($userAnswer): bool
    {
        foreach ($this->answers as $answer) {
            if ($answer->evaluate($userAnswer)) {
                return true;
            }
        }
        return false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function displayAnswers(): string
    {
        $response = [];
        foreach ($this->answers as $answer) {
            $response[] = "Réponse : " . $answer->render();
        }
        return implode('<br>', $response);
    }
}
?>