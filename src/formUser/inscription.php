<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOSTRAP 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../css/styleGreg.css">
    <link rel="stylesheet" href="../../css/mon-style.css">
    <link rel="stylesheet" href="../../css/styleDav.css">


    <title>Inscription - Moukat A Li</title>
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

  
    <!--88888888888888888888888888888888888888888 -->
    <!-- VERIFICATION DES MESSAGE ERREUR ET ETAT DE CONNECTION TEXT EN BLC SUR FOND NOIR -->
    <div class="text-light"><?php
                            //APPEL DE LA FUNCTION DE CONNECTION A LA BDD AVEC INCLUDE
                            // include ('bdd-connect.php');
                            // connectPdoBdd(); //OK FONCTIONNE
                            // connectSqliBdd(); //OK FONCTIONNE 

                            //APPEL DE LA FONCTION CREATE USER
                            //require once evite les boucles de includes
                            // require_once ('functions/registration-login.php');
                            require_once('../../functions/create-user.php');
                            // ON LANCE NOTRE FONCTION CREATE USER SI BTN CLIQUER
                            if (isset($_POST['inscription'])) {
                                create_user();
                            }
                            ?></div>
    <!--88888888888888888888888888888888888888888 -->

    <!-- BODDY -->

    <section>
        <div class="container d-flex flex-column align-items-center justify-content-center">

            <!-- TITRE -->
            <div class="mt-5 ml-5 mr-5 box-titre col-lg-6 col-md-6 col-sm-4 d-flex justify-content-center">
                <h2>MI VEU MOUKATER !! &#x1F60B;</h2>
            </div>
        </div>


    </section>

    <div class="container d-flex flex-column align-items-center justify-content-center">

    </div>


    <section id="form-inscription">

        <div class="container d-flex flex-column align-items-center justify-content-center">

            <!-- MESSAGE D'ERREUR-->
            <!-- en global pour l injecter dans le formulaire de type <form> et de method posT -->
            <?php global $errors, $success_inscription; ?>

            <!-- FORMULAIRE -->
            <!-- FORMULAIRE D'INSCRIPTION -->
            <div class="mb-5 box-formulaire col-lg-8 col-md-8 col-12">

                <form class="col px-3 py-4" method="POST" enctype="multipart/form-data">

                    <!-- MESSAGE D ERREUR -->
                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>

                    <!-- MESSAGE CONFIRMATION CONNECTION AVANT REDIRECTION -->
                    <?php if (count($success_inscription) > 0) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php foreach ($success_inscription as $success_inscriptions) : ?>
                                <p><?php echo $success_inscriptions ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>


                    <!-- PSEUDONYME DATA TYPE VARCHAR-->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Pseudonyme*</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Moukateur 974" title="Choisir un pseudo ou un nom d'utilisateur">
                        </input>
                        <!-- NE PAS AFFACER SERVIRA POUR EXPLIQUER LA SECURIT2 FORMULAIRE DU COT2 DE PHP (double securisation) -->
                        <!-- required
                        pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" 
                        minlength="4"
                        maxlength="30" 
                        size="30" 
                         value="" -->
                    </div>

                    <!-- PHOTO DE PROFIL DATA TYPE VARCHAR CAR ON ENREGISTRE UN LIEN D IMAGE -->

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Avatar*</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" required>
                        </input>

                    </div>

                    <!-- ATTENTION nom et prénom sur la meme ligne ! -->

                    <div class="mb-3 d-flex flex-column flex-md-row justify-content-between">
                        <!-- NOM DATA TYPE VARCHAR-->
                        <div class=" col-md-6 col-12 px-0 mb-3 mb-md-0 pr-md-1">

                            <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Nom*</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="DUPONT" title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="">
                            </input>
                        </div>

                        <!-- PRENOM DATA TYPE VARCHAR-->
                        <div class="col-md-6 col-12 px-0 pl-md-1">
                            <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Prénom*</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Vinshan" title="Veuillez inscrire votre prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="">
                            </input>
                        </div>
                    </div>


                    <!-- ATTENTION GENRE ET AGE SUR LA MEME LIGNE-->
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <!-- GENRE DATA TYPE SQL BOLEEN-->

                        <div class="col-md-6 px-0 mb-3 mb-md-0 pr-md-1">

                            <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Genre</label>

                            <select class="custom-select" id="inputGroupSelect01" name="genre">
                                <option selected>Choisir son genre</option>
                                <option>Homme</option>
                                <option >Femme</option>
                                <option >3ième type</option>
                            </select>
                        </div>


                        <!-- AGE DATATPE SQL INT(10)-->
                        <div class="col-md-6 px-0 mb-3 mb-md-0 pl-md-1">
                            <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Age*</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="18" min=18 max=100 required>
                            </input>
                        </div>

                    </div>


                    <!-- EMAIL DATA TYPE SQL VARCHAR -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Email* </label>

                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
                        </input>

                    </div>


                    <!-- MOT DE PASSE DATA TYPE VARCHAR 100 CAR LE MOTE DE PASSE SERA HASHER-->
                    <div class="mb-3 ">
                        <label class="text-dark mb-0" for="mot de passe1">Mot de passe* </label>

                        <input type="password" class="form-control" id="password_1" name="password_1" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Saisir un mot de passe" minlength="1" maxlength="20" size="20" value="">
                        </input>

                    </div>

                    <!-- CONFIRMATION MOT DE PASSE PAS NECESSAIRE A L INSERTION EN BDD MAIS UTILSE POUR CONFIRMER LE PASSWORD-->
                    <div class="mb-3 ">
                        <label class="text-dark mb-0" for="mot de passe2">Confirmation* </label>

                        <input type="password" class="form-control" id="password_2" name="password_2" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Confirmation mot de passe" minlength="1" maxlength="20" size="20" value="">
                        </input>

                    </div>


                    <!-- TELEPHONE DATA TYPE VARCHAR-->
                    <div class="mb-3 mt-3 text-start">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="0692010203" title="Inscrire votre numéro de téléphone (format 00 00 00 00 00)" required pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" value="">
                    </div>


                    <!-- VILLE DATA TYPE VARCHAR -->
                    <div class="mb-3">

                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Ville</label>

                        <select class="custom-select" id="inputGroupSelect01" name="ville">
                            <option selected>Saint-Denis</option>
                            <option>Saint-Marie</option>
                            <option>Saint-Suzanne</option>
                            <option>Tampon</option>
                        </select>
                    </div>


                    <!-- BOUTON INSCRIPTION -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="inscription" class="btn btn-dark">INSCRIPTION</button>

                    </div>
                    <div class="mt-3 d-flex justify-content-center"> <i>(* Champs obligatoires)</i></div>

                    <div class="mt-3 d-flex justify-content-center"><a href="connection.php" class="text-nav-foot pb-2">Déjà un compte pour moukater ? </a><br>
                    </div>
                    <!-- MESSAGE D'ERREUR-->
                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
            </div>
            </form>

        </div>


    </section>


</body>




<!--    VUE JS -->
<script>



</script>
<!-- FIN VUE JS -->

</html>