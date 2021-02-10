<?php

include('config.php');
// pour gérer l'enregistrement et la connexion
include('functions/registration-login.php');
include('functions/commentaire.php');

?>
<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Spirax&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- OWL CAROUSEL -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
  <!-- CSS -->
  <link rel="stylesheet" href="public/css/styles.css">

  <title>Moukat A Li</title>
</head>

<body>


  <!---------- HEADER ---------->
  <header id="home">
    <div class="container">
      <!-- NAVIGATION -->
      <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
          <!-- LOGO -->
          <a class="navbar-brand text-uppercase fw-light px-1 py-0" href="#">moukat a li</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarNav">
          <?php if (empty($_SESSION['user'])): ?>
          <ul class="navbar-nav text-uppercase">
            <li class="nav-item me-md-3">
              <a class="nav-link" href="register.php">inscription</a> 
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">connexion</a>
            </li>
          </ul>
          <?php elseif (isset($_SESSION['user']['role'])): ?>
          <ul class="navbar-nav text-uppercase align-items-center">
          <li class="nav-item me-3">
            <span>bienvenue <?php echo $_SESSION['user']['username'] ?></span>
          </li>
          <li class="nav-item me-md-3">
            <a class="nav-link" href="admin/dashboard.php">dashboard</a>
          </li>
          <li class="nav-item">
            <a id="logout-link" class="nav-link btn btn-secondary text-white text-uppercase fw-bold rounded-0 border-0 <?= $btn_logout ?>" href="index.php?logout='1'" role="button">log out</a>
          </li>
          </ul>
          <?php else: ?>
            <ul class="navbar-nav text-uppercase align-items-center">
          <li class="nav-item me-3">
            <span>bienvenue <?php echo $_SESSION['user']['username'] ?></span>
          </li>
          <li class="nav-item me-md-3">
            <a class="nav-link" href="user/user-area.php">mon espace</a>
          </li>
          <li class="nav-item">
            <a id="logout-link" class="nav-link btn btn-secondary text-white text-uppercase fw-bold rounded-0 border-0 <?= $btn_logout ?>" href="index.php?logout='1'" role="button">log out</a>
          </li>
          </ul>
          <?php endif; ?>
            
          </div>
        </div>
      </nav>
      <!-- TEXTE -->
      <div id="title" class="d-flex justify-content-center justify-content-md-start align-items-center text-uppercase fw-bolder border-bottom">
        <h1>&quot;moukatage&quot;</h1>
      </div>
      <!-- TEXTE -->
      <div id="tagline" class="py-3 d-md-flex justify-content-md-end fw-bold text-lg-center">

        <div class="owl-carousel owl-theme">
          
          <div class="item">
            <h4 class="fw-bold">Définition:</h4>
            <p>(Railler, se moquer de quelqu'un, voire critiquer).</p>
            <p>Celà peut se faire sous forme de:</p>
            <p>&lowast; Jeux de mots<br />&lowast; Punchline (phrase qui à pour but d'impacté le lecteur)</p>
          </div>
          <div class="item">
            <h4 class="fw-bold">Périmètre d'utilisation:</h4>
            <p>L'utlisateur peut exprimer ses idées, son mécontentement, ou ses phrases humoristique:</p>
            <p>&lowast; en soulignant des inchorénces et contradiction dans un disours, une action ou d'un
              profil.<br />&lowast; en caricaturant un trait physique ou un aspect de caractère d'une personnalité
              ou d'un évènement donné.</p>
          </div>
          <div class="item">
            <h4 class="fw-bold">Philosophie et objectif:</h4>
            <p>&lowast; &quot;Moukate A Li&quot; à pour but de faire appel à votre créativité en partageant votre
              opinion, sous forme de "moukatage" vous permettant faire rire, de convaincre les autres utilisateurs
              en convergent les point de vues et opinions.</p>
            <p>&quot;Un moukatage peut être constructif, nous montrer une autre perspective, faire rire, peu piqué
              un peu mais n'a pas pour but de faire appel à la haine.&quot;</p>
          </div>
          
        </div>

      </div>
  </header>
  <!-- MODAL INSCRIPTION -->
  <div class="modal fade" id="register-form" tabindex="-1" aria-labelledby="register-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">inscription</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?php if ($success_reg == true) : ?>
          <div class="modal-body text-center">
            <div class="alert alert-success" role="alert">Inscription réussie</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#login-form">connexion</button>
          </div>
        <?php else : ?>
          <div class="modal-body">
            <form method="post">
              <!-- MESSAGE D'ERREUR-->
              <?php include(ROOT_PATH . '/includes/errors.php') ?>
              <!-- PSEUDO -->
              <div class="mb-3">
                <label for="username" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Tibili 974" title="Choisir un pseudo ou un nom d'utilisateur" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" minlength="4" maxlength="30" size="30" value="">
              </div>
              <!-- PRENOM -->
              <div class="mb-3">
                <label for="first-name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Vinshan" title="Veuillez inscrire votre Prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="2" maxlength="50" size="50" value="">
              </div>
              <!-- NOM -->
              <div class="mb-3">
                <label for="last-name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="last-name" name="last-name" placeholder="DUPONT" title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="2" maxlength="50" size="50" value="">
              </div>
              <!-- EMAIL -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
              </div>
              <!-- TELEPHONE -->
              <div class="mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="06 92 01 02 03" title="Inscrire votre numéro de téléphone (format 00 00 00 00 00)" required pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" value="">
              </div>
              <!-- MOT DE PASSE -->
              <div class="mb-3">
                <label for="password-1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password-1" name="password-1" title="Saisir un mot de passe" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1" maxlength="20" size="20" value="">
              </div>
              <div class="mb-3">
                <label for="password-2" class="form-label">Confirmer mot de passe</label>
                <input type="password" class="form-control" id="password-2" name="password-2" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Saisir la confirmation du mot de passe" minlength="1" maxlength="20" size="20" value="">
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
            <button type="submit" class="btn btn-primary" name="register">s'inscrire</button>
          </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- MODAL CONNEXION -->
  <div class="modal fade" id="login-form" tabindex="-1" aria-labelledby="login-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">connexion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
            <!-- PSEUDO -->
            <div class="mb-3">
              <label for="username" class="form-label">Pseudo</label>
              <input type="text" class="form-control" id="username" name="username" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" minlength="1" maxlength="30" size="30">
            </div>
            <!-- MOT DE PASSE -->
            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1" maxlength="20" size="20">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
          <button type="submit" class="btn btn-primary" name="login">se connecter</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!---------- SECTION ---------->
  <section id="moukatage" class="py-4">
    <div class="container">

      <!-- SUJET -->
      <div id="subject">
        <div class="mb-3 border m-auto" id="box"></div>
        <h2 class="text-uppercase">ZOREIL DEHORS ! TER LA C LA REUNION !</h2>
        <p>(Il défend la réunion. Personne nous dit quoi faire chez soi !)
          Koi ou en pense ? Li la bien fait ou bien lo zistoir va atisse le racisme ?
          Domoun en france va croire que nous lé bande sauvage ?</p>

        <!----------------  FONCTION COMMENTAIRE ----------------------------------->

        <!----------------  FONCTION COMMENTAIRE --------------------- -------------->


        <!-------------------------------------------------------------------------->

        <!-- PUBLIER -->
        <div>
          <form method="post" action="index.php">
            <div class="form-floating mb-1">
              <input type="text" class="form-control" name="posted-comment">
              <label name="posted" for="posted">publier un moukatage</label>
            </div>
            <div>
              <button type="submit" class="btn w-100 text-white text-uppercase fw-bolder" name="posted">publier</button>
              <input type="hidden" name="topic-id" value="<?php echo $topic['id']; ?>" />
            </div>
          </form>
        </div>
      </div>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <?php include(ROOT_PATH . '/includes/messages.php'); ?>

      
      
      <!-- POST -->
      <div id="post" class="mt-5">
      <?php if (empty($comments_join)): ?>
      <h6 class="text-center text-info">AUCUN COMMENTAIRES POUR L'INSTANT</h6>
      <?php else: ?>
        <!-- NB COM & TRIER-->
        <div id="sort-by" class="d-flex justify-content-between align-items-center mb-3">

          <p class="text-white mb-0">2 commentaires</p>

          <select class="form-select form-select-sm">
            <option selected>Trier</option>
            <option value="1">Par pertinence</option>
            <option value="2">Par date</option>
          </select>

        </div>


   <?php 
   afficher();
   ?>
        <!-- COMMENTAIRES -->
        <!-- #01 -->
        <?php foreach ($comments_join as $key => $comment): ?>
        <div class="comment-box text-dark mb-3">
          <!-- classement & username -->
          <div class="d-flex justify-content-between">
            <p class="d-flex align-items-center"><span class="badge me-1">#10</span><?php echo $comment['username']; ?></p>
            <p><?php echo $comment['publication_date']; ?></p>
          </div>
          <!-- publication -->
          <div>
            <p><?php echo $comment['post']; ?></p>
          </div>

          <div class="vote d-flex">
            <!-- like -->
            <div class="vote-for me-3">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up">
                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                </path>
              </svg>
              <span class="badge rounded-pill bg-dark text-white"><?php echo $comment['vote_for']; ?></span>
            </div>
            <!-- dislike -->
            <div class="vote-against">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-down">
                <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17">
                </path>
              </svg>
              <span class="badge rounded-pill bg-dark text-light"><?php echo $comment['vote_against']; ?></span>
            </div>

          </div>

        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <!---------------------------------------->
        <!-- #02 -->
        <!--
        <div class="comment-box text-dark mb-3">

          <div class="d-flex justify-content-between">
            <p class="d-flex align-items-center"><span class="badge me-1">#10</span>GregA</p>
            <p>15/01/21</p>
          </div>

          <div>
            <p>Mwin mi trouve que c'était just un quiproqo que la dérapé. La réunion le sang lé chaud aussi!</p>
          </div>

          <div class="vote d-flex">

            <div class="vote-for me-3">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up">
                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                </path>
              </svg>
              <span class="badge rounded-pill bg-dark text-white">10</span>
            </div>

            <div class="vote-against">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-down">
                <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17">
                </path>
              </svg>
              <span class="badge rounded-pill bg-dark text-light">5</span>
            </div>

          </div>

        </div>


        

      </div>

    </div>
  </section>



  <footer class="py-5 text-center text-uppercase fw-bolder text-white">footer</footer>


  <!-- Optional JavaScript; choose one of the two! -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
  <script src="public/js/slider.js"></script>
</body>

</html>