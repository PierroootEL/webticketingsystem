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

    // Récupération des catégories pour les tickets

    $sql_category = "SELECT * FROM ticket_cat";

    $stmt_category = $pdo->prepare($sql_category);

    $stmt_category->execute();

    $result_category = $stmt_category->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des infos de la création du ticket

    if (isset($_POST['valid_change'])){
        $name = htmlspecialchars($_POST['name']);
        $category = htmlspecialchars($_POST['category-choice']);
        $description = htmlspecialchars($_POST['description']);
            if (!empty($name)){
                if (!empty($category)){
                    if (!empty($description)){
                                $sql_send_ticket = "INSERT INTO ticket (name, category, description) VALUES (:name, :category, :description, //MARCHE PAS CETTE PUTE :current_user)";

                                $stmt_send_ticket = $pdo->prepare($sql_send_ticket);

                                $stmt_send_ticket->bindValue(':name', $name);
                                $stmt_send_ticket->bindValue(':category', $category);
                                $stmt_send_ticket->bindValue(':description', $description);
                                $stmt_send_ticket->bindValue(':current_user', $_SESSION['username']);

                                $result_send_ticket = $stmt_send_ticket->execute();

                                if ($result_send_ticket){
                                    $_SESSION['info'] = "Ticket créé";
                                }else{
                                    $_SESSION['info'] = "Erreur lors de la création, merci de réessayer !";
                                }
                            }else{
                        $_SESSION['info'] = "Merci de renseigner une description";
                    }
                    }else{
                    $_SESSION['info'] = "Merci de remplir une catégorie";
                }
            }else{
                $_SESSION['info'] = "Merci de remplir un titre";
            }
    }

?>
<html>
<head>
    <title>Créer votre ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale">
    <meta charset="utf-8">
    <meta lang="fr-FR">
    <link rel="stylesheet" type="text/css" href="../admin/assets/form.css">
    <link rel="stylesheet" type="text/css" href="assets/ticket.css">
</head>
<body>
<div class="testbox">
    <form action="ticket.create.php" method="post">
        <div class="item">
            <p>Titre</p>
            <div class="name-item">
                <input type="text" name="name">
            </div>
        </div>
        <div class="item">
            <p>Catégorie</p>
            <div class="name-item">
                <select id="category" name="category-choice">
                    <?php foreach($result_category as $category) {?>
                    <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="item">
            <p>Description</p>
            <div class="name-item">
                <input type="text" name="description">
            </div>
        </div>
        <center><a class="item" style="color: red; text-decoration: underline"><?php if (!empty($_SESSION['info'])){ print_r($_SESSION['info']); } ?></a></center>
        <div class="btn-block">
            <input type="submit" name="valid_change" value="Créer le ticket">
        </div>
        <center><a class="item" id="info" style="color: red; text-decoration: underline;" href="category.php">Revenir à la liste des catégories</a></center>
    </form>
</div>
</body>
</html>
