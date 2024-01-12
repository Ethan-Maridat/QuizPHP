<?php

namespace Form\Type;
use Form\GenericFormElement;
use Exception;

class QuestionFactory
{
    public static function createQuestion(string $type, string $name, string $label, array $options = []): GenericFormElement
    {
        switch ($type) {
            case 'radiobutton':
                return new RadioButtonQuestion($name, $label, $options['choices'], $options['required'], $options['defaultValue']);
            case 'checkbox':
                return new CheckboxQuestion($name, $label, $options['choices'], $options['required'], $options['defaultValue']);
            case 'textfield':
                return new TextFieldQuestion($name, $label, $options['required'], $options['defaultValue']);
            default:
                throw new Exception("Type de question inconnu : $type");
        }
    }
}

?>
