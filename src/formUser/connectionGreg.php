<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOSTRAP 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- style.css -->
    <link rel="stylesheet" href="../../css/styleGreg.css">
    <link rel="stylesheet" href="../../css/mon-style.css">
    <link rel="stylesheet" href="../../css/styleDav.css">

    <title>Connexion</title>
</head>

<body>
    <!-- HEADER -->


    <header class="header-liste ">
        <div class="container">

            <!-- NAVBAR -->
            <nav class="navigation d-flex align-items-center ">
                <a class="navbar-brand ml-4 mb-1" href="../../index.php">
                    <img src="../../images/logo.png" alt="Logo Moukat A Li" style="width: 24vh;">
                </a>
                <div class="menu-toggle mt-1">

                    <input class="position" type="checkbox" />
                    <span class="position"></span>
                    <span class="position"></span>
                    <span class="position"></span>

                    <ul class="menu">
                        <a href="../../index.php">
                            <li class="header-liste-p"> <img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Accueil</li>
                        </a>
                        <a href="../../liste-sujet.html">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Moukatages</li>
                        </a>
                        <!-- <a href="connection.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png"  class="icon-size " /> Se connecter</li>
                        </a> -->
                        <!-- <a href="profile.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png"  class="icon-size " /> Mon espace</li>
                        </a> -->
                        <a href="abonnement.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> S'abonner</li>
                        </a>
                        <!-- <a href="succes.php">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png"  class="icon-size " /> Mes succès</li>
                        </a> -->
                        <a href="#">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png" class="icon-size " /> Contact</li>
                        </a>
                        <!-- <a href="#">
                            <li class="header-liste-p"><img src="../../icons/chevron-right-solid-24.png"  class="icon-size " /> Se déconnecter</li> -->
                        </a>
                    </ul>
                </div>
            </nav>

        </div>
    </header>

    <!-- BODDY -->


    <section id="form-connexion">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <!-- TITRE -->
            <div class="my-5 m-md-5 box-titre col-lg-6 col-md-6 col-sm-4 col-12 d-flex justify-content-center">
                <h2>ALLON MOUKATER !!&#x1F609;</h2>
            </div>
        </div>
    </section>

    <section id="form-connexion">
        <div class="container d-flex flex-column justify-content-center align-items-center">

            <div class="text-light">
                <?php //Démarage de la fonction connect_user si le bouton ['connection'] est cliqué.
                //La fonction Connect_BDD sera lancé et les vérifications également

                require_once('../../functions/connect-user.php');

                if (isset($_POST['connection'])) {

                    connect_user();
                }

                ?>
            </div>


            <!-- MESSAGE D'ERREUR-->
            <!-- en global pour l injecter dans le formulaire de type <form> et de method posT -->
            <?php global $errors, $success_connect; ?>


            <!-- FORMULAIRE D'INSCRIPTION -->
            <div class="mb-5 box-formulaire col-lg-8 col-md-8 ">
                <form class="col px-3 py-4" method="post">

                    <!-- MESSAGE ERREUR DE CONNECTION-->
                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>

                    <!-- MESSAGE CONFIRMATION CONNECTION AVANT REDIRECTION -->
                    <?php if (count($success_connect) > 0) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php foreach ($success_connect as $success_connects) : ?>
                                <p><?php echo $success_connects ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Email* </label>

                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
                        </input>

                    </div>

                    <!-- MOT DE PASSE -->
                    <div class="mb-3 ">
                        <label class="mb-0 text-dark" for="mot de passe1">Mot de passe* </label>

                        <input type="password" class="form-control" id="password-1" name="password-1" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Saisir un mot de passe" minlength="1" maxlength="20" size="20" value="">
                        </input>

                    </div>

                    <!--  BOUTON CONNEXION -->

                    <?php if (isset($_SESSION)) { ?>
                        <div class="mt-3 d-flex justify-content-center">
                            <a href="../pages/liste-sujet.php"><button type="button" name="suivant" class="btn btn-dark">SUIVANT</button></a>
                        </div>
                    <?php  } else { ?> <div class="mt-3 d-flex justify-content-center">
                            <button type="submit" name="connection" class="btn btn-dark">CONNEXION</button>
                        </div>
                    <?php   }   ?>

                    <div class="mt-1 d-flex justify-content-center text-dark"> <i>(* Champs obligatoires)</i></div>

                    <div class="mt-3 d-flex justify-content-center"><a href="inscription.php" class="text-nav-foot pb-2">Pas
                            encore de compte !? Inscrit toi ici !! </a><br>
                    </div>

                </form>
            </div>
        </div>
    </section>

</body>


<!--    VUE JS -->
<script>


</script>
<!-- FIN VUE JS -->

</html>