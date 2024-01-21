<?php
namespace Choice;

class Choice
{
    private string $text;
    private string $value;

    public function __construct(string $text, string $value)
    {
        $this->text = $text;
        $this->value = $value;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function render(): string
    {
        return "{$this->text} ({$this->value})";
    }
}
?>