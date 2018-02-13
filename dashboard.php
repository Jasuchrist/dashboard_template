<!DOCTYPE html>
<html lang="fr">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Dashboard Administrateur</title>
    <link rel="stylesheet" href="style.css" type="text/css">

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        @font-face {
            font-family: "Robot";
            src: url("assets/fonts/RobotoSlab-Regular.ttf");
        }

        body {
            padding: 0px;
            background: #607D8B;
            font-family: "Robot", sans-serif;
        }

        .titre {

            background-color: #37474F;
            color: white;
            text-align: center;
            font-size: 3vw;
            padding: 0px;
            position: relative;
            z-index: 9999;
        }

        .titre>p {
            padding: 30px;
        }

        #left_panel {
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100%;
            width: 300px;
            top: 0;
            left: 0;
            bottom: 0;
            background-color: #90A4AE;
        }

        #left_panel>.back-to-top>a>img {
            width: 20%;
            display: block;
            margin: 50px auto 0 auto;
            padding-top: 5px;
        }


        #left_panel .welcome {
            position: relative;
            top: 6em;
            margin-bottom: 50px;
            padding: 10px;
            text-align: center;
            border: 5px solid #607D8B;
            border-left: none;
            border-right: none;
            color: white;
            transition: all 1.5s ease;
        }

        #left_panel .welcome:hover,
        #left_panel .welcome:focus,
        #left_panel .welcome:active {
            background-color: #607D8B;
            outline: none;
            /* permet de changer le cadre du tabindex pour le focus */
            transform: scale(1.05);
        }

        /*#left_panel .welcome:focus img,
        #left_panel .welcome:hover img{
            position:relative;
            float:right
        }*/

        .welcome:nth-child(3) {}

        #left_panel>.welcome>img {
            margin: 0 auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        #left_panel>.welcome:nth-child(3)>img,
        #left_panel>.welcome:nth-child(4)>img,
        #left_panel>.welcome:nth-child(5)>img {
            margin-left: 2px;
            width: 70px;
            height: 70px;
            float: left;
            position: relative;
            transition: all .1s ease;
            -webkit-transition: all 0.1s ease;
        }

        #left_panel>.welcome:nth-child(3):focus>img,
        #left_panel>.welcome:nth-child(4):focus>img,
        #left_panel>.welcome:nth-child(5):focus>img {
            animation: bounce 2s ease infinite;
            animation-delay: 1s;
        }

        @keyframes bounce {
            from {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            to {
                transform: scale(1);
            }
        }

        float: right;
        }

        #left_panel .user {
            padding: 10px;
        }

        #left_panel .user-cat {
            padding: 20px;
        }


        /********* Panneau central affichage *******/

        #main-container {
            position: relative;
            margin-left: 300px;
            padding: 50px;

        }

        #center {}

        .homepage {
            background: rgba(#fff, #fff, #fff, 0.5);
            width: 100%;
            height: 300px;
        }






        @media screen and (max-width: 720px) {
            
            #left_panel{
                width:120px;
            }
            
            #main-container {
            position: relative;
            margin-left: 120px;
            padding: 20px;

            }
           
        }
    </style>



</head>

<body>
    <a name="top"></a>
    <!-- anchor back to top -->
    <header>
        <div class="titre">
            <p>Bienvenue sur le Dashboard d'administration du site</p>
        </div>
    </header>


    <!-- start of LEFT PANEL -->
    <div id="left_panel">

        <div class="back-to-top">
            <a href="#top"><img src="assets/img/back-to-top.png" alt="icon-backtotop"></a>
        </div>
        <div class="welcome" id="profile" tabindex="0">
            <img src="assets/img/bgWfZsnE_400x400.jpg" alt="member-photo">
            <p class="user">Admin : Emma Watson</p>
            <p class="user">Derniere connexion le :<br> 01-01-1989</p>
            <p class="user"><a href="#">Deconnection</a></p>
        </div>

        <div class="welcome" id="manage_article" tabindex="0">
            <img src="assets/img/section-article2.png" alt="icon-article">
            <p class="user-cat">Gestion des articles</p>
        </div>

        <div class="welcome" id="manage-member" tabindex="0">
            <img src="assets/img/icon-member.png" alt="icon-membership">
            <p class="user-cat">Gestion des membres</p>

        </div>

        <div class="welcome" id="statistics" tabindex="0">
            <img src="assets/img/statistics-icon.png" alt="icon-stats">
            <p class="user-cat">Statistiques du site</p>
        </div>

    </div>

    <!-- end of LEFT PANEL -->


    <div id="main-container">
        <div id="center">
            <div class="homepage">
                <p>Vous etes bien connectés au service d'administration <br> Vous pouvez naviguer dans les differentes sections situés sur le panneau lateral</p>
            </div>
        </div>
    </div>


    <!-- Script JavaScript -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#profile").click(function() {
                $("#center").load("profile.php");
            });
            $("#manage_article").click(function() {
                $("#center").load("managing_article.php");
            });
            $("#manage-member").click(function() {
                $("#center").load("managing_member.php");
            });
            $("#statistics").click(function() {
                $("#center").load("stats.php");
            });
        });


        /**** $("#profile").click(function(e) {
                e.preventDefault();
                $('#center').empty().append($.ajax({
                    url: 'profile.php',
                    async: true
                }).responseText);
                return false;
            });
            $("#manage_article").click(function(e) {
                e.preventDefault();
                $('#center').empty().append($.ajax({
                    url: 'managing_article.php',
                    async: false
                }).responseText);
                return false;
            });
            $("#manage-member").click(function(e) {
                e.preventDefault();
                $('#center').empty().append($.ajax({
                    url: 'managing_member.php',
                    async: false,
                }).responseText);
                return false;
            });
            $("#statistics").click(function(e) {
                e.preventDefault();
                $('#center').empty().append($.ajax({
                    url: 'stats.php',
                    async: false,
                }).responseText);
                return false;
            }); ****/
    </script>

</body>

</html>