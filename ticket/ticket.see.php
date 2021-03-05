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

    // On récupères les tickets que possède l'utilisateur

    $sql_get_user_tickets = "SELECT * FROM ticket WHERE username = :username";

    $stmt_get_user_tickets = $pdo->prepare($sql_get_user_tickets);

    $stmt_get_user_tickets->bindValue(':username', $_SESSION['username']);

    $stmt_get_user_tickets->execute();

    $result_get_user_tickets = $stmt_get_user_tickets->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <title>Administrer les catégories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta lang="fr-FR">
    <link rel="stylesheet" type="text/css" href="../admin/assets/style.css">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
<div class="container">
    <section>
        <h1>Liste de vos ticket(s)</h1>
        <center><a href="ticket.create.php" style="color: black; font-size:19px;">Créer un ticket</a></center>
        <a><?php if (!empty($_SESSION['info'])){ echo $_SESSION['info']; } ?></a>
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
                <?php  foreach($result_get_user_tickets as $user_ticket){ ?>
                    <tr>
                        <td><a href="category.form.php?id=<?php echo $user_ticket['id']; ?>"><?php if (empty($user_ticket['name'])){ echo "Non renseigné"; }else{ echo $user_ticket['name']; } ?></a></td>
                        <td><a><?php if (empty($user_ticket['category'])){ echo "Non renseigné"; }else{ echo $user_ticket['category']; } ?></a></td>
                        <td><a><?php if (empty($user_ticket['description'])){ echo "Non renseigné"; }else{echo $user_ticket['description']; } ?></a></td>
                        <td><a href="ticket.del.php?id=<?php echo $user_ticket['id']; ?>">Oui</a></td>
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
