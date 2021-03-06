<?php

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    require 'assets/header.php';

    session_start();

    if (empty($_SESSION['valid_user_connect']) || $_SESSION['valid_user_connect'] !== true || $_SESSION['perm'] == 0) {
        $_SESSION['error'] = "Vous n'avez pas l'autorisation de vous rendre sur cette page !";
        header('Location: ../u/profile.php');
    }

    send_log_walk();

    $sql_cats = "SELECT * FROM ticket_cat";

    $stmt_cats = $pdo->prepare($sql_cats);

    $stmt_cats->execute();

    $cats = $stmt_cats->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <title>Administrer les catégories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta lang="fr-FR">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
<div class="container">
    <section>
        <h1>Liste de toutes les catégories</h1>
        <center><a href="category.create.php" style="color: black; font-size:19px;">Créer une catégorie</a></center>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Active</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <?php  foreach($cats as $cat){ ?>
                    <tr>
                        <td><a href="category.form.php?id=<?php echo $cat['id']; ?>"><?php if (empty($cat['name'])){ echo "Non renseigné"; }else{ echo $cat['name']; } ?></a></td>
                        <td><a><?php if (empty($cat['description'])){ echo "Non renseigné"; }else{ echo $cat['description']; } ?></a></td>
                        <td><a><?php if (empty($cat['active'])){ echo "Non renseigné"; }else{echo $cat['active']; } ?></a></td>
                        <td><a href="category.del.php?id=<?php echo $cat['id'] ?>">Oui</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
</body>
<script>
    // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right':scrollWidth});
    }).resize();
</script>
</html>