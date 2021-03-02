<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <style>
        /* Add a black background color to the top navigation */
        .topnav {
            background-color: #333;
            overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            font-family: "Poppins", sans-serif;
        }

        .left{

        }

        /* Change the color of links on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Add an active class to highlight the current page */
        .topnav a.active {
            background-color: #4CAF50;
            color: white;
        }

        /* Hide the link that should open and close the topnav on small screens */
        .topnav .icon {
            display: none;
        }

        /* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
                float: left;
                display: block;
                transition: all;
                transition-duration: 0.5s;
            }
        }

        /* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
        @media screen and (max-width: 600px) {
            .topnav.responsive {position: relative;}
            .topnav.responsive a.icon {
                position: absolute;
                right: 0;
                top: 0;
                transition: all;
                transition-duration: 0.5s;
            }
            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
                transition: all;
                transition-duration: 0.5s;
            }
        }
    </style>

    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
    <header>
        <div class="topnav" id="myTopnav">
            <a href="#">Profil</a>
            <a href="#">Voir vos tickets</a>
            <a href="#">Créer un ticket</a>
            <a href="#" class="active">Accueil</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</html>