<?php

//home.php

/**
 * Start the session.
 */
session_start();

require '../database/connect.php';

/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

// Récupération des tickets ouverts par l'utilisateurs

 $sql_get_ticket = "SELECT * FROM ticket WHERE username = :username";

$stmt_get_ticket = $pdo->prepare($sql_get_ticket);

$stmt_get_ticket->bindValue(':username', $_SESSION['username']);

$stmt_get_ticket->execute();

$count_get_ticket = $stmt_get_ticket->rowCount();

include '../assets/require/header.php';

/**
 * Print out something that only logged in users can see.
 */

?>

<html>
<head>
    <title>Bienvenue, <?php echo $_SESSION['prenom']; ?></title>
    <link rel="stylesheet" type="text/css" href="assets/profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="fr-FR">
</head>
<body>
<h2 class="welcome-title">Bienvenue sur votre profil, <?php echo $_SESSION['username'] ?> !</h2>
<section class="changepwd">
    <a href="changepwd.php">Cliquez ici si vous souhaitez changer de mot de passe.</a>
</section>
<section class="open-ticket">
    <a>Vous avez <?php echo $count_get_ticket; ?> ticket d'ouvert</a><br>
    <a href="../ticket/ticket.see.php">Accéder à vos tickets</a>
</section>
</body>
</html>
