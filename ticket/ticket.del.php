<?php

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    require '../assets/require/header.php';

    require '../assets/require/functions.php';

    session_start();

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true) {
        $_SESSION['error'] = "Vous n'avez pas l'autorisation de vous rendre sur cette page !";
        header('Location: ../u/profile.php');
    }

    send_log_walk();

    // Récupération de l'ID dans l'URL

    $ticket_id = $_GET['id'];

    // On vérifie que la personne ne modifie pas l'URL pour supprimer d'autres tickets que les siens

    $actual_username = $_SESSION['username'];

    $sql_check = "SELECT * FROM ticket WHERE id = :id";

    $stmt_check = $pdo->prepare($sql_check);

    $stmt_check->bindValue(':id', $ticket_id);

    $stmt_check->execute();

    $result_check = $stmt_check->fetchAll(PDO::FETCH_ASSOC);

    if ($result_check['username'] !== $actual_username){
        $_SESSION['info'] = "Lol CHECH";
        header('Location: ticket.see.php');
    }

    // Requete de suppresion du ticket en question

    $sql_del_ticket = "DELETE FROM ticket WHERE id = :ticket_id";

    $stmt_del_ticket = $pdo->prepare($sql_del_ticket);

    $stmt_del_ticket->bindValue(':ticket_id', $ticket_id);

    $result_del_ticket = $stmt_del_ticket->execute();

    if ($result_del_ticket){
        $_SESSION['info'] = "Ticket supprimé avec succès";
    }else{
        $_SESSION['info'] = "Ticket non supprimé";
    }

    header('Location: ticket.see.php');

?>