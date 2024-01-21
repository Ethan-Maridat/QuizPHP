<?php
namespace db\php;

use mysqli;

// nous nous utilisons une bd mysql donc nous avons besoin de ces informations
// pour se connecter à la bd
$servername = "localhost";
$username = "temha";
$password = "temha1011";
$database = "QuizzPHP";


// Créer une connexion
$cnx = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($cnx->connect_error) {
    die("La connexion a échoué : " . $cnx->connect_error);
}

?>