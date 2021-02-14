<!-- DERARAGE D UNE SESSION suite a une connexion on a besoin des infos de sessions pour afficher au bon endroit -->


<?php
session_start();
global $user;
//  echo  ($user);

// header ("content-type: image/jpeg");
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

    <!-- BOOSTRAP 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- FONT AWESOME ICONS -->


    <link rel="stylesheet" href="../../css/styleGreg.css">
    <link rel="stylesheet" href="../../css/mon-style.css">
    <link rel="stylesheet" href="../../css/styleDav.css">

</head>

<body>



    <!-- HEADER -->

    <header class="header-liste ">
        <div class="container">

            <!-- NAVBAR -->
            <nav class="navigation d-flex align-items-center ">
                <a class="navbar-brand ml-4 mb-1" href="index.html">
                    <img src="../../images/logo.png" alt="Logo Moukat A Li" style="width: 24vh;">
                </a>
                <div class="menu-toggle mt-1">

                    <input class="position" type="checkbox" />
                    <span class="position"></span>
                    <span class="position"></span>
                    <span class="position"></span>

                    <ul class="menu">
                        <a href="index.html">
                            <li class="header-liste-p"> <img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Accueil</li>
                        </a>
                        <a href="liste-sujet.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Moukatages</li>
                        </a>
                        <a href="connection.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Se connecter</li>
                        </a>
                        <a href="profile.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Mon espace</li>
                        </a>
                        <a href="abonnement.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> S'abonner</li>
                        </a>
                        <a href="succes.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Mes succès</li>
                        </a>
                        <a href="#">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Contact</li>
                        </a>
                        <a href="#">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Se déconnecter</li>
                        </a>
                    </ul>
                </div>
            </nav>

        </div>
    </header>

    <div class=" text-light">

        <?php

        include('../../functions/read-user.php');

        // readUserById($_SESSION['user']['id']);

        var_dump($_SESSION['user']['id']);
        // var_dump($_SESSION['pseudo']);
        // var_dump($user);
        // var_dump($user['prenom']);
        // var_dump($user['avatar']);
        // Test si nos informations sont présente en variables de session suite à la fonction de connection qui les ont stockées
        // var_dump($_SESSION); //a muté plus tard

        if (isset($_SESSION['user'])) {

            readUserById($_SESSION['user']['id']);
            echo 'Donnée de session en cours : <br/>';
            echo ('<img src="../../images/uploads/' . $user['avatar'] . '" style="height:4em; width:4em; border-radius:em; "/>' . "<br/>");
            echo ($user['avatar'] . "<br/>");
            echo ($user['pseudo'] . "<br/>");
            echo ($user['id'] . "<br/>"); // ID QU ON A BESOIN POUR LA FONCTION READ USER BY ID AFIN D AFFICHER LES INFOS DEPUIS LA BDD ET NON DEPUIS LES VARIABLE DE SESSION. AVEC SESSION C EST MOIN SECURISEE
            echo ($user['nom'] . "<br/>");
            echo ($user['age'] . "<br/>");
            echo ($user['genre'] . "<br/>");
            echo ($user['telephone'] . "<br/>");
            echo ($user['email'] . "<br/>");
            echo ($user['password'] . "<br/>");
            echo ($user['ville'] . "<br/>");
        } else {
            echo 'Aucune saission en cours ! Veuillez vous connectez !<br/>';
        }

        ?>
    </div>




    <!------------------------------------------------------------------------------------------------->

    <!-- CONTAINER  -->



    <!-- <h3 class="pt-3 mb-5 text-white text-center">DASHBOARD</h3> -->

    <!-- user_info -->
    <section>
        <div class="container py-5 d-flex justify-content-center">
            <div id="user_info">

                <!-- Score Rang Statut -->
                <div class="d-flex justify-content-around fw-bolder mb-3 ">
                    <p>SCORE</p>
                    <p>RANG</p>
                    <p>STATUT</p>
                </div>



                <!-- photo_de_profile -->
                <div class="row">
                    <div class="col-12 text-center mb-3">


                    <?php echo ('<img src="../../images/uploads/' . $user['avatar'] . '" style="height:4em; width:4em; border-radius:em;" class="rounded-circle"/>')?>

                    </div>
                </div>


                <!---Information user (NOM, Prénom, Addresse, Tel Sexe...)-->
                <div class="col  d-flex justify-content-center">

                    <div>

                        <p> <img src="../../icons/user-fill.png" class="icon-size" />
                            <?php echo ($user['nom']); ?> <?php echo ($user['prenom']); ?></p>
                        <p><img src="../../icons/cake-2-fill.png" class="icon-size" /> 
                        <?php echo ($user['age']);?></p>
                        <p><img src="../../icons/mail-open-fill.png" class="icon-size" /> 
                        <?php echo ($user['email']);?></p>
                        <p><img src="../../icons/phone-fill.png" class="icon-size" /> 
                        <?php echo ($user['telephone']);?></p>
                        <p><img src="../../icons/map-pin-fill.png" class="icon-size" />
                        <?php echo ($user['ville']);?></p>


                    </div>

                </div>



                <!-- mes  succès et modifier profile -->
                <!--
                    <div class="container-fluid d-flex justify-content-around mb-3  " style="height: 40px;">
                        <a href="succes.html"><button id="btn_succes" class="btn btn-dark text-light  rounded-pill btn-sm fw-bolder" type="submit">Mes succès</button></a>
                        <button id="btn_editer" class="btn btn-dark text-light  rounded-pill btn-sm fw-bolder" type="submit">Editer</button>
                        <button id="btn_modif" class="btn btn-dark text-light rounded-pill btn-sm fw-bolder" type="submit">Modifer profile</button>
                    </div>
                    -->
                <div class="d-flex flex-column flex-md-row text-center align-items-center justify-content-md-around">
                    <a class="btn btn-profil text-uppercase font-weight-bold mb-3 mb-md-0" href="succes.html" role="button">Mes succès</a>
                    <a class="btn btn-profil text-uppercase font-weight-bold" href="#" role="button">Modifier
                        info</a>
                </div>
            </div>

        </div>
    </section>




</body>

</html>