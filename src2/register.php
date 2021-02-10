<?php
include('config.php');
// pour gérer l'enregistrement et la connexion
include('functions/registration-login.php');
?>

<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Spirax&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <!-- OWL CAROUSEL -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" />
  <!-- CSS -->
  <link rel="stylesheet" href="public/css/styles.css">

  <title>Inscription - Moukat A Li</title>
</head>

<body>
  <!---------- HEADER ---------->
  <header id="login-register">
    <div class="container">
        <!-- NAVIGATION -->
        <nav class="navbar navbar-expand-lg navbar-dark border-bottom">
        <div class="container-fluid">
            <!-- LOGO -->
            <a class="navbar-brand text-uppercase fw-light px-1 py-0" href="index.php">moukat a li</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarNav">
            <ul class="navbar-nav text-uppercase">
                <li class="nav-item">
                <a href="index.php" class="text-black">
                  <svg width="50" height="50" fill="currentColor" class="bi bi-x text-light" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                  </a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </div>
  </header>
  
  <!---------- SECTION ---------->
  <section id="form-login" class="h-100">
    <div class="container d-flex flex-column justify-content-center align-items-center p-5">
    
    <h5 class="fw-light text-uppercase">inscription</h5>
    <form method="post" action="register.php" class="text-center px-3">
            <!-- MESSAGE D'ERREUR-->
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
            <!-- PSEUDO -->
            <div class="mb-3 text-start">
              <label for="username" class="form-label">Pseudo</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Tibili 974"
                title="Choisir un pseudo ou un nom d'utilisateur" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$"
                minlength="4" maxlength="30" size="30" value="">
            </div>
            <!-- PRENOM -->
            <div class="mb-3 text-start">
              <label for="first-name" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Vinshan"
                title="Veuillez inscrire votre Prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4"
                maxlength="50" size="50" value="">
            </div>
            <!-- NOM -->
            <div class="mb-3 text-start">
              <label for="last-name" class="form-label">Nom</label>
              <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Dupont"
                title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50"
                size="50" value="">
            </div>
            <!-- EMAIL -->
            <div class="mb-3 text-start">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com"
                title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
            </div>
            <!-- TELEPHONE -->
            <div class="mb-3 text-start">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="0692010203"
                title="Inscrire votre numéro de téléphone (format 00 00 00 00 00)" required
                pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" value="">
            </div>
            <!-- MOT DE PASSE -->
            <div class="mb-3 text-start">
              <label for="password-1" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password-1" name="password-1"
                title="Saisir un mot de passe" required
                pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1" maxlength="20"
                size="20" value="">
            </div>
            <div class="mb-3 text-start">
              <label for="password-2" class="form-label">Confirmer mot de passe</label>
              <input type="password" class="form-control" id="password-2" name="password-2" required
                pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                title="Saisir la confirmation du mot de passe" minlength="1" maxlength="20" size="20" value="">
            </div>
          
        
        
          <button type="submit" class="btn btn-primary border-0 fw-bold text-uppercase" name="register">s'inscrire</button>
        
        </form>

    </div>
  </section>


  <!-- Optional JavaScript; choose one of the two! -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>
  <script src="public/js/slider.js"></script>
</body>

</html>