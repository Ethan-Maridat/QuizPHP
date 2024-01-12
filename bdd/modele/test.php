<?php

require_once 'bd/connect.php'; // Ajustez le chemin en fonction de votre structure

require_once 'bd/Utilisateur.php';
require_once 'bd/quizz.php';

$db = new \bd\Database();
$db->connect();

$utilisateur = new \bd\Utilisateur($db);
$utilisateurs = $utilisateur->getAllUsers();
print_r($utilisateurs);

$quizz = new \bd\Quizz($db);
$quizzList = $quizz->getAllQuizz();
print_r($quizzList);
?>
