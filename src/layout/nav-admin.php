<?php
require_once '../../config/config.php';
?>

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
        <a href="<?php echo BASE_URL . "/src/pages/moukatages.php" ?>">
            <li class="text-uppercase">Gestion profil</li>
        </a>
        <a href=<?php echo BASE_URL . "/src/pages/user/profile.php" ?>>
            <li class="text-uppercase">Gestion topics</li>
        </a>
        <a href="#">
            <li class="text-uppercase">Accueil</li>
        </a>
        <a href="#">
            <li class="text-uppercase">Accueil</li>
        </a>
        </ul>
    </div>
</nav>