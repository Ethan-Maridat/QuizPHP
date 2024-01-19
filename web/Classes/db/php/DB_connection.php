<?php
namespace db\php;

use mysqli;

$servername = "servinfo-maria";
$username = "maridat";
$password = "maridat";
$database = "DBmaridat";



// Créer une connexion
$cnx = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($cnx->connect_error) {
    die("La connexion a échoué : " . $cnx->connect_error);
}

?>