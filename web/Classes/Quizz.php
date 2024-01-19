<?php
namespace Classes;

require_once __DIR__ . '/Classes/Autoloader.php';
Autoloader::register();

use  Classes\Question\Question;

class Quizz
{
    protected $id;
    protected $name;
    protected $questions;
    protected $description;
    protected $difficulte;

    public function __construct(int $id, string $name, array $lesQuestion, string $description, int $difficulte)
    {
        $this->id = $id;
        $this->name = $name;
        $this->questions = $lesQuestion;
        $this->description = $description;
        $this->difficulte = $difficulte;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDifficulte(): int
    {
        return $this->difficulte;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setQuestions(array $questions): void
    {
        $this->questions = $questions;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setDifficulte(int $difficulte): void
    {
        $this->difficulte = $difficulte;
    }

    public function addQuestion(Question $quest): void
    {
        $this->questions[] = $quest;
    }
}
?>