<?php

    session_start();

    require 'assets/header.php';

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true || $_SESSION['perm'] == 0){
        $_SESSION['error'] = "Vous n'avez pas l'autorisation de vous rendre sur cette page !";
            header('Location: ../u/profile.php');
    }

        send_log_walk();

        //Récupération du nombre de comptes utilisateurs créés

        $sql_users = "SELECT * FROM users";

        $stmt_users = $pdo->prepare($sql_users);

        $stmt_users->execute();

        $count_users = $stmt_users->rowCount();

        //Récupération du nombre de catégories créés

        $sql_cat = "SELECT * FROM ticket_cat";

        $stmt_cat = $pdo->prepare($sql_cat);

        $stmt_cat->execute();

        $count_cat = $stmt_cat->rowCount();



?>
<html>
<head>
    <title>Page d'administration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="fr-FR">
    <link rel="stylesheet" type="text/css" href="assets/index.css">
</head>
<body>
    <div class="container">
        <div class="user-number">
            <div class="border-count">
                <a>Il y a <b><?php print_r($count_users); ?></b> comptes utilisateurs créé(s)</a><br><br>
            <a href="users.php">Accéder au management des utilisateurs</a>
            </div>
        </div>
        <div class="category-number">
            <div class="border-count">
            <a>Il y a <b><?php print_r($count_cat); ?></b> catégories de créé(s)</a><br><br>
            <a href="category.php">Accéder au management des catégories</a>
            </div>
        </div>
    </div>
</body>
</html>
