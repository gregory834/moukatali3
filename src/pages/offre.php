<!-- VERIFICATION DES MESSAGE ERREUR -->
<div class="text-light">
    <?php session_start();
    include('../../functions/bdd-connect.php');
    include('../../functions/read-user.php');
    include('../../functions/deconnect-user.php');
    include('../../functions/offre-functions.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">

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
        <link rel="stylesheet" href="../../css/offre.css">
        <title>offre</title>
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
        //recuperation des offres en bdd pour intéraction direct avec le client (btn ajouter au panier)
        $etatPublish = 1; //pour récupérer les articles publié en bdd depuis espace admin
        // $etatUnpublish = 0; //pour récuperer les articles non publier ou a venir (teasing)
        $final_offres = array();
        // $final_offres_autres = array();
        $sql = "SELECT * FROM abonnement  WHERE published = $etatPublish";
        $pdoStat = $db->prepare($sql);
        $executeIsOk = $pdoStat->execute();
        $offres = $pdoStat->fetchAll();
        // on parcours le resultat de la requete ligne par ligne pour afficher chaque ligne (offre ou articles) dans une card.
        foreach ($offres as $offre) {
            array_push($final_offres, $offre); //stock des resultat par ligne 
            // var_dump($offre['image']);
        }
        // $sql2 = "SELECT * FROM abonnement  WHERE published = $etatUnpublish";
        // $pdoStat2 = $db->prepare($sql2);
        // $executeIsOk = $pdoStat2->execute();

        // $offres_autres = $pdoStat2->fetchAll();
        // foreach ($offres_autres as $offre_autre) {
        //     array_push($final_offres_autres, $offre_autre);
        //     // var_dump($topic['image']);
        // }
        //  var_dump($final_topics['id'])
        // 888888888888888888888888888888888888888888888888888888888888888888888888888888
        ?>

        <section class="container">
            <div class="row d-flex justify-content-center">
                <div class="mt-5 mx-3 box-titre col-lg-6 col-md-6 col-sm-4 d-flex justify-content-around">
                    <h2 class="mt-2">MI VEU EN PLIS !!&#x1F609;</h2>
                </div>
            </div>
        </section>

        <section class="container ">
            <div class="row  d-flex justify-content-center">
                <h5 class="text-offre-h2 d-flex justify-content-center ">
                    <?php echo ($user['pseudo']);    ?> !! <br /> N'hésite pas à acheter les packs de booster !! Conseil
                    d'un amie
                </h5>
            </div>
        </section>

        <section class="container">
            <div class="row d-flex justify-content-center">
                <div class="text-offre-p box-formulaire col-lg-8 col-md-8 col-sm-6  mx-3 py-4 px-4 justify-content-center">
                    <?php echo ('<img src="../../images/uploads/' . $user['avatar'] . '" style="height:7em; width:7em;" class="rounded-circle  float-left m-3"/>') ?>
                    <p> <br />
                        Oté
                        <?php echo ($user['pseudo']);    ?> mon Ti dalon ! A ter la ou gagne renseigne à dsu le band
                        abonnement ou bien dsu les packs booster. Choisit saK y convient à ou le mieux.
                    </p>
                    <p>Ou néna les abonnements dsu 12 mois. <br> Sinon ou peu aussi trap juste un pack de temps en temps
                    </p>
                    <p>Ou sa voir, sa meme lé correct</p>
                    <div class="card-body text-center">
                        <img src="../../images/kisspng-court-piece-gift-game-smartphone-gift-box-open-fly-out-of-the-phone-vector-5a697a82ca38e5.4876160315168620828283.png" class="img-fluid " alt="..." style="width: 50%;">
                        <h5 class="card-title mt-3 text-danger">Regarde
                            <?php echo ($user['pseudo']);    ?> pour 1 €/ mois pendant 12 mois !
                        </h5>
                        <p class="card-text text-danger">Ton solde de 40 moukatages par mois! <br>
                            1 vote = X2 !
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- SECTION POUR LA SELECTION D UNE OFFRE OU UN ARTICHE AVANT UN PAIEMENT -->

        <section>
            <div class="container">
                <div classs="row">
                <?php 
                if (empty($offres)){
                    ?>   <h1 style="text-align: center; margin-top: 20px;">Aucun article et aucune offre ce moment</h1>  <?php
                }
                ?>
              
                <div class="row row-cols-1 row-cols-md-3"> 
                    <!-- 888888888888888888888888888888888888888888888 -->
                    <?php if (isset($offres)) :
                        // si l etat de la publication est egal a publihed = 1 en bdd alors on l affiche
                   
                                                                        foreach ($offres as $offre) { ?>
                                <!-- 888888888888888888888888888888888888888888888888 -->

                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <?php echo ('<img src="../../images/uploads/' . $offre['image'] .  '" class="card-img-top" alt="Image article/offre" style="height: 30vh;" >');  ?>
                                        <!-- <img src="../../images/974dodo.jpg" class="card-img-top" style="height: 30vh;"> -->
                                        <div class="card-body">
                                            <h6 class="card-title"><?php echo ($offre['titre_article'])    ?></h6>
                                            <p class="card-text"><?php echo ($offre['offre_description'])    ?></p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                            <a href="#" class="btn btn-primary">Ajouter au panier</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- 888888888888888888888888888888888888888888888888 -->
                        <?php      }
                                                                    endif; ?>
                        <!-- 888888888888888888888888888888888888888888888 -->


                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="../../images/974dodo.jpg" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">EXEMPLE EN BRUT</h5>
                                    <p class="card-text">CECI EST UN EXEMPLE EN CODE BRUT D'UN ARTICLE OU D'UNE OFFRE POUR LE CLIENT . LE BOUTON AJOUTER AU PANIER DOIVENT INTEARGIR AVEC LE CLIENT QUI DEVRA POUVOIR CONSULTER SON PANIER AVANT SON ACHAT</p>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary">Ajouter au panier</a>
                                </div>
                            </div>
                        </div>
                        <!-- 888888888888888888888888888888888888888888888888 -->
                        <!-- <div class="col mb-4">
                        <div class="card h-100">
                            <img src="../../images/logo_moukatali_noir.png" class="card-img-top" style="height: 30vh;"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a short card.</p>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="#" class="btn btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div> -->
                        <!-- <div class="col mb-4">
                        <div class="card h-100">
                            <img src="../../images/974-west-coast-1.jpg" class="card-img-top" style="height: 30vh;"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content.</p>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="#" class="btn btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div> -->
                        <!-- <div class="col mb-4">
                        <div class="card h-100">
                            <img src="../../images/974images.jpg" class="card-img-top" style="height: 30vh;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="#" class="btn btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4"> -->
                        <!-- <div class="card h-100">
                            <img src="../../images/974images.jpg" class="card-img-top" style="height: 30vh;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <a href="#" class="btn btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div> -->
                        <!-- 88888888888888888888888888888888888888888888888888888 -->
                        </div>
                </div>
            </div>
        </section>


        <!-- test javascript btn interactif modal confirmation oui ou non  -->
        <section>
            <!-- LE BOUTIN DELETE COMPTE avec JAVASCRIPT-->
            <div class="btn">
                <div class="btn-back">
                    <p>Est tu certain pour supprimer ton compte?</p>
                    <button class="yes">Oui</button>
                    <button class="no">Non</button>
                </div>
                <div class="btn-front btn btn-primary">Ajouter au panier</div>

            </div>
        </section>
        
        <!-- FOOTER -->
        <footer class="text-center py-5 d-flex flex-column">
            <a href="#" class="mb-1">Contact</a>
            <a href="#" class="mb-1">C.G.V.</a>
            <a href="#" class="mb-1">C.G.U.</a>
            <a href="#">Mentions légales</a>
        </footer>
        <!-- 888888888888888888888888888888888888888888 -->
</div>
</body>


<!--    VUE JS -->
<script>


</script>
<!-- FIN VUE JS -->

</html>