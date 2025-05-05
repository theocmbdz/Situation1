<?php
    session_start();

    $_SESSION = array();
    session_destroy();

    // Rediriger vers la page d'accueil

    header("Location: ../routing/index.php");
    exit();
?>