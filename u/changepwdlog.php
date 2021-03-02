<?php

    session_start();

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true){
        header('Location: login.php');
    }

    require '../lib/password.php';

    require '../database/connect.php';

    if (isset($_POST['changepwd'])){
        $new_password = $_POST['new_password'];
        $new_password_confirm = $_POST['new_password_confirm'];
        if ($new_password !== $new_password_confirm){
            $_SESSION['error'] = "Les mots de passes ne correspondent pas";
            header('Location: login.php');
        }

        $password = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

        $sql = "UPDATE users SET password = :password";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':password', $password);

        $result = $stmt->execute();

        if ($result){
            $_SESSION['error'] = "Mots de passes changés";
        }else{
            $_SESSION['error'] = "Erreur lors du changement de mot de passe";
        }
    }



?>
<html>
<head>
    <title>Changer votre mot de passe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="fr-FR">
    <link rel="stylesheet" type="text/css" href="assets/u.css">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">

        <h2 class="active">Chnager votre mot de passe</h2>

        <form action="login.php" method="post">
            <input type="text" id="password" class="fadeIn third" name="new_password" placeholder="Nouveau mot de passe">
            <input type="text" id="password" class="fadeIn third" name="new_password_confirm" placeholder="Confirmation nouveau mot de passe">
            <input type="submit" class="fadeIn fourth" name="changepwd" value="Se connecter">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="register.php">Créer votre compte dès maintenant</a>
            <a class="underlineHover" href="changepwd.php">Mot de passe oublié ?</a>
        </div>

    </div>
</div>
</body>
</html>
