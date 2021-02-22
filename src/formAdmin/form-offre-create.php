<?php session_start(); 


?>

<!-- On a besoin de recupérér l id de celui qui est connecté et aussi son role  -->



<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- CSS -->
  <!-- <link rel="stylesheet" href="../css/styles-admin.css"> -->

  <link rel="stylesheet" href="../../css/styleGreg.css">
  <link rel="stylesheet" href="../../css/mon-style.css">
  <link rel="stylesheet" href="../../css/styleDav.css">
  <title>Créer une offre - Moukat A Li</title>
</head>


<div class="text-light">

  <!-- 88888888888888888888888888888888888888888888888888888 -->
  <!-- Récupération valeur de id ou du role en fonction donnée de session ok sur le formulaire, a voir sur les function des topivs a present -->
  <?php var_dump($_SESSION['user']['id']);
  // On recupere la valeur de l id en fonction de qui est connecter , on peut également vérifier son role en fonction de ses données de session avec un var_dump de session id
  $user_id = $_SESSION['user']['id'];
  var_dump($user_id);
  var_dump($_SESSION['user']['role']);
  // 88888888888888888888888888888888888888888888888888888 
  ?>

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

    <!-- SECTION -->
    <section id="form-subject">
      <div class="container text-center">

        <h1 class="text-uppercase text-center py-3">Crée un arcitcle ou un abonnement</h1>

        <?php
        include('../../functions/bdd-connect.php');
        include('../../functions/create-admin.php');
        include('../../functions/offre-functions.php');

        if (isset($_GET['logout'])) {
          session_destroy();
          unset($_SESSION['user']);
          header('location: ../index.php');
        }


 
  // 88888888888888888888888888888888888888888888888888888888888888888888
  $sql = "SELECT * FROM abonnement ORDER BY date_creation DESC";
  $pdoStat = $db->prepare($sql);
  $executeIsOk = $pdoStat->execute();
  // $listes_AllTpics = $pdoStat->fetchAll();
  $offres = $pdoStat->fetchAll();
  var_dump($offres);
  // 88888888888888888888888888888888888888888888888888888888888888888888
        ?>

        <form method="post" action="form-offre-create.php" enctype="multipart/form-data">

          <!-- erreurs de validation du formulaire -->
          <?php //'/includes/errors.php' 
          ?>


          <!-- si vous modifiez un message, l'identifiant est requis pour identifier ce message -->
          <?php if ($update_offre === true) : ?>
            <input type="hidden" name="offre-id" value="<?php echo $offre_id; ?>">
          <?php endif ?>
          <!-- Image -->
          <div class="form-group" id="preview">
            <!--<span class="img-div">-->
            <!--<div class="img-placeholder"  onClick="triggerClick()"></div>-->
            <img src="../../images/uploads/<?= $offre_picture ?>" onClick="triggerClick()" id="profileDisplay" alt="Preview" style="height: 310px; width: 360px;">
            <!--</span>-->
            <label for="preview" class="form-label text-center"></label>
            <input type="file" onChange="displayImage(this)" id="picture" class="form-control form-control-lg" name="picture" placeholder="Uploader une image">
          </div>
          <!-- Titre article -->
          <div class="form-floating">

            <input type="text" class="form-control text-dark" placeholder="Title" name="title" value="<?php echo $title; ?>">
            <label for="title">Articles</label>
          </div>
          <!-- Description article ou offre-->
          <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="offre-description" value="<?php echo $offre_description; ?>"></textarea>
            <label for="floatingTextarea2">Détail de l'article ou de l'abonnement</label>
          </div>
          <!-- Prix de l'article ou offre-->
          <div class="form-floating">
            <input type="number" class="form-control text-dark" placeholder="Prix de l'article" name="prix" min="0" value="<?php echo $prix; ?>">
            <label for="prix">Prix de l'article</label>
          </div>
          <!-- BOUTON -->
          <div class="d-grid gap-2">
          <?php if ($update_offre === true) : ?>
            <button type="submit" class="btn btn-dark fw-bold text-uppercase mt-4 mb-5" name="update-offre">mettre à jour</button>
            <?php else : ?>
            <button type="submit" class="btn btn-dark fw-bold text-uppercase mt-4 mb-5" name="create-offre">créer</button>
            <?php endif; ?>


            <!-- <button type="submit" class="btn btn-secondary fw-bold text-uppercase mt-4 mb-5" name="update-offre">mettre à jour</button> -->





          </div>


        </form>
        <?php
        // a modifier car déclaration temporaire
        // $success = array();
        global $errors, $success; ?>

        <?php global $errors, $success; ?>

        <div class="">

          <?php if (count($success > 0)) : ?>
            <div class="alert alert-success" role="alert">
              <?php foreach ($success as $successs) : ?>
                <p><?php echo ($successs); ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>


          <?php if (count($errors > 0)) : ?>
            <div class="alert alert-danger" role="alert">
              <?php foreach ($errors as $error) : ?>
                <p><?php echo ($error); ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </div>
    </section>

<!-- LISTE OFFRE ARTICLES OU ABONNEMENT -->
<div class=" ">


<section>
  <div class="container-fluid col-11  justify-content-center mt-5 mb-5">
    <h1 class="text-uppercase text-center py-3 mt-5 mb-5 pt-5">Listes des offres</h1>
    <!-- message -->
    <!-- include( '/includes/messages.php'); -->

    <?php if (empty($offres)) : ?>
      <h1 style="text-align: center; margin-top: 20px;">Aucun articles ou offres dans la base.</h1>
    <?php else : ?>

      <div class=" d-flex justify-content-center">

        <table class="col-11 table table-bordered bg-secondary  text-center text-light">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">N ID Admin</th>
              <th scope="col">Articles</th>
              <th scope="col">Prix</th>
              <th scope="col">Date de création</th>
              <th scope="col-3">Contenu</th>
              <th scope="col">Image</th>


              <!-- Seul l'administrateur peut publier / annuler la publication du message -->
              <?php if ($_SESSION['user']['role'] == "admin") : ?>
                <th scope="col">publier</th>
              <?php endif; ?>
              <th scope="col">mettre à jour</th>
              <th scope="col">supprimer</th>
            </tr>
          </thead>
          <tbody>
            <!-- 8888888888888888888888888888888888888888888888888 -->
            <?php foreach ($offres as $key => $offre) : ?>
              <div class="user">
                <tr>
                  <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                  <td class="align-middle"><?php echo $offre['user_id']; ?></td>
                  <td class="align-middle"><?php echo $offre['titre_article']; ?></td>
                  <td class="align-middle"><?php echo $offre['prix']; ?></td>
                  <td class="align-middle"><?php echo $offre['date_creation']; ?></td>
                  <td class="align-middle"><?php echo $offre['offre_description']; ?></td>
                  <td class="align-middle"><?php echo $offre['image']; ?></td>



                  <!-- Seul l'administrateur peut publier / annuler la publication du message -->
                  <?php if ($_SESSION['user']['role'] == "admin") : ?>
                    <td class="align-middle">
                      <?php if ($offre['published'] == 0) : ?>
                        <a href="form-offre-create.php?unpublish=<?= $offre['id'] ?>" role="button">
                          <svg width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                          </svg>
                        </a>
                      <?php else : ?>
                        <a href="form-offre-create.php?publish=<?= $offre['id'] ?>" role="button">
                          <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                          </svg>
                        </a>
                      <?php endif; ?>
                    </td>
                  <?php endif; ?>
                  <td class="align-middle">
                    <a class="text-dark" href="form-offre-create.php?edit-offre=<?= $offre['id'] ?>" role="button">
                      <svg width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg>
                    </a>
                  </td>
                  <td class="align-middle">
                    <a class="text-dark" href="form-offre-create.php?delete-offre=<?= $offre['id'] ?>" role="button">
                      <svg width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                      </svg>
                    </a>
                  </td>
                </tr>
              </div>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
    <!-- 8888888888888888888888888888888888888888888888888888888888888 -->
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


    <!-- FOOTER -->
    <footer class="text-center py-5 d-flex flex-column">
      <a href="#" class="mb-1">Contact</a>
      <a href="#" class="mb-1">C.G.V.</a>
      <a href="#" class="mb-1">C.G.U.</a>
      <a href="#">Mentions légales</a>
    </footer>

</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="../public/js/script.js"></script>

</body>

</html>