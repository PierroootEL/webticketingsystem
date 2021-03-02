<?php

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    include 'assets/header.php';

    require '../lib/password.php';

    session_start();

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true || $_SESSION['perm'] == 0){
        $_SESSION['error'] = "Vous n'avez pas l'autorisation de vous rendre sur cette page !";
        header('Location: ../u/profile.php');
    }

    send_log_walk();

    // Selection des données utilisateurs

    $user_id = $_GET['id'];

    $_SESSION['user_id'] = $user_id;

    $sql_get_user = "SELECT * FROM users WHERE id = :user_id";

    $stmt_get_user = $pdo->prepare($sql_get_user);

    $stmt_get_user->bindValue(':user_id', $user_id);

    $stmt_get_user->execute();

    $get_user = $stmt_get_user->fetch(PDO::FETCH_ASSOC);

    // Vérification que l'ID demandé existe


    // Récupération des changements

    if (isset($_POST['valid_change'])){
        $prenom =  $_POST['prenom'];
        $nom = $_POST['nom'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $perm = $_POST['perm'];
        $additionnal = htmlspecialchars($_POST['additional']);



            if (empty($additionnal)){
                $_SESSION['info'] = "Merci de remplir les notes de log !";
            }else {
                if (empty($prenom)) {
                    $prenom = $get_user['prenom'];
                }

                if (empty($nom)) {
                    $nom = $get_user['nom'];
                }

                if (empty($username)) {
                    $username = $get_user['username'];
                }

                if (empty($password)) {
                    $password = $get_user['password'];
                }else{
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
                }

                if (empty($email)) {
                    $email = $get_user['email'];
                }

                if (empty($perm)) {
                    $perm = $get_user['perm'];
                }

                $sql_update_user = "UPDATE users SET prenom = :prenom, nom = :nom, username = :username, password = :password, email = :email, phone = :phone, perm = :perm WHERE id = :id";

                $update_user = $pdo->prepare($sql_update_user);

                $update_user->bindValue(':id', $user_id);
                $update_user->bindValue(':prenom', $prenom);
                $update_user->bindValue(':nom', $nom);
                $update_user->bindValue(':username', $username);
                $update_user->bindValue(':password', $passwordHash);
                $update_user->bindValue(':email', $email);
                $update_user->bindValue(':phone', $phone);
                $update_user->bindValue(':perm', $perm);

                $result_update_user = $update_user->execute();

                if ($result_update_user) {
                    $_SESSION['info'] = "Changements utilisateurs validé";
                    header('Location: users.form.php?id=' . $_SESSION['user_id']);
                } else {
                    $_SESSION['info'] = "Erreur lors du changement";
                }

                // Envoi des logs de changements

                $sql_update_user_log = "INSERT INTO update_users_log (username, note) VALUES (:username, :note)";

                $update_user_log = $pdo->prepare($sql_update_user_log);

                $update_user_log->bindValue(':username', $username);
                $update_user_log->bindValue(':note', $additionnal);

                $update_user_log->execute();

            }

    }

?>
<html>
<head>
    <title>Modifier l'utilisateur l'utilisateur</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="fr-FR">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/form.css">
</head>
<body>
<div class="testbox">
    <form action="users.form.php?id=<?php echo $_SESSION['user_id']; ?>" method="post">
        <div class="item">
            <p>Prénom</p>
            <div class="name-item">
                <input type="text" name="prenom" placeholder="Actuellement : <?php if (!empty($get_user['prenom'])){ echo $get_user['prenom']; }else{ echo "Non renseigné"; } ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Nom</p>
            <div class="name-item">
                <input type="text" name="nom" placeholder="Actuellement : <?php if (!empty($get_user['nom'])){ echo $get_user['nom']; }else{ echo "Non renseigné"; } ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Nom d'utilisateur</p>
            <div class="name-item">
                <input type="text" name="username" placeholder="Actuellement : <?php echo $get_user['username']; ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Email</p>
            <input type="email" name="email" placeholder="Actuellement : <?php if (!empty($get_user['email'])){ echo $get_user['email']; }else{ echo "Non renseigné"; } ?>"/>
        </div>
        <div class="item">
            <p>Téléphone</p>
            <input type="text" name="phone" placeholder="Actuellement : <?php if (!empty($get_user['phone'])){ echo $get_user['phone']; }else{ echo "Non renseigné"; } ?>"/>
        </div>
        <div class="item">
            <p>Mot de passe</p>
            <input type="text" name="password">
        </div>
        <div class="item">
            <p>Permissions utilisateur</p>
            <input type="number" name="perm" placeholder="Actuellement : <?php if (!empty($get_user['perm'])){ echo $get_user['perm']; }else{ echo "Non renseigné"; } ?>">
        </div>
        <div class="item">
            <p>Note pour log</p>
            <textarea rows="3" name="additional"></textarea>
        </div>
        <center><a class="item" style="color: red; text-decoration: underline"><?php if (!empty($_SESSION['info'])){ print_r($_SESSION['info']); } ?></a></center>
        <div class="btn-block">
            <input type="submit" name="valid_change" value="Valider les changements">
        </div>
    </form>
</div>
</body>
</html>
