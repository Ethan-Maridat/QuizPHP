<?php
namespace Query;

require_once __DIR__ . '/../../ Classes/Autoloader.php';

use \Classes\Autoloader;

Autoloader::register();

require __DIR__ . '/../../db/php/DB_connection.php';
require __DIR__ . '/../../ Classes/User/User.php';
require __DIR__ . '/../../db/php/DBClasses/UserDB.php';


use db\php\DBClasses\UserDB;
use  Classes\User\User;

$__USER__ = new UserDB($cnx);

?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
        $pseudo = $_POST["pseudo"];
        $motDePasse = $_POST["password"];
        if ($__USER__->userExists($pseudo)) {
            header("Location: register.php");
            exit();
        } else {
            $__USER__->addUser(new User($pseudo, $motDePasse));
            header("Location: / templates/login.php");
            exit(); 
        }
    }
}
?>
