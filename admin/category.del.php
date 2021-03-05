<?php

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    include 'assets/header.php';

    session_start();

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true || $_SESSION['perm'] == 0){
        $_SESSION['error'] = "Vous n'avez pas l'autorisation de vous rendre sur cette page !";
        header('Location: ../u/profile.php');
    }

    send_log_walk();

    $id_to_delete = $_GET['id'];

    $sql_delete = "DELETE FROM ticket_cat WHERE id = :id";

    $stmt_delete = $pdo->prepare($sql_delete);

    $stmt_delete->bindValue(':id',$id_to_delete);

    $stmt_delete->execute();

    header('Location: category.php');
?>