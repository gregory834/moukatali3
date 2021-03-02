<?php
require '../../config/config.php';
require ROOT_PATH . '/config/database.php';

require ROOT_PATH . '/src/controller/user-function.php';
require ROOT_PATH . '/src/controller/like-dislike.php';
//require '../controller/topic-function.php';
if ( isset($_SESSION['user']) ) {
    $user = readUserById( $_SESSION['user']['id'] );
    $pseudo = $user['pseudo'];
    $role = $user['role'];
    $auth = TRUE;
}

//$topic = getTopicById();
$moukatages = postTopicById(1);
$all_users = getAllUsers();
/*
echo '<pre>';
print_r($all_users);
echo '</pre>';

echo '<pre>';
print_r($moukatages);
echo '</pre>';
*/
include ('../layout/head.php');

?>

<title>Sujets & Moukatages | Moukat A Li</title>

</head>

<body>
    
    <!-- HEADER -->
    <header class="header-main ">
        <div class="container">

        
        <!-- NAVBAR -->
        <nav class="navigation d-flex align-items-center justify-content-between">
            <a class="navbar-brand" href=<?= BASE_URL . "/src/index.php" ?>>
                <img src=<?= BASE_URL . "/public/images/logo.png" ?> alt="Logo Moukat A Li">
            </a>
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

                    <?php if ( $auth == FALSE ): ?>
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
        </nav>

        </div>
    </header>
    
    <div class="container">
        <?php if ( $auth == TRUE ): ?>
            <h6 class="text-light py-5 text-center">Bienvenue <?php echo $pseudo; ?></h6>
            <?php else: ?>
            
            <h6 class="text-light py-5 text-center">Bienvenue Visiteur</h6>
        <?php endif; ?>
        
        <h1 class=" text-center text-alert mb-4 ">&ldquo;MoukatAli !!&rdquo;</h1>
    </div>

    <section>
        <div class="container pt-4">


            <!-- SUJET BRUT-->
            <div class="sujet bg-light p-3 mb-3 d-flex flex-column flex-md-row align-items-md-center">
                <div class="image mb-2 mb-md-0 mr-md-2 d-lg-none"><img src=<?= BASE_URL . "/public/images/image-mobile.jpg" ?> alt="Image du sujet"></div>
                <div class="image mr-lg-2 d-none d-lg-block"><img src=<?= BASE_URL . "/public/images/image.jpg" ?> alt="Image du sujet"></div>
                <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in lobortis nisl.
                    Vestibulum mauris metus, luctus quis volutpat vitae, laoreet.</p>
            </div>

            <!-- PUBLIER -->
            <form method="post" class="bg-light p-4" id="form-publier">
                <div class="form-group mb-0">
                    <textarea class="form-control mb-2 border-0" id="exampleFormControlTextarea1" rows="3" placeholder="Publier un moukatage" name="text"></textarea>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="publier" class="btn black text-uppercase font-weight-bold text-light letter-spacing">publier</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<!-- SECTION -->
<section>
    <div class="container py-4">

        <!-- TRIER
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
        </div>-->

        <!-- MOUKATAGE -->
        <div class="moukatage p-3 bg-light text-dark mb-3">
            <!-- PROFIL -->
            <div class="profil d-flex order-md-0 mb-4">
                <div class=" mr-2">
                    <img  src=<?= BASE_URL . "/public/images/avatar-1.jpg" ?> style="height:4.3em; width:4.3em; border-radius:5em; "/>
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
                            <div class="mr-1">
                                <img src="<?= BASE_URL . "/public/images/icones/unlike.png" ?>" alt="Like">
                            </div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">0</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="mr-1">
                                <img src=<?= BASE_URL . "/public/images/icones/undislike.png" ?> alt="Dislike">
                            </div>
                            <div class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MOUKATAGE -->
        <?php if ( empty($moukatages) ): ?>
        <div class="text-light text-center text-uppercase py-3">
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
                    <img  src=<?= BASE_URL . "/public/images/uploads/" . $user['avatar'] ?> style="height:4.3em; width:4.3em; border-radius:5em; "/>
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
                            <div class="mr-1">
                                <img class="like-btn" <?php if (userLiked($moukatage['id'])): ?> src=<?= BASE_URL . "/public/images/icones/like.png" ?> <?php else: ?> src=<?= BASE_URL . "/public/images/icons/unlike.png" ?>  <?php endif; ?> alt="Like" data-id="<?php echo $moukatage['id'] ?>">
                            </div>
                            <span class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                <?php echo getLikes($moukatage['id']); ?>
                            </span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="mr-1">
                                <img class="dislike-btn" <?php if (userDisliked($moukatage['id'])): ?> src=<?= BASE_URL . "/public/images/icones/undislike.png" ?> <?php else: ?> src=<?= BASE_URL . "/public/images/icones/dislike.png" ?> <?php endif ?> alt="Dislike" data-id="<?php echo $moukatage['id'] ?>">
                            </div>
                            <span class="nb-vote black text-light d-flex justify-content-center align-items-center font-weight-bold">
                                <?php echo getDislikes($moukatage['id']); ?>
                            </span>
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

    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <!-- VUE JS -->
    <script src=<?php echo BASE_URL . '/public/js/like-dislike.js' ?>></script>
    <!-- MON SCRIPT -->
    <script src=<?php BASE_URL . "/public/js/script.js" ?>></script>


    </body>

    </html>