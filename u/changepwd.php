<?php

    session_start();

    /* if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true){
        header('Location: login.php');
    } */

    require '../lib/password.php';

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    send_log_walk();


    if (!empty($_POST['changepwd'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $new_password_confirm = $_POST['new_password_confirm'];

        if ($new_password !== $new_password_confirm){
            $error = "Les mots de passes ne correspondent pas !";
            die();
        }

        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['num'] < 1){
            $error = "Aucun nom d'utilisateur ne correspond !";
            die();
        }else{
            $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':email', $email);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['num'] < 1){
                $error = "Aucun email ne correspond !";
                die();
            }else{
                $passwordHash = password_hash($new_password, PASSWORD_BCRYPT, array("cost" => 12));

                $sql = "UPDATE users SET password = :password WHERE username = :username";

                $stmt = $pdo->prepare($sql);

                $stmt->bindValue(':password', $passwordHash);
                $stmt->bindValue(':username', $username);

                $result = $stmt->execute();

                if ($result){
                    $sucess = "Mot de passe changé";
                    header('Location: login.php');
                }else{
                    $error = "Erreur lors du changement de mot de passe";
                    die();
                }

            }
        }



    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Changer son mot de passe</title>
    <link rel="stylesheet" type="text/css" href="assets/u.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active">Changer de mot de passe</h2>
        <!-- <h2 class="inactive underlineHover">Sign Up </h2>

         Icon
        <div class="fadeIn first">
            <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
        </div> -->

        <!-- Login Form -->
        <form action="changepwd.php" method="post">
            <input type="text" id="username" class="fadeIn second" name="username" placeholder="Nom d'utilisateur associé">
            <input type="text" id="email" class="fadeIn second" name="email" placeholder="Email associé">
            <input type="text" id="password" class="fadeIn third" name="new_password" placeholder="Nouveau mot de passe">
            <input type="text" id="password" class="fadeIn fourth" name="new_password_confirm" placeholder="Confirmation nouveau mot de passe">
            <input type="submit" class="fadeIn fourth" name="changepwd" value="Valider le changement">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="register.php">Créer votre compte dès maintenant</a><br>
            <a class="underlineHover" href="login.php">Se connecter</a>
        </div>

    </div>
</div>
</body>

