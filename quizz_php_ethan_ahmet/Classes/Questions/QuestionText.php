<?php
namespace  Questions;

class QuestionText extends Question
{
    public function __construct(string $name, string $type, string $text, array $answers, int $score)
    {
        parent::__construct($name, $type, $text, $answers, $score);
    }

    public function render(): string
    {
        return "{$this->text}<br><input type='text' name='q{$this->name}'><br>";
    }

    public function checkAnswer($userAnswer): bool
    {
        $userAnswerLower = strtolower(str_replace(' ', '', $userAnswer)); // Convertir la réponse de l'utilisateur en minuscules et supprimer les espaces
    
        foreach ($this->answers as $answer) {
            $correctAnswerLower = strtolower(str_replace(' ', '', $answer->getAnswerText())); // Convertir la réponse correcte en minuscules et supprimer les espaces
    
            if ($correctAnswerLower === $userAnswerLower) {
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
