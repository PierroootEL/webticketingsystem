<style>
    *{
        padding: 0;
        margin: 0;
        overflow: hidden;
    }

    html{
        scroll-behavior: smooth;
    }

    header{
        width: 100%;
        height: 80px;
        position: fixed;
        background-color: grey;
        top: 0;
    }

    header .container-header{
        font-family: "Poppins", sans-serif;
        text-decoration: none;
        color: black;
    }

    header .container-header a{
        display: inline-block;
        margin-top: 30px;
    }

    header .container-header-left{
        float: left;
        padding-left: 15px;
        color: black;
        text-decoration: none;
    }

    header .container-header-right:hover{
        color: blue;
        text-decoration: underline;
    }

    header .container-header-right{
        float: right;
        padding-right: 15px;
        text-decoration: none;
        color: black;
    }
</style>

<header>
    <div class="container-header">
        <a href="index.php" class="container-header-left">Interface d'administration</a>
        <a href="category.php" class="container-header-right">Catégorie de ticket</a>
        <a href="ban.php" class="container-header-right">Bannissement</a>
        <a href="users.php" class="container-header-right">Administrer utilisateurs</a>
    </div>
</header>