<?php

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    include 'assets/header.php';

    session_start();

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true || $_SESSION['perm'] == 0){
        $_SESSION['error'] = "Vous n'avez pas l'autorisation de vous rendre sur cette page !";
        header('Location: ../u/profile.php');
    }


     $cat_id = $_GET['id'];

    $_SESSION['cat_id'] = $cat_id;

    $sql_get_cat = "SELECT * FROM ticket_cat WHERE id = :id";

    $stmt_get_cat = $pdo->prepare($sql_get_cat);

    $stmt_get_cat->bindValue(':id', $cat_id);

    $stmt_get_cat->execute();

    $get_cat = $stmt_get_cat->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['valid_change'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $active = $_POST['active'];

            if (!empty($name)){
                if (!empty($active)){
                    if (empty($description)){
                        $description = $get_cat['description'];

                        $sql_update_cat = "UPDATE ticket_cat SET name = :name, description = :description, active = :active WHERE id = :id";

                        $stmt_update_cat = $pdo->prepare($sql_update_cat);
                        $stmt_update_cat->bindValue(':name', $name);
                        $stmt_update_cat->bindValue(':description', $description);
                        $stmt_update_cat->bindValue(':active', $active);
                        $stmt_update_cat->bindValue(':id', $cat_id);

                        $result_update_cat = $stmt_update_cat->execute();

                        if ($result_update_cat){
                            $_SESSION['info'] = "Les changements ont bien été pris en compte";
                        }else{
                            $_SESSION['info'] = "Les changements n'ont pas été pris en compte, ERREUR !";
                        }
                    }
                }else{
                    $_SESSION['active'] = "Merci d'activer OU non la catégorie ( 1 ou 2 )";
                }
            }else{
                $_SESSION['info'] = "Merci de remplir un nom de catégorie";
            }
    }

    // Inclure les logs de changements

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
    <form action="category.form.php?id=<?php  echo $_SESSION['cat_id']; ?>" method="post">
        <div class="item">
            <p>Nom de la catégorie</p>
            <div class="name-item">
                <input type="text" name="name" placeholder="Actuellement : <?php if (!empty($get_cat['name'])){ echo $get_cat['name']; }else{ echo "Non renseigné"; } ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Description</p>
            <div class="name-item">
                <input type="text" name="description" placeholder="Actuellement : <?php if (!empty($get_cat['description'])){ echo $get_cat['description']; }else{ echo "Non renseigné"; } ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Active</p>
            <div class="name-item">
                <input type="text" name="active" placeholder="Actuellement : <?php echo $get_cat['active']; ?>"/>
            </div>
        </div>
        <center><a class="item" style="color: red; text-decoration: underline"><?php if (!empty($_SESSION['info'])){ print_r($_SESSION['info']); } ?></a></center>
        <div class="btn-block">
            <input type="submit" name="valid_change" value="Valider les changements">
        </div>
        <center><a class="item" id="info" style="color: red; text-decoration: underline;" href="category.php">Revenir à la liste des catégories</a></center>
    </form>
</div>
</body>
</html>