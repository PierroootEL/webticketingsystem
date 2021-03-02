<?php

    require '../database/connect.php';

    require '../core/functions/functions_logs.php';

    require 'assets/header.php';



    $sql_users = "SELECT * FROM users";

    $stmt_users = $pdo->prepare($sql_users);

    $stmt_users->execute();

    $users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <title>Administrer les utilisateurs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta lang="fr-FR">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <div class="container">
        <section>
            <h1>Liste de tous les utilisateurs</h1>
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php  foreach($users as $user){ ?>
                    <tr>
                        <td><a href="users.form.php?id=<?php echo $user['id']; ?>"><?php if (empty($user['username'])){ echo "Non renseigné"; }else{echo $user['username']; } ?></a></td>
                        <td><a><?php if (empty($user['prenom'])){ echo "Non renseigné"; }else{ echo $user['prenom']; } ?></a></td>
                        <td><a><?php if (empty($user['nom'])){ echo "Non renseigné"; }else{ echo $user['nom']; } ?></a></td>
                        <td><a><?php if (empty($user['email'])){ echo "Non renseigné"; }else{echo $user['email']; } ?></a></td>
                        <td><a><?php if (empty($user['phone'])){ echo "Non rempli"; }else{echo $user['phone']; } ?></a></td>
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
