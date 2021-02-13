<!-- DERARAGE D UNE SESSION suite a une connexion on a besoin des infos de sessions pour afficher au bon endroit -->


<?php
session_start();
global $user;
//  echo  ($user);

// header ("content-type: image/jpeg");
?>


<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Slackey&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="../../css/styleGreg.css">
    <link rel="stylesheet" href="../../css/mon-style.css">
    <link rel="stylesheet" href="../../css/styleDav.css">
    <title>Liste des sujets - Moukat A Li</title>
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
                        <a href="../../index.php">
                            <li class="header-liste-p"> <img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Accueil</li>
                        </a>
                        <!-- <a href="liste-sujet.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png"  class="icon-size "  class="icon-size " /> Moukatages</li>
                        </a> -->
                        <a href="../formUser/connection.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Se connecter</li>
                        </a>
                        <a href="../user/profile.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Mon espace</li>
                        </a>
                        <a href="../formUser/abonnement.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> S'abonner</li>
                        </a>
                        <!-- <a href="succes.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png"  class="icon-size "  class="icon-size " /> Mes succès</li>
                        </a> -->
                        <a href="#">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Contact</li>
                        </a>
                        <a href="../../functions/deconnect-user.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " class="icon-size " /> Se déconnecter</li>
                        </a>
                    </ul>
                </div>
            </nav>

        </div>
    </header>

    <!-- FIN DE LA NAV -->

    <!--88888888888888888888888888888888888888888 -->
    <!-- VERIFICATION DES MESSAGE ERREUR ET ETAT DE CONNECTION TEXT EN BLC SUR FOND NOIR -->
    <div class="text-light">
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

    <!-- 888888888888888888888888888888888888888888888888888888 -->

    <!-- DEBUT DU BODY -->


    <!-- AFFICHAGE EN FONCTION DE CONNECTION OU NON. SI PAS DESSION SA AFFICHE RIEN -->
    <?php

    if (isset($_SESSION)) { ?>

<section>
        <div class="container d-flex flex-column align-items-center justify-content-center">

            <?php echo ('<img  id="img_avatar" src="../../images/uploads/' . $user['avatar'] . '" />'); ?>
            <!-- TITRE -->
            <div class="mt-5 ml-5 mr-5 box-offre col-lg-6 col-md-6 col-sm-4 d-flex justify-content-center">

                <h4 class="mt-2">Connecté en tant que : <?php echo ($user['pseudo']) ?> </h5>

            </div>

            <button type="submit" name="deconnection">
                deconnection test
            </button>
        </div>
    </section>


    <?php  }

    ?>



 



    <?php

    if (isset($_SESSION)) {
        echo ($_SESSION['user']['password']);
    }

    ?>



    <!-- 88888888888888888888888888888888888888888888888888888888888 -->





 

   






    <!-- SECTION -->

    <section>
        <div class="container pt-4">

            <!-- SUJET -->
            <div class="sujet bg-light p-3 mb-3 d-flex flex-column flex-md-row align-items-md-center">
                <div class="image mb-2 mb-md-0 mr-md-2 d-lg-none"><img src="images/image-mobile.jpg" alt="Image du sujet"></div>
                <div class="image mr-lg-2 d-none d-lg-block"><img src="images/image.jpg" alt="Image du sujet"></div>
                <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in lobortis nisl.
                    Vestibulum mauris metus, luctus quis volutpat vitae, laoreet.</p>
            </div>
            <!-- PROGRESS BAR -->
            <div class="info p-3 mb-3 bg-light">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!-- INFO -->
            <div class="info px-4 py-3 mb-3 bg-light d-flex align-items-center justify-content-md-center">
                <div class="nombre black text-light d-flex align-items-center justify-content-center font-weight-bolder mr-2 p-1">
                    1333</div>
                <p class="mb-0 font-weight-light text-dark">Moukatages à faire avant la clôture</p>
            </div>
            <!-- PUBLIER -->
            <form class="bg-light p-4" id="form-publier">
                <div class="form-group mb-0">
                    <textarea class="form-control mb-2 border-0" id="exampleFormControlTextarea1" rows="3" placeholder="Publier un moukatage"></textarea>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn black text-uppercase font-weight-bold text-light letter-spacing">publier</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
    <!-- SECTION -->
    <section>
        <div class="container py-4">

            <!-- TRIER-->
            <div class="trier d-flex justify-content-between mb-3">
                <div class="btn-group">
                    <button class="btn btn-light btn-sm dropdown-toggle text-uppercase letter-spacing" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        trier
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">par pertinence</a>
                        <a class="dropdown-item" href="#">par date</a>
                    </div>
                </div>
                <!-- VOIR PLUS-->
                <div>
                    <button type="button" class="btn btn-light letter-spacing text-uppercase">voir plus de
                        moukatages</button>
                </div>
            </div>


<!-- 8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888 -->

<?php

if (isset($_SESSION)) {  ?>

            <!-- MOUKATAGE -->
            <div class="moukatage p-3 bg-light text-dark mb-3">
                      <!-- PROFIL -->
                      <div class="profil d-flex order-md-0 mb-3">
                        <div class=" mr-2">

                        <?php echo ('<img  src="../../images/uploads/' . $user['avatar'] . '" style="height:4.3em; width:4.3em; border-radius:5em; "/>' . "<br/>"); ?>

                        </div>
                        <div class="info-profil">
                            <p class="mb-0 mt-3 ml-3 text-uppercase font-weight-bolder">  <?php  echo ($user['pseudo']);  ?>   </p>
                            <p class="mb-0">1 janvier 2021 à 00h00</p>
                        </div>
                    </div>
                <!-- TEXTE -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in lobortis nisl. Vestibulum mauris
                    metus, luctus quis volutpat vitae, laoreet. Lorem ipsum dolor sit amet.</p>
                <div class="d-md-flex justify-content-md-between">
                    <!-- LIKE DISLIKE -->
                    <div class="like-dislike d-flex justify-content-end justify-content-md-start align-items-md-end mb-4 mb-md-0 order-md-1">
                        <div class="d-flex align-items-center mr-3">
                            <div class="mr-1"><img src="/images/icones/thumbs-up.svg" alt="Like"></div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                1233</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="mr-1"><img src="/images/icones/thumbs-down.svg" alt="Dislike"></div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                1233</div>
                        </div>
                    </div>
              
                </div>
            </div>


  <?php  }
?>

<!-- 8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888 -->









            <!-- MOUKATAGE -->
            <div class="moukatage p-3 bg-light text-dark mb-3">
                <!-- TEXTE -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in lobortis nisl. Vestibulum mauris
                    metus, luctus quis volutpat vitae, laoreet. Lorem ipsum dolor sit amet.</p>
                <div class="d-md-flex justify-content-md-between">
                    <!-- LIKE DISLIKE -->
                    <div class="like-dislike d-flex justify-content-end justify-content-md-start align-items-md-end mb-4 mb-md-0 order-md-1">
                        <div class="d-flex align-items-center mr-3">
                            <div class="mr-1"><img src="/images/icones/thumbs-up.svg" alt="Like"></div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                1233</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="mr-1"><img src="/images/icones/thumbs-down.svg" alt="Like"></div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                1233</div>
                        </div>
                    </div>
                    <!-- PROFIL -->
                    <div class="profil d-flex order-md-0">
                        <div class="avatar mr-2">
                            <img src="../../images/avatar-1.jpg" alt="Avatar"> 
                        </div>
                        <div class="info-profil">
                            <p class="mb-0 mt-3 ml-3  text-uppercase font-weight-bolder">pseudo</p>
                            <p class="mb-0">1 janvier 2021 à 00h00</p>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </section>
    <!-- SECTION -->
    <section class="mb-5">
        <div class="container d-md-flex">

            <!-- AUTRE SUJET -->
            <div class="autre bg-light p-4 text-dark d-flex align-items-center mb-3 mb-md-0 mr-md-3">
                <img src="/images/autre-sujet.jpg" class="mr-2" alt="Image sujet">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac.</p>
            </div>
            <!-- AUTRE SUJET -->
            <div class="autre bg-light p-4 text-dark d-flex align-items-center">
                <img src="/images/autre-sujet.jpg" class="mr-2" alt="Image sujet">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac.</p>
            </div>

        </div>
    </section>
    <!-- FOOTER -->
    <footer class="text-center py-5 d-flex flex-column">
        <a href="#" class="mb-1">Contact</a>
        <a href="#" class="mb-1">C.G.V.</a>
        <a href="#" class="mb-1">C.G.U.</a>
        <a href="#">Mentions légales</a>
    </footer>




    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- VUE JS -->
    <script src="https://unpkg.com/vue@next"></script>
    <!-- MON SCRIPT -->
    <script src="../../script/script.js"></script>


</body>

</html>