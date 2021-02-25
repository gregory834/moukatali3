<div class="text-light">
  <?php

  session_start();
  include('../../functions/bdd-connect.php');
  include('../../functions/create-admin.php');
  // récupére tous les administrateurs de la BDD ayant un rôle
  // $delete_id_user = 0;
  global $all_users, $delete_id_user;


  $all_users = getAllUsers();
  var_dump($all_users);

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../css/styles-admin.css"> -->
    <link rel="stylesheet" href="../../css/styleGreg.css">
    <link rel="stylesheet" href="../../css/mon-style.css">
    <link rel="stylesheet" href="../../css/styleDav.css">

    <title>Espace Administrateur - Moukat A Li</title>
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
                <a class="nav-link text-center  font-weight-bold text-nav-head" href="form-subject-editer.php">EDITER TOPICS</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-center  font-weight-bold text-nav-head" href="form-offre-create.php">CREER OFFRE</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-center  font-weight-bold text-nav-head" href="form-subject-modifier.php">MODIFIER PROFIL-OFFRE </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-center  font-weight-bold text-nav-head" href="topics.php">LISTE TOPICS</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-center  font-weight-bold text-nav-head" href="topics.php">LISTE OFFRES</a>
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
    <section>
      <div class="container">
        <h1 class="text-uppercase text-center py-3">liste des moukateurs</h1>
        <table class="col-11 table table-bordered bg-secondary  text-center text-light">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom d'utilisateur</th>
              <th scope="col">N ID user</th>
              <th scope="col">Email</th>
              <th scope="col">Genre</th>
              <th scope="col">Date d'inscription</th>
            </tr>
          </thead>
          <tbody>

            <!-- 8888888888888888888888888888888888888888888888888888 -->
            <?php foreach ($all_users as $key => $all_user) : ?>
              <div class="user">
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><?php echo $all_user['pseudo']; ?></td>
                  <td><?php echo $all_user['id']; ?></td>
                  <td><?php echo $all_user['email']; ?></td>
                  <td><?php echo $all_user['genre']; ?></td>
                  <td><?php echo $all_user['date_inscription']; ?></td>
                  <!-- <td class="align-middle">
                    <a class="text-dark" href="moukateurs.php?edit-user=<" role="button">
                          <svg width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                          </svg>
                        </a> -->
                  <td class="align-middle">
                    <a class="text-dark" href="moukateurs.php?delete-user=<?= $all_user['id'] ?>" role="button">
                      <svg width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                      </svg>
                  </td>
                </tr>

              </div>
            <?php endforeach; ?>

          </tbody>

        </table>
      </div>
    </section>

</div>
<!-- FOOTER -->
<footer class="text-center py-5 d-flex flex-column">
  <a href="#" class="mb-1">Contact</a>
  <a href="#" class="mb-1">C.G.V.</a>
  <a href="#" class="mb-1">C.G.U.</a>
  <a href="#">Mentions légales</a>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>