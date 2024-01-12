<?php

require 'Classes/autoloader.php'; 
Autoloader::register();

use Form\Type\QuestionFactory;

// Charger le fichier JSON
$jsonData = file_get_contents('q.json');
$questionsData = json_decode($jsonData, true);

// Tableau pour stocker les instances de questions
$questions = [];

// Créer les questions à partir des données JSON
foreach ($questionsData as $questionData) {
    $question = QuestionFactory::createQuestion(
        $questionData['type'],
        $questionData['name'],
        $questionData['label'],
        [
            'choices' => $questionData['choices'] ?? [],
            'required' => $questionData['required'] ?? false,
            'defaultValue' => $questionData['defaultValue'] ?? ''
        ]
    );

    $questions[] = $question;
}

// Affichage des questions
foreach ($questions as $question) {
    echo $question;
}

?>
