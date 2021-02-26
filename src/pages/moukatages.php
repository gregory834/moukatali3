<?php
require '../../config/config.php';
require '../../config/database.php';
require '../controller/user-function.php';
require '../controller/topic-function.php';


$user = readUserById($_SESSION['user']['pseudo']);
$topics = readAllTopics();
$publish_topics = activeTopicByOrder();



// var_dump($topic['created_at']);


echo '<pre>';
// var_dump($published_topics[0][1]);
var_dump($published_topics);
echo '<pre>';
// var_dump($published_topics[0]['title']);
// var_dump($published_topics[1]);
// var_dump($published_topics[2]);

include('../layout/head.php');

?>

<title>Sujets & Moukatages | Moukat A Li</title>

</head>

<body>

    <!-- HEADER -->
    <header class="header-main ">
        <div class="container">

            <?php include(BASE_URL . '/src/layout/nav.php'); ?>

        </div>
    </header>

    <div class="container">
        <h6 class="text-light py-5 text-center">Bienvenue <?php echo $user['pseudo']; ?></h6>
        <h1 class=" text-center text-alert mb-4 ">&ldquo;MoukatAli !!&rdquo;</h1>
    </div>

    <section>
        <div class="container pt-4">

<?php 

foreach ($published_topics as $key => $published_topic ) :


?>
            <!-- SUJET BRUT-->
            <div class="sujet bg-light p-3 mb-3 d-flex flex-column flex-md-row align-items-md-center">
                <div class="image mb-2 mb-md-0 mr-md-2 d-lg-none"><img src=<?= BASE_URL . "/public/images/image-mobile.jpg" ?> alt="Image du sujet"></div>


                <div class="image mr-lg-2 d-none d-lg-block"><img src=<?= BASE_URL . "/public/images/uploads/" . $published_topics[0][2] ?> alt="Image du sujet"></div>


             

       


                <p class="text-dark">
                <?php  echo $published_topics[0][1];  ?>
                </p>
            </div>

<?php endforeach;  ?>

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
            </div>

            <!-- MOUKATAGE -->
            <div class="moukatage p-3 bg-light text-dark mb-3">
                <!-- PROFIL -->
                <div class="profil d-flex order-md-0 mb-4">
                    <div class=" mr-2">
                        <img src=<?= BASE_URL . "/public/images/avatar-1.jpg" ?> style="height:4.3em; width:4.3em; border-radius:5em; " />
                    </div>
                    <div class="info-profil">
                        <p class="mb-0 mt-3 ml-3 text-uppercase font-weight-bolder">pseudo</p>
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
    <section class="mb-5">
        <div class="container d-md-flex">

            <!-- AUTRE SUJET -->
            <div class="autre bg-light p-4 text-dark d-flex align-items-center mb-3 mb-md-0 mr-md-3">
                <img src=<?= BASE_URL . "/public/images/autre-sujet.jpg" ?> class="mr-2" alt="Image sujet">
                <p class="mb-0">'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac.'</p>
            </div>
            <!-- AUTRE SUJET -->
            <div class="autre bg-light p-4 text-dark d-flex align-items-center">
                <img src=<?= BASE_URL . "/public/images/autre-sujet.jpg" ?> class="mr-2" alt="Image sujet">
                <p class="mb-0">'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac.'</p>
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