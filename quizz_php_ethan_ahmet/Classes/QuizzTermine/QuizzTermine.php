<?php
namespace QuizzTermine;

/**
 * Class QuizzTermine
 * @package QuizzTermine
 */
class QuizzTermine
{
    private string $pseudo;

    private int $quizzId;

    private int $score;

    public function __construct(string $pseudo, int $quizzId, int $score) {
        $this->pseudo = $pseudo;
        $this->quizzId = $quizzId;
        $this->score = $score;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function getQuizzId(){
        return $this->quizzId;
    }

    public function getScore(){
        return $this->score;
    }

}
?>