<?php

include('../config.php');
include('../functions/functions.php');
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../index.php');
}

?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/styles.css">

    <title>Espace Moukateur - Moukat A Li</title>
</head>

<body>
    <!-- HEADER -->
    <header id="admin">
        <div class="container">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">
                    <div id="logo">MOUKAT A LI</div>
                </a>
                <ul class="nav justify-content-end">
                    <li class="nav-item me-3">
                        <span>bienvenue
                            <?php echo $_SESSION['user']['username'] ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a id="logout-link"
                            class="nav-link btn btn-secondary text-white text-uppercase fw-bold rounded-0 border-0 <?= $btn_logout ?>"
                            href="user-area.php?logout='1'" role="button">log out</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <section id="form-login">
        <div class="container d-flex flex-column justify-content-center align-items-center p-5">
            <a href="user-area.php" class="text-black">
                <svg width="50" height="50" fill="currentColor" class="bi bi-x text-dark" viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </a>
            <h5>modifier mon profil</h5>
            <form method="post" action="form-edit.php">
                <!-- MESSAGE D'ERREUR-->
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <!-- PSEUDO -->
                <div class="mb-3">
                    <label for="username" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Tibili 974"
                        title="Choisir un pseudo ou un nom d'utilisateur" required
                        pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" minlength="4" maxlength="30" size="30" value="<?php echo $username; ?>">
                </div>
                <!-- PRENOM -->
                <div class="mb-3">
                    <label for="first-name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Vinshan"
                        title="Veuillez inscrire votre Prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4"
                        maxlength="50" size="50" value="<?php echo $first_name; ?>">
                </div>
                <!-- NOM -->
                <div class="mb-3">
                    <label for="last-name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="last-name" name="last-name" placeholder="DUPONT"
                        title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4"
                        maxlength="50" size="50" value="<?php echo $last_name; ?>">
                </div>
                <!-- EMAIL -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                        title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="<?php echo $email; ?>">
                </div>
                <!-- TELEPHONE -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="06 92 01 02 03"
                        title="Inscrire votre numéro de téléphone (format 00 00 00 00 00)" required
                        pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" value="<?php echo $phone; ?>">
                </div>
                <!-- MOT DE PASSE -->
                <div class="mb-3">
                    <label for="password-1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password-1" name="password-1"
                        title="Saisir un mot de passe" required
                        pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1"
                        maxlength="20" size="20">
                </div>
                <div class="mb-3">
                    <label for="password-2" class="form-label">Confirmer mot de passe</label>
                    <input type="password" class="form-control" id="password-2" name="password-2" required
                        pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        title="Saisir la confirmation du mot de passe" minlength="1" maxlength="20" size="20">
                </div>



                <button type="submit" class="btn btn-primary" name="update-user">mettre à jour</button>
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            </form>

        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>