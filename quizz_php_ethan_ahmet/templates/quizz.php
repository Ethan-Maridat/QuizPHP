<?php
namespace templates;

session_start();


require_once __DIR__ . '/../Classes/Autoloader.php';
require_once __DIR__ . '/../Classes/db/php/DB_connection.php';

use \Classes\Autoloader;

Autoloader::register();

use Questions\QuizHandler;
use db\php\DB_connection;
use db\php\DBClasses\QuestionDB;
use db\php\DBClasses\QuizzDB;
use db\php\DBClasses\QuizzTermineDB;



$quizzTermineDB = new QuizzTermineDB($cnx);
$__QUESTION__ = new QuestionDB($cnx);
$__QUIZZ__ = new QuizzDB($cnx);
$quizz = $__QUIZZ__->getQuizzById($_GET['id']);
$questions = $quizz->getQuestions();

$quizHandler = new QuizHandler($questions, 'quizz.php?id=' . $_GET['id']);

?>

<!DOCTYPE html>
<html lang="fr" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz</title>
</head>

<body style="height:100%; margin:0;">
    <a href="index.php">Retour</a>
    <?php
    $serializedUser = $_SESSION['user'];
    $loggedInUser = unserialize($serializedUser);
    $quizzId = $_GET['id'];
    if (isset($_POST['submitQuiz'])) {
        $results = $quizHandler->processResults();
        $quizzTermineDB->insertQuizzTermine(htmlspecialchars($loggedInUser->getPseudo()), $quizzId, $results['scoreCorrect']);
        echo "<h1>Résultats</h1>";
        echo "<p>{$results['questionCorrect']}/{$results['questionTotal']}.</p>";
        echo "<p>Vous avez obtenu {$results['scoreCorrect']} points sur {$results['scoreTotal']}.</p>";
    } else {
        echo <<<EOL
            <div class="quizz-info">
                <div class="static-info">
                    <h1>{$quizz->getName()}</h1>
                    <p class="desc-quizz">{$quizz->getDescription()}</p>
                </div>
            </div>
            <div class="questions-content">
                <div class="quizz-questions">
                    <h1>Questions</h1>
                    {$quizHandler->renderForm()}
                </div>
            </div>  
            EOL;
    }
    ?>
</body>

</html>
