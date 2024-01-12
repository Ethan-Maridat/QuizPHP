<?php

namespace Form\Type;

use Form\GenericFormElement;

class TextFieldQuestion extends GenericFormElement
{

    protected string $label;
    public function __construct(string $name, string $label, bool $required = false, string $defaultValue = '')
    {
        parent::__construct($name, $required, $defaultValue);
        $this->label = $label;
        $this->type = 'textfield';
    }

    public function render(): string
    {
        $output = '<label>' . $this->label . '</label>';
        $output .= sprintf('<input type="text" name="%s" value="%s">', $this->name, $this->value);
        return $output;
    }
}

?>
