<?php

namespace Query;

session_start();

require_once __DIR__ . '/../../Classes/Autoloader.php';

use \Classes\Autoloader;

Autoloader::register();

require __DIR__ . '/../../db/php/DB_connection.php';
require __DIR__ . '/../../ Classes/User/User.php';
require __DIR__ . '/../../db/php/DBClasses/UserDB.php';

use db\php\DBClasses\UserDB;
use  Classes\User\User;

$__USER__ = new UserDB($cnx);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["password"])) {
        $user = $_POST["user"];
        $motDePasse = $_POST["password"];
        if ($__USER__->userExists($user)) {
            if ($__USER__->checkPassword($user, $motDePasse)) {
                $loggedInUser = $__USER__->getUserByPseudo($user);
                $serializedUser = serialize($loggedInUser);

                $_SESSION['user'] = $serializedUser;

                header("Location: / templates/index.php");
                exit;
                
            } else {
                header("Location: / templates/login.php");
                exit;
            }
        } else {
            header("Location: / templates/login.php");
            exit;
        }
    }
}
?>

