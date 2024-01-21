<?php
namespace Query;

require_once __DIR__ . '/../Classes/Autoloader.php'; 
require_once __DIR__ . '/../Classes/db/php/DB_connection.php';

use Classes\Autoloader; 
use db\php\DB_connection;
use db\php\DBClasses\UserDB;

Autoloader::register();

use User\User;

$__USER__ = new UserDB($cnx);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
        $pseudo = $_POST["pseudo"];
        $motDePasse = $_POST["password"];
        if ($__USER__->userExists($pseudo)) {
            echo "L'utilisateur existe déjà."; // Message d'erreur
        } else {
            if (class_exists('\User\User')) {
                $__USER__->addUser(new User($pseudo, $motDePasse)); // On ajoute l'utilisateur
                header("Location: /templates/login.php");
                exit(); 
            } else {
                echo "La classe User n'a pas été trouvée."; // Message d'erreur
            }
        }
    }
}
?>
