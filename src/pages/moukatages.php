<?php
require '../../config/config.php';
require ROOT_PATH . '/config/database.php';

require ROOT_PATH . '/src/controller/user-function.php';
require ROOT_PATH . '/src/controller/topic-function.php';
require ROOT_PATH . '/src/controller/action-function.php';
$nav = "moukatages";


$all_users = getAllUsers();

$publish_topics = publishTopic();

if ( isset($_GET['main-topic']) ) {
    $main_topic = $_GET['main-topic'];
    $moukatages = allPostByTopic($_GET['topic-id']);
} else if ( isset($_POST['main-topic']) ) {
    $main_topic = array_search($_POST['main-topic'], $publish_topics);
    $moukatages = allPostByTopic($_POST['main-topic']);
} else {
    if ( count($publish_topics) == 0 ) {
        $moukatages = array();
        $main_topic = "";
    } else {
        $main_topic = 0;
        $moukatages = allPostByTopic($publish_topics[$main_topic]['id']);
    }
}

switch ( $main_topic ) {
    case 0:
        $index1 = 1;
        $index2 = 2;
        break;
    case 1:
        $index1 = 0;
        $index2 = 2;
        break;
    case 2:
        $index1 = 0;
        $index2 = 1;
        break;
}


include ('../layout/head.php');

?>

<title>Sujets & Moukatages | Moukat A Li</title>

</head>

<body>
    
    <!-- HEADER -->
    <header class="header-main ">
        <div class="container">

        <?php include (ROOT_PATH . '/src/layout/navbar.php'); ?>
        
<<<<<<< HEAD
        <!-- NAVBAR -->
        <nav class="navigation d-flex align-items-center justify-content-between">
            <a class="navbar-brand" href=<?= BASE_URL . "/src/index.php" ?>>
                <img src=<?= BASE_URL . "/public/images/logo.png" ?> alt="Logo Moukat A Li">
            </a>
            <div class="d-flex">
                <?php if ( $auth == true ): ?>
                <div class="auth">
                <i class="fas fa-sign-out-alt fa-2x mr-4"></i>
                </div>
                <?php endif; ?>
                <div class="menu-toggle">
                    <input class="position" type="checkbox" />
                    <span class="position"></span>
                    <span class="position"></span>
                    <span class="position mb-0"></span>
                    <ul class="menu">

                        <a href=<?php echo BASE_URL . "/src/index.php" ?>>
                            <li class="text-uppercase">Accueil</li>
                        </a>

                        <?php if ( $role == 'user' ): ?>
                        <a href=<?php echo BASE_URL . "/src/pages/user/profile.php" ?>>
                            <li class="text-uppercase">profil</li>
                        </a>
                        <?php endif; ?>

                        <?php if ( $role == 'admin' ): ?>
                        <a href=<?php echo BASE_URL . "/src/pages/admin/dashboard.php" ?>>
                            <li class="text-uppercase">Dashboard</li>
                        </a>
                        <?php endif; ?>

                        <?php if ( $auth == false ): ?>
                        <a href=<?php echo BASE_URL . "/src/pages/login.php" ?>>
                            <li class="text-uppercase">se connecter</li>
                        </a>
                        <?php endif; ?>

                        <a href="#">
                            <li class="text-uppercase">Contact</li>
                        </a>

                        <?php if ( isset($_SESSION['user']) ): ?>
                            <form method="post">
                                <div class="text-center">
                                    <button class="btn black letter-spacing text-uppercase font-weight-bold text-light" type="submit" name="deconnexion">se déconnecter</button>
                                </div>
                            </form>
                        <?php endif; ?>

                    </ul>
                </div>
            
            </div>
        </nav>

        

=======
>>>>>>> vincent
        </div>
    </header>
    
    <div class="container">
        <?php if ( isset($_SESSION['user']['auth']) ): ?>
            <h6 class="text-light py-5 text-center">Bienvenue <?php echo $pseudo; ?></h6>
            <?php else: ?>
            
            <h6 class="text-light py-5 text-center">Bienvenue Visiteur</h6>
        <?php endif; ?>
        
        <h1 class="text-uppercase display-4 text-center py-3 mt-5">&ldquo;MoukatAli !!&rdquo;</h1>
    </div>

    <section>
        <div class="container pt-4">

            <!-- SUJET BRUT-->
            
            <div class="sujet bg-light p-3 mb-3 d-flex flex-column flex-md-row align-items-md-center">
                <?php if ( count($publish_topics) == 0 ): ?>
                    <div class="text-info text-center text-uppercase py-3 w-100">
                        <p class="mb-0">aucun topic proposé pour le moment<br/>revenez plus tard</p>
                    </div>
                <?php else: ?>
                <div class="image mb-2 mb-md-0 mr-md-2 d-lg-none"><img src=<?= BASE_URL . "/public/images/uploads/topics/" . $publish_topics[$main_topic]['image'] ?> alt="Image du sujet" class="img-fluid"></div>
                <div class="image mr-lg-2 d-none d-lg-block"><img src=<?= BASE_URL . "/public/images/uploads/topics/" . $publish_topics[$main_topic]['image'] ?> alt="Image du sujet" class="img-fluid"></div>
                <div class="w-50 text-center"><p class="text-dark"><?= $publish_topics[$main_topic]['title'] ?></p></div>
                <?php endif; ?>
            </div>

            <!-- PUBLIER -->
            <form method="post" class="bg-light p-4" id="form-publier">
                <?php if ( count($publish_topics) != 0): ?>
                <input type="hidden" name="main-topic" id="main-topic" value=<?= $publish_topics[$main_topic]['id'] ?> />
                <input type="hidden" name="user-id" id="user-id" value=<?= $user_id ?> />
                <?php endif; ?>
                <div class="form-group mb-0">
                    <?php if ( empty($_SESSION['user']) ): ?>
                    <textarea class="form-control mb-2 border-0" id="exampleFormControlTextarea1" rows="3" placeholder="Vous devez vous inscrire pour publier." name="text" disabled></textarea>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn black text-uppercase font-weight-bold text-light letter-spacing" disabled>publier</button>
                    </div>
                    <?php else: ?>
                    <textarea class="form-control mb-2 border-0" id="exampleFormControlTextarea1" rows="3" placeholder="Publier un moukatage." name="text"></textarea>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="publier" class="btn black text-uppercase font-weight-bold text-light letter-spacing">publier</button>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- MESSAGE D ERREUR -->
                <?php if ( count($errors) > 0 ) : ?>
                    <div class="alert alert-danger mt-3 text-center" role="alert">
                        <?php foreach ($errors as $error) : ?>
                            <p class="mb-0"><?php echo $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </section>
<!-- SECTION -->
<section>
    <div class="container py-4">

        
        <!-- MOUKATAGE -->
        <?php if ( empty($moukatages) || count($publish_topics) == 0 ): ?>
        <div class="text-info text-center text-uppercase py-3">
            <p class="mb-0">aucun moukatages pour l'instant</p>
        </div>
        <?php else: ?>
        <?php foreach ($moukatages as $key => $moukatage): ?>
        <div class="moukatage p-3 bg-light text-dark mb-3">
            <!-- PROFIL -->
            <?php foreach ($all_users as $key => $user): ?>
            <?php if ( $user['id'] == $moukatage['user_id'] ): ?>
            <div class="profil d-flex order-md-0 mb-4">
                <div class=" mr-2">
                    <img src=<?= BASE_URL . "/public/images/uploads/avatar/" . $user['avatar'] ?> style="height:4.3em; width:4.3em; border-radius:5em; "/>
                </div>
                <div class="info-profil">
                    <p class="mb-0 mt-3 ml-3 text-uppercase font-weight-bolder"><?php echo $user['pseudo']; ?></p>
                    <p class="mb-0"><?php echo $moukatage['created_at']; ?></p>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <!-- TEXTE -->
            <p><?php echo $moukatage['post']; ?></p>
            <div class="d-flex justify-content-end">
                <div class="d-flex justify-content-md-between">
                    <!-- LIKE DISLIKE -->
                    <div class="like-dislike d-flex justify-content-end justify-content-md-start align-items-md-end mb-4 mb-md-0 order-md-1">
                        <div class="d-flex align-items-center mr-3">
                            <!-- LIKE -->
                            <i <?php if (userLiked($moukatage['id'])): ?> class="fas fa-thumbs-up fa-2x like-btn" <?php else: ?> class="far fa-thumbs-up fa-2x like-btn" <?php endif ?> data-id="<?php echo $moukatage['id'] ?>" disabled></i>
                            <div class="likes nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold mr-2"><?php echo getLikes($moukatage['id']); ?></div>
                            <!-- DISLIKE -->
                            <i <?php if (userDisliked($moukatage['id'])): ?> class="fas fa-thumbs-down fa-2x dislike-btn" <?php else: ?> class="far fa-thumbs-down fa-2x dislike-btn" <?php endif ?> data-id="<?php echo $moukatage['id'] ?>"></i>
                            <div class="dislikes nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold"><?php echo getDislikes($moukatage['id']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>
<!-- SECTION -->
<section class="mb-5 text-center">
        <?php if ( count($publish_topics) > 1 ): ?>
        <h5 class="text-light py-3">AUTRE TOPICS</h5>
        <div class="container d-md-flex justify-content-md-around">
            <!-- AUTRE SUJET -->
            
            <a href="moukatages.php?topic-id=<?= $publish_topics[$index1]['id'] ?>&main-topic=<?= $index1 ?>">
            <div class="autre bg-light p-4 text-dark d-flex align-items-center mb-3 mb-md-0 mr-md-3">
                <img src=<?= BASE_URL . "/public/images/uploads/topics/" . $publish_topics[$index1]['image'] ?> class="mr-2" alt="Image sujet">
                <p class="mb-0"><?= $publish_topics[$index1]['title'] ?></p>
            </div>
            </a>
           
            <!-- AUTRE SUJET -->
            <?php if ( count($publish_topics) > 2 ): ?>
            <a href="moukatages.php?topic-id=<?= $publish_topics[$index2]['id'] ?>&main-topic=<?= $index2 ?>">
            <div class="autre bg-light p-4 text-dark d-flex align-items-center">
                <img src=<?= BASE_URL . "/public/images/uploads/topics/" . $publish_topics[$index2]['image'] ?> class="mr-2" alt="Image sujet">
                <p class="mb-0"><?= $publish_topics[$index2]['title'] ?></p>
            </div>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
    </section>

    <!-- FOOTER -->
    <footer class="text-center py-5 d-flex flex-column">
        <a href="#" class="mb-1">Contact</a>
        <a href="#" class="mb-1">C.G.V.</a>
        <a href="#" class="mb-1">C.G.U.</a>
        <a href="#">Mentions légales</a>
    </footer>

    <!-- jQuery and Bootstrap Bundle (includes Popper) 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- MON SCRIPT -->
    <script src=<?php echo BASE_URL . '/public/js/like-dislike.js' ?>></script>
    
    


    </body>

    </html>