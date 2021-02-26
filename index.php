<div class="text-light">
    <?php session_start();

    global $user;
    // global $topic;

    include('functions/bdd-connect.php');
    include('functions/read-user.php');
    include('functions/connect-user.php');
    include('functions/deconnect-user.php');
    if (isset($user)) {
        readUserById($_SESSION['user']['id']);
        // echo ($_SESSION['user']['id']);
        // echo ($user['pseudo']);

    }
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

        <!-- OWL CAROUSEL -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />




        <title>Accueil - Moukat A Li</title>

        <!-- MON CSS -->
        <link rel="stylesheet" href="css/mon-style.css">
        <link rel="stylesheet" href="css/styleDav.css">
    </head>

    <body>


</div>


<section>
    <div class="container   ">
        <!-- TITRE H1 -->
        <div class="index d-flex justify-content-center m-5 p-5  ">
            <img class="m-5 img" src="images/logo-jaune.png">
        </div>
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


        <!-- ON AFFICHE LE BOUTTON VISITER SI AUCUN UTILISATEUR N'EST CONNECTER? SI ON EST PAS CONNECTER ALORS ON EST SIMPLE VISITEUR ET CE BOUTTON DEVIENT VISIBLE -->

        <?php

        if (empty($_SESSION['user']['id'])) {
        ?>

            <!-- BOUTONS -->
            <div class="bouton d-flex flex-column align-items-center flex-md-row justify-content-md-center">
                <a class="btn-connexion btn mb-3 mb-md-0 mr-md-3 text-uppercase font-weight-bold" href="src/formUser/connection.php" role="button">CONNECTION</a>
                <!-- <a class="btn-connexion btn mb-3 mb-md-0 mr-md-3 text-uppercase font-weight-bold" href="src/formUser/inscription.php" role="button">INSCRIPTION</a> -->

            </div>

            <div class="d-flex justify-content-center mt-5">
                <a class="btn-visiter btn text-uppercase font-weight-bold text-light" href="src/pages/liste-sujet.php" role="submit" name="visiter">visiter</a>
            </div>
        <?php
        } else {
        ?>

            <h4 class="ml-2">Vous êtes connecté en tant que : <?php echo ($_SESSION['user']['pseudo']); ?>
                &nbsp;
                <?php echo ($_SESSION['user']['prenom']); ?> </h4>
                <div class="d-flex justify-content-center mt-5">
                    <a class="btn-visiter btn text-uppercase font-weight-bold text-light" href="src/pages/liste-sujet.php" role="submit" name="moukatali">MOUKATALI !!</a>
                </div>
            <?php
        }    ?>

            <!-- Affichage du bouton (lien) ADMINISTRATEUR si connection user existante et si et seulement si le role vaut === admin. Le but étant que les utilisateurs lambda n'ont pas acces au ce lien qui gere tout -->

            <?php

            // verification du role de l utilisateur si il est un administrateur ou non et on affiche son btn en fonction du relustat de la fonction pregmatch

            $pattern = '/^admin/';
            $subject = $user['role'];
            if (preg_match($pattern, $subject)) {

            ?>
                <div class="d-flex justify-content-center mt-5">
                    <a class=" btn text-uppercase font-weight-bold text-light" href="src/formAdmin/form-admin-create.php" role="button">administrateur</a>
                </div>
            <?php
            } ?>


    </div>
</section>




<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<!-- OWL CAROUSEL -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<!-- VUE JS
    <script src="https://unpkg.com/vue@next"></script> -->
<!-- MON SCRIPT -->
<script src="script/script.js"></script>


</body>

</html>