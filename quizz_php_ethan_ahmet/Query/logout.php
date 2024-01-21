<?php
    namespace Query;
    session_start();
    session_destroy();
    header("Location: /templates/login.php");
    // une fois déconnecté on se place sur la page de login
    exit;
?>