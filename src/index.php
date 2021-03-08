<?php
require '../config/config.php';
require ROOT_PATH . '/config/database.php';

require ROOT_PATH . '/src/controller/user-function.php';

include (ROOT_PATH . '/src/layout/head.php');
?>

<title>Accueil | Moukat A Li</title>

</head>

<body>
    <header>
        <div class="container d-flex justify-content-center">
            <!-- LOGO -->
            <div class="logo">
                <img src=<?= BASE_URL . "/public/images/logo-jaune.png" ?> alt="Logo Moukat A Li">
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <!-- TITRE H1 -->
            <h1 class="tagline text-uppercase text-center mb-5">&ldquo;moukatage&rdquo;</h1>
            <!-- CAROUSEL -->
            <div class="owl-carousel text-light" id="slider">

                <div>
                    <h3 class="text-uppercase mb-0 font-weight-bolder">définition:</h3>
                    <p class="font-weight-light">(Railler, se moquer de quelqu'un, voire critiquer). Celà peut se faire
                        sous forme de:<br />* Jeux de mots<br />* Punchline (phrase qui a pour but d'impacter le
                        lecteur)</p>
                </div>

                <div>
                    <h3 class="text-uppercase mb-0 font-weight-bolder">périmétre d'utilisation</h3>
                    <p class="font-weight-light">L'utlisateur peut exprimer ses idées, son mécontentement, ou ses
                        phrases humoristiques:<br />* en soulignant des inchorénces et contradiction dans un disours,
                        une action ou d'un profil.<br />* en caricaturant un trait physique ou un aspect de caractère
                        d'une personnalité ou d'un évènement donné.</p>
                </div>

                <div>
                    <h3 class="text-uppercase mb-0 font-weight-bolder">philosophie et objectifs</h3>
                    <p class="font-weight-light">* "Moukat A Li" a pour but de faire appel à votre créativité en
                        partageant votre opinion, sous
                        forme de "moukatage" vous permettant de faire rire, de convaincre les autres utilisateurs en
                        convergent les point de vues et opinions.</p>
                    <p class="font-weight-light">" Un moukatage peut être constructif, nous montrer une autre
                        perspective, faire rire, peu piqué
                        un peu mais n'a pas pour but de faire appel à la haine"</p>
                </div>

            </div>

            <?php if ( empty($_SESSION['user']) ): ?>
                <!-- BOUTONS CONNECTION ET VISITER -->
                <div class="bouton d-flex flex-column align-items-center flex-md-row justify-content-md-center">
                    <a class="btn-connexion btn mb-3 mb-md-0 mr-md-3 text-uppercase font-weight-bold" href=<?= BASE_URL . "/src/pages/login.php" ?> role="button">se connecter</a>
                    <a class="btn-visiter btn text-uppercase font-weight-bold text-light" href=<?= BASE_URL . "/src/pages/moukatages.php" ?> role="button">visiter</a>
                </div>
            <?php endif; ?>


                
            <?php if ( $role == 'user' ): ?>
                <!-- BOUTON MOUKATALI -->
                <div class="bouton d-flex flex-column align-items-center flex-md-row justify-content-md-center">
                    <a class="btn-visiter btn text-uppercase font-weight-bold text-light" href=<?= BASE_URL . "/src/pages/moukatages.php" ?> role="button">moukatali!!!</a>
                </div>
            <?php endif; ?>

            <?php if ( $role == 'admin' ): ?>
                <!-- BOUTON ADMINISTRATEUR -->
                <div class="d-flex justify-content-center mt-5">
                    <a class="btn btn-visiter text-uppercase font-weight-bold text-light" href=<?= BASE_URL . "/src/pages/admin/dashboard.php" ?> role="button">administrateur</a>
                </div>
            <?php endif; ?>

            <?php if ( $role == 'author' ): ?>
                <!-- BOUTON ADMINISTRATEUR -->
                <div class="d-flex justify-content-center mt-5">
                    <a class="btn btn-visiter text-uppercase font-weight-bold text-light" href=<?= BASE_URL . "/src/pages/admin/gestion-topic.php" ?> role="button">topics</a>
                </div>
            <?php endif; ?>

   

        </div>
    </section>




    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- OWL CAROUSEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <!-- MON SCRIPT -->
    <script src=<?= BASE_URL . "/public/js/carousel.js" ?>></script>


</body>

</html>