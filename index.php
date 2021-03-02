<?php

    session_start();

    /* if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true){
        header('Location: u/login.php');
    } */

    // Include header + connexion bdd

    include 'assets/require/header.php';

    include 'database/connect.php';

    include 'core/functions/functions_logs.php';

    // Appel à la function pour envoyer des logs.

    send_log_walk();


?>

<html>
<head>
    <title>Accueil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-witdh">
    <meta lang="fr-FR">
    <link rel="stylesheet" type="text/css" href="assets/core/index.css">
</head>
<body>

</body>
</html>
