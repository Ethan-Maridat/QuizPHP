<?php
namespace templates;

require_once __DIR__ . '/../../Classes/Autoloader.php';

use \Classes\Autoloader;

Autoloader::register();

require __DIR__ . '/../../db/php/DB_connection.php';
require __DIR__ . '/../../db/php/DBClasses/QuestionDB.php';
require __DIR__ . '/../../db/php/DBClasses/QuizzDB.php';
require __DIR__ . '/../../ Classes/User/User.php';
require __DIR__ . '/../../db/php/DBClasses/UserDB.php';


use db\php\DBClasses\UserDB;

$__USER__ = new UserDB($cnx);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz - Inscription</title>
<body class="background-filter">
    <div class="content">
        <form action="/ Query/inscription-bd.php" method="POST">
            <div class="form">
            <a href="login.php">
                Retour
            </a>
                <div>
                    <label for="pseudo">Pseudo</label>
                    <input placeholder="" type="text" id="pseudo" name="pseudo" required pattern="[A-Za-z0-9]{6,}" title="Le pseudo doit avoir au moins 6 caractères et ne doit pas contenir de caractères spéciaux.">
                </div>

                <div>
                    <label for="password">Mot de passe</label>
                    <input placeholder="" type="password" class="input" id="password" name="password" required>
                    <div class="cut"></div>
                </div>

                <button class="submit" type="submit">S'inscrire</button>
            </div>
        </form>
    </div>
</body>
</html>

