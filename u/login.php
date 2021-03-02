<?php

//login.php


session_start();


require '../lib/password.php';


require '../database/connect.php';

require '../core/functions/functions_logs.php';


if(isset($_POST['login'])){


    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;


    $sql = "SELECT id, prenom, nom, username, password, email, phone, perm FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(':username', $username);


    $stmt->execute();


    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user === false){
        die('Incorrect username / password combination!');
    } else{

        $validPassword = password_verify($passwordAttempt, $user['password']);

        if($validPassword){

            session_start();

            $_SESSION['logged_in'] = date("d-m-Y h:i:sa");
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['perm'] = $user['perm'];
            $_SESSION['valid_user_connect'] = true;

            send_log_login();

            header('Location: profile.php');
            exit;

        } else {
            die('Incorrect username / password combination!');
        }
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/u.css">
    <meta name="viewport" content="width=device-width">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active">Se connecter</h2>
        <!-- <h2 class="inactive underlineHover">Sign Up </h2>

         Icon
        <div class="fadeIn first">
            <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
        </div> -->

        <!-- Login Form -->
        <form action="login.php" method="post">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="Nom d'utilisateur">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="Mot de passe">
            <input type="submit" class="fadeIn fourth" name="login" value="Se connecter">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <?php if (!empty($_SESSION['error'])){ ?>
            <a><?php echo $_SESSION['error'] ?></a>
            <?php }  ?>
            <a class="underlineHover" href="register.php">Créer votre compte dès maintenant</a>
            <a class="underlineHover" href="changepwd.php">Mot de passe oublié ?</a>
        </div>

    </div>
</div>
</body>
</html>