<?php
namespace  Classes\Question;

class QuestionCheckbox extends Question
{
    private array $choices;

    public function __construct(string $name, string $type, string $text, array $answers, int $score, array $choices)
    {
        parent::__construct($name, $type, $text, $answers, $score);
        $this->choices = $choices;
    }

    public function render(): string
    {
        $html = "{$this->text}<br>";
        $i = 0;
        foreach ($this->choices as $c) {
            $i += 1;
            $html .= "<input type='checkbox' name='q{$this->name}[]' value='{$c->getValue()}' id='{$this->name}-$i'>";
            $html .= "<label for='{$this->name}-$i'>{$c->getText()}</label>";
        }
        return $html;
    }

    public function checkAnswer($userAnswer): bool
    {
        if (!is_array($userAnswer)) {
            return false;
        }

        $bonne_rep = 0;

        foreach ($userAnswer as $rep) {
            foreach ($this->answers as $answer) {
                if ($answer->getAnswerId()===(int)$rep) {
                    $bonne_rep++;
                }
            }
        }

        return $bonne_rep === count($this->answers);
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
?>