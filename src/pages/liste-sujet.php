<!-- DERARAGE D UNE SESSION suite a une connexion on a besoin des infos de sessions pour afficher au bon endroit -->

<div class="text-light">
    <?php
    session_start();
    global $user;
    // global $topic;

    include('../../functions/bdd-connect.php');
    include('../../functions/read-user.php');
    include('../../functions/delete-user.php');
    include('../../functions/deconnect-user.php');
    include('../../functions/topic-functions.php');
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
        <!-- FIN DE LA NAV -->
        <!-- VERIFICATION DES MESSAGE ERREUR -->
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
            //recuperation des topics a publier
            $etatPublish = 1; //Pour recuperer tout sont qui sont publier
            $etatUnpublish = 0; //reccuperer tout ceux qui sont non publier ou en attente de publication
            $final_topics = array();
            $final_topics_autres = array();
            $sql = "SELECT * FROM topics  WHERE published = $etatPublish";
            $pdoStat = $db->prepare($sql);
            $executeIsOk = $pdoStat->execute();
            // $listes_AllTpics = $pdoStat->fetchAll();
            $topics = $pdoStat->fetchAll();

            foreach ($topics as $topic) {
                // $topic['author'] = getTopicAuthorById($topic['id']);
                array_push($final_topics, $topic);
                // var_dump($topic['image']);
            }
            $sql2 = "SELECT * FROM topics  WHERE published = $etatUnpublish";
            $pdoStat2 = $db->prepare($sql2);
            $executeIsOk = $pdoStat2->execute();
            // $listes_AllTpics = $pdoStat->fetchAll();
            $topics_autres = $pdoStat2->fetchAll();

            foreach ($topics_autres as $topic_autre) {
                // $topic['author'] = getTopicAuthorById($topic['id']);
                array_push($final_topics_autres, $topic_autre);
                // var_dump($topic['image']);
            }
            //  var_dump($final_topics['id'])
            // 888888888888888888888888888888888888888888888888888888888888888888888888888888
            ?>
        </div>

        <!-- DEBUT DU BODY -->
        <div class="container   ">
            <!-- TITRE H1 -->
            <h1 class=" text-center text-alert mb-4 ">&ldquo;MoukatAli !!&rdquo;</h1>
        </div>

        <!-- AFFICHAGE EN FONCTION DE CONNECTION OU NON. SI PAS DESSION SA AFFICHE RIEN -->
        <?php

        if (isset($_SESSION['user']['id'])) { ?>
            <section class="container">
                <!-- AUTRE SUJET -->
                <div class=" bg-light text-dark d-flex  aligns-items-center justify-content-start  mb-md-0 mr-md-3">
                    <div class="p-3">
                        <?php echo ('<img   src="../../images/uploads/' . $user['avatar'] . '" style="height:8em; width:8em; border-radius:2em; "/>'); ?>
                    </div>
                    <div class="my-5 px-4">
                        <h4>Compte de: <?php echo ($user['pseudo']) ?> </h4>
                    </div>
                </div>
</div>
</section> <?php  }  ?>

<!-- 88888888888888888888888888888888888888888888888888888888888 -->
<!-- SECTION -->

<section>
    <div class="container pt-4">

        <?php 
        
        global $topic, $topic_id;
        if (empty($topics)) : ?>
            <h1 style="text-align: center; margin-top: 20px;">Aucun sujet publié.</h1>
            <?php else :
            // si l etat de la publication est egal a publihed = 1 en bdd alors on l affiche
            foreach ($topics as $topic) { ?>
                <!-- AFFICHAGE DU TOPICS CREER ET PUBLIER PAR L ADMIN -->
                <!-- SUJET -->
                <div class="sujet bg-light p-3 mb-3 d-flex flex-column flex-md-row align-items-md-center">
                    <div class="image mb-2 mb-md-0 mr-md-2 ">
                    </div>
                    <div class="image mr-lg-2  d-lg-block col-sm-6"><?php echo ('<img class="img-fluid" src="../../images/uploads/' . $topic['image'] .  '" alt="Image du sujet">');  ?></div>
                    <h6 class="text-dark"><?php echo ($topic['titre'])    ?></h6>
                    <p class="text-dark"><?php echo ($topic['topic_description'])    ?></p>
                </div>
        <?php      }
        endif; ?>

        <!-- SUJET BRUT-->
        <!-- <div class="sujet bg-light p-3 mb-3 d-flex flex-column flex-md-row align-items-md-center">
            <div class="image mb-2 mb-md-0 mr-md-2 d-lg-none"><img src="../../images/image-mobile.jpg" alt="Image du sujet"></div>
            <div class="image mr-lg-2 d-none d-lg-block"><img src="../../images/image.jpg" alt="Image du sujet"></div>
            <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in lobortis nisl.
                Vestibulum mauris metus, luctus quis volutpat vitae, laoreet.</p>
        </div> -->

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
        if (isset($_SESSION['user']['id'])) {  ?>
            <!-- MOUKATAGE -->
            <div class="moukatage p-3 bg-light text-dark mb-3">
                <!-- PROFIL -->
                <div class="profil d-flex order-md-0 mb-4">
                    <div class=" mr-2">
                        <?php echo ('<img  src="../../images/uploads/' . $user['avatar'] . '" style="height:4.3em; width:4.3em; border-radius:5em; "/>' . "<br/>"); ?>
                    </div>
                    <div class="info-profil">
                        <p class="mb-0 mt-3 ml-3 text-uppercase font-weight-bolder"> <?php echo ($user['pseudo']);  ?> </p>
                        <p class="mb-0">1 janvier 2021 à 00h00</p>
                    </div>
                </div>
                <!-- TEXTE -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in lobortis nisl. Vestibulum mauris
                    metus, luctus quis volutpat vitae, laoreet. Lorem ipsum dolor sit amet.</p>
                <div class="d-flex justify-content-end">
                    <div class="d-flex justify-content-md-between">
                        <!-- LIKE DISLIKE -->
                        <div class="like-dislike d-flex justify-content-end justify-content-md-start align-items-md-end mb-4 mb-md-0 order-md-1">
                            <div class="d-flex align-items-center mr-3">
                                <div class="mr-1"><img src="../../icons/like.png" alt="Like"></div>
                                <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                    1233</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="mr-1"><img src="../../icons/dislike.png" alt="Dislike"></div>
                                <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                    1233</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <?php  }  ?>
        <!-- 8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888 -->

        <!-- MOUKATAGE -->
        <div class="moukatage p-3 bg-light text-dark mb-3 ">
            <!-- PROFIL -->
            <div class="profil d-flex order-md-0 mb-4">
                <div class="avatar mr-2">
                    <img src="../../images/avatar-1.jpg" alt="Avatar">
                </div>
                <div class="info-profil">
                    <p class="mb-0 mt-3 ml-3  text-uppercase font-weight-bolder">pseudo</p>
                    <p class="mb-0">1 janvier 2021 à 00h00</p>
                </div>
            </div>

            <!-- TEXTE -->
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in lobortis nisl. Vestibulum mauris
                metus, luctus quis volutpat vitae, laoreet. Lorem ipsum dolor sit amet.</p>

            <div class="d-flex justify-content-end">

                <div class="d-flex justify-content-md-between">
                    <!-- LIKE DISLIKE -->
                    <div class="like-dislike d-flex justify-content-end justify-content-md-start align-items-md-end mb-4 mb-md-0 order-md-1">
                        <div class="d-flex align-items-center mr-3">
                            <div class="mr-1"><img src="../../icons/like.png" alt="Like"></div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                1233</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="mr-1"><img src="../../icons/dislike.png" alt="Dislike"></div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                1233</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</section>
<!-- SECTION -->


<?php if (empty($topics_autres) && empty($topics)) : ?>
    <section class="container mb-5">
        <div class=" row col-12 mx-1 d-flex justify-content-around">

            <h1 style="text-align: center; margin-top: 20px;">Aucun sujet en attente.</h1>
        </div>
    </section>
<?php else :
    // si l etat de la publication est egal a publihed = 1 en bdd alors on l affiche


?>

    <h4 class="mb-5" style="text-align: center;">Sujet à venir</h4>
    <section class="container mb-5">
        <div class=" row col-12 mx-1 d-flex justify-content-around">

            <?php

            foreach ($topics_autres as $topic_autre) { ?>

                <!-- AFFICHAGE DU TOPICS CREER ET PUBLIER PAR L ADMIN -->
                <!-- SUJET -->

                <!-- AUTRE SUJET -->
                <div class="autre bg-light m-2 p-2 text-dark  col-md-5 col-sm-12 d-flex  align-items-center mb-3 mb-md-0 ">
                    <?php echo ('<img src="../../images/uploads/' . $topic_autre['image'] .  '" class="mr-2 alt="Image sujet">');  ?>
                    <p class="mb-0  "><?php echo ($topic_autre['topic_description'])    ?></p>
                </div>

        <?php      }
        endif; ?>






        <!-- AUTRE SUJET -->
        <!-- <div class="autre bg-light p-4 text-dark d-flex align-items-center mb-3 mb-md-0 mr-md-3">
            <img src="../../images/autre-sujet.jpg" class="mr-2" alt="Image sujet">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac.</p>
        </div> -->




        <!-- AUTRE SUJET -->
        <!-- <div class="autre bg-light p-4 text-dark d-flex align-items-center">
            <img src="../../images/autre-sujet.jpg" class="mr-2" alt="Image sujet">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac.</p>
        </div> -->

        </div>
    </section>

    <div class="text-light">

        <?php
        // echo 'Donnée de session en cours : <br/>';
        // echo ('<img src="../../images/uploads/' . $user['avatar'] . '" style="height:4em; width:4em; border-radius:em; "/>' . "<br/>");
        // echo ($user['avatar'] . "<br/>");
        // echo ($user['pseudo'] . "<br/>");
        // echo ($user['id'] . "<br/>"); // ID QU ON A BESOIN POUR LA FONCTION READ USER BY ID AFIN D AFFICHER LES INFOS DEPUIS LA BDD ET NON DEPUIS LES VARIABLE DE SESSION. AVEC SESSION C EST MOIN SECURISEE
        // echo ($user['nom'] . "<br/>");
        // echo ($user['age'] . "<br/>");
        // echo ($user['genre'] . "<br/>");
        // echo ($user['telephone'] . "<br/>");
        // echo ($user['email'] . "<br/>");
        // echo ($user['password'] . "<br/>");
        // echo ($user['ville'] . "<br/>");   
        ?>

    </div>




    <!-- FOOTER -->
    <footer class="text-center py-5 d-flex flex-column">
        <a href="#" class="mb-1">Contact</a>
        <a href="#" class="mb-1">C.G.V.</a>
        <a href="#" class="mb-1">C.G.U.</a>
        <a href="#">Mentions légales</a>
    </footer>


    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- VUE JS -->
    <script src="https://unpkg.com/vue@next"></script>
    <!-- MON SCRIPT -->
    <script src="../../script/script.js"></script>


    </body>

    </html>