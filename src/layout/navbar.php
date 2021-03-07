<!-- NAVBAR -->
<nav class="navigation d-flex align-items-center justify-content-between">
    <!-- LOGO -->
    <a class="navbar-brand" href=<?= BASE_URL . "/src/index.php" ?>>
        <img src=<?= BASE_URL . "/public/images/logo.png" ?> alt="Logo Moukat A Li">
    </a>
    <!-- INFO UTILISATEUR -->
    <div class="d-flex">
        <div class="info-bar d-flex align-items-center">

            
            
            <?php if ( isset($_SESSION['user']['auth']) ): ?>
                <?php $username = $user['pseudo']; ?>
                <p class="text-dark text-center mb-0 mr-3">Bienvenue <strong><?php echo $username ?></strong></p>
                <a href=<?php echo BASE_URL . "/src/pages/user/profile.php" ?>>
                    <img class="nav-avatar mr-4" src=<?php echo BASE_URL . '/public/images/uploads/avatar/' . $user['avatar']; ?> alt="Avatar" />
                </a>
            <?php else: ?>
                <p class="text-dark text-center mb-0 mr-3">Bienvenue <strong>Visiteur</strong></p>
                <a href=<?php echo BASE_URL . "/src/pages/login.php" ?> class="text-info"><i class="fas fa-sign-in-alt fa-2x mr-4"></i></a>
            <?php endif; ?>

        </div>
        <div class="menu-toggle">
            
            <input class="position" type="checkbox" />
            <span class="position"></span>
            <span class="position"></span>
            <span class="position mb-0"></span>
            
            <ul class="menu text-center">

                <a href=<?php echo BASE_URL . "/src/index.php" ?>>
                    <li class="text-uppercase">Accueil</li>
                </a>

                <?php if ( $role == 'user' ): ?>
                <a href=<?php echo BASE_URL . "/src/pages/user/profile.php" ?>>
                    <li class="text-uppercase <?php echo ( $nav == "profile" ) ? "current-page" : "" ?>">profil</li>
                </a>
                <?php endif; ?>

                <?php if ( $role == 'admin' ): ?>
                <a href=<?php echo BASE_URL . "/src/pages/admin/dashboard.php" ?>>
                    <li class="text-uppercase <?php echo ( $nav == "dashboard" ) ? "current-page" : "" ?>">Dashboard</li>
                </a>
                <?php endif; ?>

                <?php if ( $role == 'admin' || $role == "author" ): ?>
                <a href=<?php echo BASE_URL . "/src/pages/admin/gestion-topic.php" ?>>
                    <li class="text-uppercase <?php echo ( $nav == "gestion-topic" ) ? "current-page" : "" ?>">Topics</li>
                </a>
                <?php endif; ?>

                <?php if ( $role == 'admin' ): ?>
                <a href=<?php echo BASE_URL . "/src/pages/admin/gestion-user.php" ?>>
                    <li class="text-uppercase <?php echo ( $nav == "gestion-user" ) ? "current-page" : "" ?>">Utilisateurs</li>
                </a>
                <?php endif; ?>

                <?php if ( $auth == 0 ): ?>
                <a href=<?php echo BASE_URL . "/src/pages/register.php" ?>>
                    <li class="text-uppercase <?php echo ( $nav == "register" ) ? "current-page" : "" ?>">S'inscrire</i></li>
                </a>
                <?php endif; ?>

                <?php if ( $auth == 0 ): ?>
                <a href=<?php echo BASE_URL . "/src/pages/login.php" ?>>
                    <li class="text-uppercase <?php echo ( $nav == "login" ) ? "current-page" : "" ?>">se connecter<i class="fas fa-sign-in-alt ml-2"></i></li>
                </a>
                <?php endif; ?>

                <?php //if ( $role == 'admin' ): ?>
                <a href=<?php echo BASE_URL . "/src/pages/moukatages.php" ?>>
                    <li class="text-uppercase <?php echo ( $nav == "moukatages" ) ? "current-page" : "" ?>">Moukatali</li>
                </a>
                <?php //endif; ?>

                <a href="#">
                    <li class="text-uppercase">Contact</li>
                </a>

                <?php if ( isset($_SESSION['user']) ): ?>
                    <form method="post">
                        <div class="text-center">
                            <button class="btn black btn-hover letter-spacing text-uppercase font-weight-bold text-light" type="submit" name="deconnexion">
                                se déconnecter<i class="fas fa-sign-out-alt ml-2"></i>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
