<?php
    namespace templates;

    session_start();

    require_once __DIR__ . '/../Classes/Autoloader.php';
    require_once __DIR__ . '/../Classes/db/php/DB_connection.php';
    use \Classes\Autoloader;
    Autoloader::register();

    use Questions\QuizHandler;
    use db\php\DBClasses\QuestionDB;
    use db\php\DBClasses\QuizzDB;


    $__QUESTION__ = new QuestionDB($cnx);
    $__QUIZZ__ = new QuizzDB($cnx);
    $questions = $__QUIZZ__->getAllQuizz();

    $serializedUser = $_SESSION['user'];
    $loggedInUser = unserialize($serializedUser);
    echo htmlspecialchars($loggedInUser->getPseudo()) . '</p>';    
?>
    <a href="/Query/logout.php">Se déconnecter</a>
    <div class="scrollable-content">
        <div class="content-quizz-selection">
            <?php
            foreach ($questions as $q) {
                $score = $__QUIZZ__->getScoreOnQuizz(htmlspecialchars($loggedInUser->getPseudo()), $q->getId());
                echo <<<EOL
                    <div class="quizz-selection">
                        <div class="quizz-selection-title">
                            <h2>{$q->getName()}</h2>
                        </div>
                        <div class="quizz-selection-description">
                            <p>{$q->getDescription()}</p>
                        </div>
                        <p>Score: {$score}</p>
                        <div class="quizz-selection-button">
                    EOL;                
                if ($score >=0) {
                    echo '<p>Terminé</p>';
                } else {
                    echo "<a href='quizz.php?id={$q->getId()}'>Jouer</a>";
                }
            
                echo <<<EOL
                        </div>
                    </div>
                EOL;
            }
            ?>
        </div>
    </div>