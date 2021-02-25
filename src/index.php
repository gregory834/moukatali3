<?php
session_start();
require '../config/config.php';
?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Slackey&display=swap"
        rel="stylesheet">

    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />

    <!-- MON CSS -->
    <link rel="stylesheet" href=<?= BASE_URL."/public/css/styleGreg.css" ?>>
    <link rel="stylesheet" href=<?= BASE_URL."/public/css/styleDav.css" ?>>
    <link rel="stylesheet" href=<?= BASE_URL."/public/css/mon-style.css" ?>>

    <title>Accueil | Moukat A Li</title>
</head>

<body>
    <header>
        <div class="container d-flex justify-content-center">
            <!-- LOGO -->
            <div class="logo">
                <img src=<?= BASE_URL."/public/images/logo-jaune.png" ?> alt="Logo Moukat A Li">
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <!-- TITRE H1 -->
            <h1 class="text-uppercase text-center mb-5">&ldquo;moukatage&rdquo;</h1>
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

            <?php if ( empty($_SESSION['user'])): ?>

            <!-- BOUTONS -->
            <div class="bouton d-flex flex-column align-items-center flex-md-row justify-content-md-center">
                <a class="btn-connexion btn mb-3 mb-md-0 mr-md-3 text-uppercase font-weight-bold" href="pages/login.php"
                    role="button">se connecter</a>
                <a class="btn-visiter btn text-uppercase font-weight-bold text-light" href="pages/moukatages.php" role="button">visiter</a>
            </div>

            <?php else: ?>

                <div class="bouton d-flex flex-column align-items-center flex-md-row justify-content-md-center">
                <a class="btn-visiter btn text-uppercase font-weight-bold text-light" href="pages/moukatages.php" role="button">moukatali!!!</a>
                </div>


            <?php endif; ?>




        </div>
    </section>




    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <!-- OWL CAROUSEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <!-- MON SCRIPT -->
    <script src=<?= BASE_URL."/public/js/carousel.js" ?>></script>


</body>

</html>