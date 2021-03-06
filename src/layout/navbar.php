<!-- NAVBAR -->
<nav class="navigation d-flex align-items-center justify-content-between">
            <a class="navbar-brand" href=<?= BASE_URL . "/index.php" ?>>
                <img src=<?= BASE_URL . "/public/images/logo.png" ?> alt="Logo Moukat A Li">
            </a>
            <div class="menu-toggle">
                <input class="position" type="checkbox" />
                <span class="position"></span>
                <span class="position"></span>
                <span class="position mb-0"></span>
                <ul class="menu text-center">

                    <a href=<?php echo BASE_URL . "/index.php" ?>>
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
