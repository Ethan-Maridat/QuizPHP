<?php
namespace templates;
use Classes\Autoloader;

require_once __DIR__ . '/../Classes/Autoloader.php';
Autoloader::register();


use db\php\DB_connection;
use db\php\DBClasses\QuestionDB;
use db\php\DBClasses\QuizzDB;
use User\User;
use db\php\DBClasses\UserDB;


$__USER__ = new UserDB($cnx);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Quiz - Connexion</title>
    <link rel="icon" href="../static/images/icon/flavicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="../static/styles/login.css">
    <link rel="stylesheet" href="../static/styles/body.css">
</head>
<body class="background-filter">
    <div class="content">
        <form action="/ Query/login-bd.php" method="POST">
            <p id="heading">Connexion</p>
            <div class="field">
            <input autocomplete="off" placeholder="Username" class="input-field" type="text" name="user" required>
            </div>
            <div class="field">
            <input placeholder="Mot de passe" class="input-field" type="password" name="password" required>
            </div>
            <div class="btn">
            <button class="button1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Se connecter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </div>
            <p class="sinscrire">S'inscrire <a href="register.php">ici</a></p>
        </form>
    </div>
</body>
</html>
