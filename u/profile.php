<?php

//home.php

/**
 * Start the session.
 */
session_start();


/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

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
</body>
</html>
