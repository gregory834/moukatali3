<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOSTRAP 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

    <!-- style.css -->
    <link rel="stylesheet" href="../../css/styleGreg.css">
    <link rel="stylesheet" href="../../css/mon-style.css">
    <link rel="stylesheet" href="../../css/styleDav.css">

    <title>abonnement</title>
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

    <!-- BODDY -->

    <section class="container">
        <div class="row d-flex justify-content-center">
            <!-- CONNNECTER EN TANT QUE -->


            <!-- TITRE MANQUE RESPONSIVE TITLE-->
            <div class="mt-5 mx-3 box-titre col-lg-6 col-md-6 col-sm-4 d-flex justify-content-center">
                <h2>MI VEU EN PLIS !!&#x1F609;</h2>
            </div>
        </div>
    </section>



    <!-- ABONNEMENT FORMULAIRE ET QUERIES FORMS -->

    <div class="d-flex justify-content-center mt-3 mb-3">
        <div class="mb-5 mx-3 box-formulaire col-lg-4 col-md-4 col-sm-9">
            <form class="col p-4 mt-5 mb-5" method="" action="">


                <!-- CHOIX DE L OFFRE -->
                <div class="md-3 mb-3">

                    <label class="mb-3" for="exampleFormControlInput1" class="form-label">Choisir offre</label>

                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>--</option>
                        <option value="1">VIP (2€/mois)</option>
                        <option value="2">Classique (1€/mois)</option>

                    </select>
                </div>

                  <!-- CHOIX DU PACK BOOST -->
                  <div class="md-3 mb-3">

                    <label class="mb-3" for="exampleFormControlInput1" class="form-label">Pack booster</label>

                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Aucun</option>
                        <option value="1">VIP (2€/mois)</option>
                        <option value="2">Classique (1€/mois)</option>

                    </select>
                </div>


                <!-- ATTENTION nom et prénom sur la meme ligne ! -->

                <div class="row  mb-3  d-flex justify-content-between">
                    <!-- NOM -->
                    <div class=" col ">

                        <label for="exampleFormControlInput1" class="form-label">Nom*</label>
                        <input type="text" class="form-control" id="Nom" name="Nom" placeholder="DUPONT"
                            title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4"
                            maxlength="50" size="50" value="">
                        </input>
                    </div>

                    <!-- PRENOM -->
                    <div class="col ">
                        <label for="exampleFormControlInput1" class="form-label">Prénom*</label>
                        <input type="text" class="form-control" id="Prenom" name="Prenom" placeholder="Vinshan"
                            title="Veuillez inscrire votre prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4"
                            maxlength="50" size="50" value="">
                        </input>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email* </label>

                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
                    </input>

                </div>

                <!-- TYPE DE LA CARTE -->
                <div class="md-3 mb-3">

                    <label class="mb-3" for="exampleFormControlInput1" class="form-label">Type de carte bancaire</label>

                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>--</option>
                        <option value="1">ELECTRON</option>
                        <option value="2">VISA </option>
                        <option value="2">VITAL </option>
                        <option value="2">GOLDEN </option>

                    </select>
                </div>

                <!--    Numéro de la carte -->
                <div class="md-3 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Numéro de la carte (14 chiffres)</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="XXXX XXXXXX XXX" min="0"
                        max="100" title="" required value="">
                    </input>
                </div>


                <!--    date Validité de la carte-->
                <div class="md-3 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date de fin de validité.</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="XX / XXXX" min="0"
                        max="100" title="" required value="">
                    </input>
                </div>


                <!--   Clé de la carte (trois chiffre)-->
                <div class="md-3 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Saisir les 3 chiffres au dos de la
                        carte</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="XXX" min="0" max="100"
                        title="" required value="">
                    </input>
                </div>


                <!-- MOT DE PASSE -->
                <div class="mb-3 ">
                    <label class="mb-3" for="mot de passe1">Mot de passe* </label>

                    <input type="password" class="form-control" id="password-1" name="password-1" required
                        pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        title="Saisir un mot de passe" minlength="1" maxlength="20" size="20" value="">
                    </input>

                </div>


                <!--  BOUTON CONNEXION -->
                <div class="mt-5 d-flex justify-content-center ">
                    <button type="button " class="btn btn-dark ">SOUSCRIRE</button>

                </div>


            </form>

        </div>


    </div>



  <!-- FOOTER -->
  <footer class="text-center py-5 d-flex flex-column">
    <a href="#" class="mb-1">Contact</a>
    <a href="#" class="mb-1">C.G.V.</a>
    <a href="#" class="mb-1">C.G.U.</a>
    <a href="#">Mentions légales</a>
</footer>

    <!-- 888888888888888888888888888888888888888888 -->

</body>

  
<!--    VUE JS -->
<script>


</script>
<!-- FIN VUE JS -->

</html>