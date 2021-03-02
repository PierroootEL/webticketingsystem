<?php

    session_start();

    /* if ($_SESSION['token'] !== $_SESSION['token_verif'] || empty($_SESSION['token'])) {
        header('Location: ../login.php');
    } */

    include_once('../assets/require/header.php');
    require_once('../database/db_connect.php');
 
?>

<html>
    <head>
        <title>Accueil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0, width=device-width, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" type="text/css" href="../assets/core/index.css">
    </head>
    <body>
        <div class="btn btn-warning" class="welcome">
            <h4>Bienvenue <?php if(isset($_SESSION['username'])) { echo","; PHP_EOL; print_r($_SESSION['username']); } ?></h4>
        </div>
        

    </body>
</html>