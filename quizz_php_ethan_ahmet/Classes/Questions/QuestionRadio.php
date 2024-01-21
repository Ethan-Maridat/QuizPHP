<?php
namespace  Questions;

class QuestionRadio extends Question
{
    private array $choices;

    public function __construct(string $name, string $type, string $text, array $answers, int $score, array $choices)
    {
        parent::__construct($name, $type, $text, $answers, $score);
        $this->choices = $choices;
    }

    public function render(): string
    {
        $html = $this->text . "<br>";
        $i = 0;
        foreach ($this->choices as $c) {
            $i += 1;
            $html .= "<input type='radio' name='q{$this->name}' value='{$c->getValue()}' id='{$this->name}-{$i}'>";
            $html .= "<label for='{$this->name}-{$i}'>{$c->getText()}</label>";
        }
        return $html;
    }

    public function checkAnswer($userAnswer): bool
    {
        foreach ($this->answers as $answer) {
            if ($answer->getAnswerId() === (int)$userAnswer) {
                return true;
            }
        }
        return false;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
?>