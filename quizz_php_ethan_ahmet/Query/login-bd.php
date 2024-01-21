<?php

namespace Query;

use Classes\Autoloader;
use db\php\DB_connection;
use User\User;
use db\php\DBClasses\UserDB;

session_start();

require_once __DIR__ . '/../Classes/Autoloader.php';
require_once __DIR__ . '/../Classes/db/php/DB_connection.php';

Autoloader::register();

$__USER__ = new UserDB($cnx);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["password"])) {
        $user = $_POST["user"];
        $motDePasse = $_POST["password"];
        if ($__USER__->userExists($user)) {
            if ($__USER__->checkPassword($user, $motDePasse)) { // si le mot de passe est correct
                $loggedInUser = $__USER__->getUserByPseudo($user); // on récupère l'utilisateur
                $serializedUser = serialize($loggedInUser); 

                $_SESSION['user'] = $serializedUser; // on le sérialize et on le met dans la session

                header("Location:/templates/index.php");
                // on afficher la page d'accueil contenant tout les quizz
                exit;
                
            } 
            else {
                header("Location:/templates/login.php");
                exit;
            }
        } 
        else {
            header("Location:/templates/login.php");
            exit;
        }
    }
}
?>
