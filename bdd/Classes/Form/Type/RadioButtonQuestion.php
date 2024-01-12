<?php

namespace Form\Type;

use Form\GenericFormElement;

class RadioButtonQuestion extends GenericFormElement
{
    private array $choices = [];
    protected string $label;

    public function __construct(string $name, string $label, array $choices, bool $required = false, string $defaultValue = '')
    {
        parent::__construct($name, $required, $defaultValue);
        $this->label = $label;
        $this->type = 'radiobutton';
        $this->choices = $choices;
    }

    public function render(): string
    {
        $output = '<fieldset>';
        $output .= '<legend>' . $this->label . '</legend>';

        foreach ($this->choices as $choice) {
            $output .= '<label>';
            $output .= sprintf('<input type="radio" name="%s" value="%s">', $this->name, $choice);
            $output .= $choice;
            $output .= '</label><br>';
        }

        $output .= '</fieldset>';
        return $output;
    }
}

?>
