<?php
namespace Answer;

class Answer
{
    private int $answerId;
    private string $answerText;
    private int $questionId;
    private bool $isValid;

    public function __construct(int $answerId, string $answerText, int $questionId, bool $isValid = false)
    {
        $this->answerId = $answerId;
        $this->answerText = $answerText;
        $this->questionId = $questionId;
        $this->isValid = $isValid;
    }

    public function getAnswerId(): int
    {
        return $this->answerId;
    }

    public function setAnswerId(int $answerId): void
    {
        $this->answerId = $answerId;
    }

    public function getAnswerText(): string
    {
        return $this->answerText;
    }

    public function setAnswerText(string $answerText): void
    {
        $this->answerText = $answerText;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId): void
    {
        $this->questionId = $questionId;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function setValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    public function render(): string
    {
        return $this->answerText;
    }
}
?>
