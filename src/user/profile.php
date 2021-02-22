<div class="text-light">
    <?php
    session_start();
    global $user;
    // global $topic;

    include('../../functions/bdd-connect.php');
    include('../../functions/read-user.php');
    include('../../functions/update-user.php');
    include('../../functions/delete-user.php');
    include('../../functions/deconnect-user.php');
    include('../../functions/topic-functions.php');
    readUserById($_SESSION['user']['id']);
    // echo  ($_SESSION['user']['id']);
    //  echo  ($user['pseudo']);

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

        <!-- bouton delete JS STYLE DAV -->
        <link href="../../css/btn1-delete.css" rel="stylesheet" type="text/css" />
        <!-- <link href="../../btn-delete.css" rel="stylesheet" type="text/css" /> -->


    </head>

    <body>
        <!-- 888888888888888888888888888888888888888888888888888888 -->
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
                            <a href="../../index.php">
                                <li class="header-liste-p"> <img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Accueil</li>
                            </a>

                            <?php
                            if (isset($_SESSION['user']['id'])) {  ?>
                                <a href="liste-sujet.php">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> MouKatAli !!</li>
                                </a>
                                <a href="../user/profile.php">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Mon profil</li>
                                </a>
                                <a href="succes.html">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Mes succès</li>
                                </a>
                                <a href="../pages/offre.php">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " />Offre et abonnemnt</li>
                                </a>
                                <a href="#">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Contact</li>
                                </a>
                                <li class="header-liste-p d-flex justify-content-around mr-5">

                                    <form method="POST">
                                        <button href="../../index.php" type="submit" class="btn btn-warning" name="deconnection">
                                            Se déconnecter
                                        </button>
                                    </form>
                                </li>
                            <?php  } else {  ?>
                                <a href="../formUser/connection.php">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Se connecter</li>
                                </a>
                                <a href="../formUser/inscription.php">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> S'inscrire</li>
                                </a>
                                <a href="#">
                                    <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Contact</li>
                                </a>
                            <?php    }  ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <div class="text-light">
            <?php
            // 888888888888888888888888888888888888888888888
            // SI ID EXISTANT
            if (isset($_SESSION['user']['id'])) {
                //READ USER Lancement de la fonction de lecture avec id de session en parametre
                readUserById($_SESSION['user']['id']);
                // Lancement de la fonction de suppression avec id de session en parametre et SI le bouton est cliqué
                if (isset($_POST['supprimer'])) {
                    delete_user($_SESSION['user']['id']);
                }
                // DECONNECTION SESSION
                if (isset($_POST['deconnection'])) {
                    deconnect_user();
                }
            } else {
                echo 'Aucune saission en cours ! Veuillez vous connectez !<br/>';
            }
            // 888888888888888888888888888888888888888888888888888888888888888888888888888888
            ?>
        </div>
        <!------------------------------------------------------------------------------------------------->
        <!-- CONTAINER  -->
        <!-- <h3 class="pt-3 mb-5 text-white text-center">DASHBOARD</h3> -->
        <!-- user_info -->
        <section>
            <div class="container col-lg-8 col-md-8 d-flex justify-content-center">
                <div id="user_info">
                    <!-- Score Rang Statut -->
                    <div class="d-flex justify-content-around fw-bolder mb-3 text-dark">
                        <p>SCORE</p>
                        <p>RANG</p>
                        <p>STATUT</p>
                    </div>
                    <!-- photo_de_profile -->
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <?php echo ('<img id="img_avatar"  src="../../images/uploads/' . $user['avatar'] . '" alt="avatar user"  class="img-fluid" />'); ?>
                            <!-- <img id="img_avatar" src="images/avatar-3.jpg" alt="" class="img-fluid"> -->
                        </div>
                    </div>
                    <!---Information user (NOM, Prénom, Addresse, Tel Sexe...)-->
                    <div class="col  d-flex justify-content-around  text-dark">
                        <div class="justify-content-around">
                            <h5><img src="../../icons/user-fill.png" class="icon-size mr-4" /><?php echo ($user['nom']) ?>&nbsp;<?php echo ($user['prenom']) ?></h5>
                            <h5><img src="../../icons/cake-2-fill.png" class="icon-size mr-4" /><?php echo ($user['age']) ?> ans</h5>
                            <h5><img src="../../icons/mail-open-fill.png" class="icon-size mr-4" /><?php echo ($user['email']) ?></h5>
                            <h5><img src="../../icons/phone-fill.png" class="icon-size mr-4" /><?php echo ($user['telephone']) ?></h5>
                            <h5><img src="../../icons/map-pin-fill.png" class="icon-size mr-4" />Ville de <?php echo ($user['ville']) ?></h5>
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
                    <div class="d-flex flex-column flex-md-row text-center align-items-center justify-content-md-around mt-4">
                        <!-- 
                        <a class="btn btn-profil text-uppercase font-weight-bold mb-3 mb-md-0" href="succes.html" role="button">Mes succès</a> -->

                        <a class="btn btn-profil text-uppercase font-weight-bold mb-3 mb-md-0" href="../formUser/modification.php" type="submit" name="mofidier" role="button">Modifier</a>

                        


                        <!-- JAVASCRIPT ANIMATION BTN DELETE AND FONCTIONALITY -->
                        <div class="btn1 ">
                            <div class="btn1-back ">
                                <p>Est tu certain de vouloir supprimer ton compte? Cette action est irreversible !</p>

                                <form action="" method="POST" class="yes ">
                                    <button type="submit" name="supprimer" class="yes ">Oui</button>
                                    <button class="no">Non</button>
                                </form>

                            </div>
                            <div class="btn1-front text-uppercase font-weight-bold">Supprimer </div>

                            <!-- SCRIPT DELETE DAV -->
                            <script src="../../script/btn1-delete.js"></script>

                        </div>




                    </div>


                </div>

                <!-- FONCTIONELLE -->
                <!-- <form action="" method="POST">
                    <button type="submit" name="supprimer">
                        supprimer compte (fonctionne)
                    </button>
                </form> -->



            </div>
        </section>

        <!-- FOOTER -->
        <footer class="text-center py-5 d-flex flex-column">
            <a href="#" class="mb-1">Contact</a>
            <a href="#" class="mb-1">C.G.V.</a>
            <a href="#" class="mb-1">C.G.U.</a>
            <a href="#">Mentions légales</a>
        </footer>

    </body>

    </html>