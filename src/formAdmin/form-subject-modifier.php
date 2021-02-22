
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="../css/styles-admin.css"> -->
    
    <link rel="stylesheet" href="../../css/styleGreg.css">
    <link rel="stylesheet" href="../../css/mon-style.css">
    <link rel="stylesheet" href="../../css/styleDav.css">
    <title>Créer un sujet - Moukat A Li</title>
</head>

<body>

 <!-- HEADER -->
 <header class="header-liste" id="id-navbar">
    <div class="container ">
      <!-- NAVBAR -->
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand " href="index.php">
          <img src="../../images/logo_moukatali_noir.png" class="img-fluid" style="height:5vh;" alt="logo_moukatali_noir.png"></img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav ">
            <li class="nav-item ">
              <a class="nav-link text-center  font-weight-bold text-nav-head" href="admin.php">CREER PROFIL</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link text-center  font-weight-bold text-nav-head" href="form-subject-editer.php">CREER TOPICS</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link text-center  font-weight-bold text-nav-head" href="form-offre-create.php">CREER OFFRES</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link text-center  font-weight-bold text-nav-head" href="form-subject-modifier.php">MODIFIER PROFIL-OFFRE </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link text-center  font-weight-bold text-nav-head" href="moukateurs.php">LISTE MOUKATEURS</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link text-center  font-weight-bold text-nav-head disabled" href="profile.php">SIGNALER</a>
            </li>
            <li class="nav-item ">
              <a id="logout-link" class="nav-link text-center  font-weight-bold text-nav-head  <?= $btn_logout ?> " href="../index.php?logout='1'" role="button">LOGOUT</a>
            </li>

          </ul>
        </div>
      </nav>
    </div>
  </header>

<div class="text-light">  





    <!-- SECTION -->
    <section id="form-subject">
        <div class="container text-center">

                <h1 class="text-uppercase text-center py-3">modifier un topic</h1>
         
            <?php
include('../config.php');
include( '/admin/includes/admin-functions.php');
include( '/admin/includes/topic-functions.php');

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header('location: ../index.php');
}

?>

            <form method="post" action="form-subject.php" enctype="multipart/form-data">
                
                <!-- erreurs de validation du formulaire -->
				<?php include( '/includes/errors.php') ?>

                <!-- si vous modifiez un message, l'identifiant est requis pour identifier ce message -->
				<?php if ($update_topic === true): ?>
					<input type="hidden" name="topic-id" value="<?php echo $topic_id; ?>">
				<?php endif ?>
                <!-- Image -->
                <div class="form-group" id="preview">
                    <!--<span class="img-div">-->
                        <!--<div class="img-placeholder"  onClick="triggerClick()"></div>-->
                        <img src="../public/images/upload/<?= $topic_picture ?>" onClick="triggerClick()" id="profileDisplay" alt="Preview" style="height: 310px; width: 360px;">
                    <!--</span>-->
                    <label for="preview" class="form-label text-center"></label>
                    <input type="file" onChange="displayImage(this)" id="picture" class="form-control form-control-lg" name="picture" placeholder="Uploader une image">
                </div>
                <!-- Titre -->
                <div class="form-floating">
                    <input type="text" class="form-control" placeholder="Title" name="title" value="<?= $title ?>">
                    <label for="title">Titre</label>
                </div>
                <!-- Description -->
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="topic-description"><?= $topic_description ?></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>
                <!-- BOUTON -->
                <div class="d-grid gap-2">
                  <?php if ($update_topic == false): ?>
                    <button type="submit" class="btn btn-dark fw-bold text-uppercase mt-4 mb-5" name="create-topic">créer</button>
                  <?php else: ?>
                    <button type="submit" class="btn btn-secondary fw-bold text-uppercase mt-4 mb-5" name="update-topic">mettre à jour</button>
                  <?php endif ?>
                </div>
                

            </form>
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

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
        <script src="../public/js/script.js"></script>

</body>

</html>