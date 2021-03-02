<?php

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    require 'assets/header.php';

    session_start();

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true || $_SESSION['perm'] == 0) {
        $_SESSION['error'] = "Vous n'avez pas l'autorisation de vous rendre sur cette page !";
        header('Location: ../u/profile.php');
    }

?>