<?php


session_start();

// Lib de mot de passe + connexion bdd

require '../lib/password.php';

require '../database/connect.php';

// Récupération du register

if(isset($_POST['register'])){


    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $pass_confirm = !empty($_POST['password_confirm']) ? trim($_POST['password_confirm']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

    // Vérification que les deux mots de passes correspondent.

    if ($pass !== $pass_confirm){
        $error = "Merci de renseigner les mêmes mots de passes !";
        die();
    }

    // Vérification si le nom d'utilisateur existe deja

    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);


    $stmt->bindValue(':username', $username);


    $stmt->execute();


    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if($row['num'] > 0){
        $error = "Nom d'utilisateur déjà pris.";
        die();
    }

    // Hashage du mot de passe

    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

    // Création du compte

    $sql = "INSERT INTO users (prenom, nom, username, password, email, phone) VALUES (:prenom, :nom, :username, :password, :email, :phone)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':prenom', '0');
    $stmt->bindValue(':nom', '0');
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':phone', '0');

    $result = $stmt->execute();

    if($result){
        $sucess = "Compte créé";
    }else{
        $error = "Erreur lors de la création de compte.";
    }

    // Fin

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Créer son compte</title>
    <link rel="stylesheet" type="text/css" href="assets/u.css">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <h2 class="active"> Créer son compte </h2>

<form action="register.php" method="post">
    <input type="text" id="login" class="fadeIn second" name="username" placeholder="Nom d'utilisateur">
    <input type="text" id="login" class="fadeIn second" name="email" placeholder="E-mail">
    <input type="text" id="password" class="fadeIn second" name="password" placeholder="Mot de passe">
    <input type="text" id="password" class="fadeIn second" name="password_confirm" placeholder="Confirmation mot de passe">
    <input type="submit" class="fadeIn fourth" name="register" value="Créer son compte">
</form>
        <div id="formFooter">
            <?php if (!empty($sucess)){
               ?>  <a class="underlineHover">Compte créé</a>"; <?php
            }elseif(!empty($error)){
               ?>  <a class="underlineHover">Erreur lors de la création</a>"; <?php
            }else{
                echo "";
            } ?>
            <a class="underlineHover" href="login.php">Connectez-vous dès maintenant</a>
            <a class="underlineHover" href="changepwd.php">Mot de passe oublié ?</a>
        </div>

    </div>
</div>
</body>
</html>