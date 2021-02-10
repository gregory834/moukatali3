<?php
include('../config.php');
include(ROOT_PATH . '/admin/includes/topic-functions.php');
// récupére tous les topics de la BDD
$topics = getAllTopics();

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header('location: ../index.php');
}
/*
$results = mysqli_query($db, "SELECT * FROM topic ORDER BY publication_date DESC");
$topics = mysqli_fetch_all($results, MYSQLI_ASSOC);
*/
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
  <link rel="stylesheet" href="../css/styles-admin.css">

  <title>Espace Administrateur - Topics - Moukat A Li</title>
</head>



  <body>

      <!-- HEADER -->
  <header class="header-liste" id="id-navbar">
    <div class="container ">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand " href="index.html">
                <img src="../images/logo_moukatali_noir.png" class="img-fluid" style="height:5vh;"
                    alt="logo_moukatali_noir.png"></img>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ">
                  <li class="nav-item ">
                    <a class="nav-link text-center  font-weight-bold text-nav-head"
                        href="admin.html">CREER</a>
                </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head"
                            href="form-subject.html">EDITER</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head"
                            href="topics.html">TOPICS</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head"
                            href="moukateurs.html">MOUKATEURS</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head disabled"
                            href="profile.html">SIGNALER</a>
                    </li>
                    <li class="nav-item ">
                      <a id="logout-link" class="nav-link text-center  font-weight-bold text-nav-head  <?= $btn_logout ?> "
                        href="../index.php?logout='1'" role="button">LOGOUT</a>
                  </li>

                </ul>
            </div>
        </nav>
    </div>
</header>


    <section>
      <div class="container">
      <h1 class="text-uppercase text-center py-3">topics</h1>
        <!-- message -->
			  <?php include(ROOT_PATH . '/includes/messages.php'); ?>

        <?php if (empty($topics)): ?>
				<h1 style="text-align: center; margin-top: 20px;">Aucun sujet dans la base.</h1>
			  <?php else: ?>
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">auteur</th>
              <th scope="col">titre</th>
              <th scope="col">nb de commentaires</th>
              <th scope="col">likes</th>
              <th scope="col">unlikes</th>
              <!-- Seul l'administrateur peut publier / annuler la publication du message -->
              <?php if ($_SESSION['user']['role'] == "admin"): ?>
              <th scope="col">publier</th>
              <?php endif; ?>
              <th scope="col">mettre à jour</th>
              <th scope="col">supprimer</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($topics as $key => $topic): ?>
            <div class="user">
              <tr>
                <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                <td class="align-middle"><?php echo $topic['author']; ?></td>
                <td class="align-middle"><?php echo $topic['title']; ?></td>
                <td class="align-middle"><?php echo $topic['nb_comment']; ?></td>
                <td class="align-middle"><?php echo $topic['vote_for']; ?></td>
                <td class="align-middle"><?php echo $topic['vote_against']; ?></td>
                <!-- Seul l'administrateur peut publier / annuler la publication du message -->
			          <?php if ($_SESSION['user']['role'] == "admin" ): ?>
                <td class="align-middle">
                  <?php if ($topic['published'] == 1): ?>
                  <a href="topics.php?unpublish=<?= $topic['id'] ?>" role="button">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                  </a>
                  <?php else: ?>
                  <a href="topics.php?publish=<?= $topic['id'] ?>" role="button">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                  </a>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <td class="align-middle">
                  <a class="text-dark" href="form-subject.php?edit-topic=<?= $topic['id'] ?>" role="button">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                  </a>
                </td>
                <td class="align-middle">
                  <a class="text-dark" href="topics.php?delete-topic=<?= $topic['id'] ?>" role="button">
                  <svg width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
                  </svg>
                  </a>
                </td>
              </tr>
            </div>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>

      </div>
    </section>

        <!-- FOOTER -->

        <footer class=" box-footer  text-center pt-4 mt-5  justify-content-center">
          <a href="#" class="m-2   text-nav-foot">Contact</a>
          <a href="#" class="m-2  text-nav-foot">C.G.V</a>
          <a href="#" class="m-2  text-nav-foot">C.G.U</a>
          <a href="#" class="m-2  text-nav-foot">Mentions légales</a>
      
      
      </footer>

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