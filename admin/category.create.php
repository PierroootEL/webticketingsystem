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

    if (isset($_POST['valid_change'])){
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $active = htmlspecialchars($_POST['active']);
            if (!empty($name)){
                if (!empty($active)){
                    $sql_create_cat = "INSERT INTO ticket_cat (name, description, active) VALUES (:name, :description, :active)";

                    $stmt_create_cat = $pdo->prepare($sql_create_cat);

                    $stmt_create_cat->bindValue(':name', $name);
                    $stmt_create_cat->bindValue(':description', $description);
                    $stmt_create_cat->bindValue(':active', $active);

                    $result_create_cat = $stmt_create_cat->execute();

                    if ($result_create_cat){
                        $_SESSION['info'] = "Catégorie créée";
                    }else{
                        $_SESSION['info'] = "Erreur lors de la création";
                    }
                }else{
                    $_SESSION['info'] = "Merci d'activer OU non ( 1 ou 2 )";
                }
            }else{
                $_SESSION['info'] = "Merci de renseigner un titre";
            }
    }

?>
<html>
<head>
    <title>Créer une catégorie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta lang="fr-FR">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/form.css">
</head>
<body>
<div class="testbox">
    <form action="category.create.php" method="post">
        <div class="item">
            <p>Nom de la catégorie</p>
            <div class="name-item">
                <input type="text" name="name">
            </div>
        </div>
        <div class="item">
            <p>Description</p>
            <div class="name-item">
                <input type="text" name="description">
            </div>
        </div>
        <div class="item">
            <p>Active</p>
            <div class="name-item">
                <input type="text" name="active">
            </div>
        </div>
        <center><a style="color: red; text-decoration: underline"><?php if (!empty($_SESSION['info'])){ echo $_SESSION['info']; } ?></a></center>
        <div class="btn-block">
            <input type="submit" name="valid_change" value="Valider la création">
        </div>
        <center><a href="category.php" style="color: black;">Revenir à la liste des catégories</a></center>
    </form>
</div>
</body>
</html>