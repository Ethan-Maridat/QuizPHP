<?php
    namespace Query;
    session_start();
    session_destroy();
    header("Location: /templates/login.php");
    exit;
?>