<?php

include('../config.php');
include(ROOT_PATH . '/admin/includes/admin-functions.php');
// récupére tous les administrateurs de la BDD ayant un rôle
$all_users = getAllUsers();

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
  <link rel="stylesheet" href="../css/styles-admin.css">

  <title>Espace Administrateur - Moukat A Li</title>
</head>

<body>

  <!-- HEADER -->
  <header class="header-liste" id="id-navbar">
    <div class="container ">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand " href="index.php">
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
                        href="admin.php">CREER</a>
                </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head"
                            href="form-subject.php">EDITER</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head"
                            href="topics.php">TOPICS</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head"
                            href="moukateurs.php">MOUKATEURS</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center  font-weight-bold text-nav-head disabled"
                            href="profile.php">SIGNALER</a>
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



  <!-- SECTION -->
  <section>
    <div class="container">
    <h1 class="text-uppercase text-center py-3">liste des moukateurs</h1>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom d'utilisateur</th>
            <th scope="col">Email</th>
            <th scope="col">Mes points</th>
            <th scope="col">Date d'inscription</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($all_users as $key => $all_user): ?>
            <div class="user">
              <tr>
                <th scope="row"><?php echo $key + 1; ?></th>
                <td><?php echo $all_user['username']; ?></td>
                <td><?php echo $all_user['email']; ?></td>
                <td><?php echo $all_user['my_points']; ?></td>
                <td><?php echo $all_user['registration_date']; ?></td>
              </tr>
            </div>
            <?php endforeach; ?>
        </tbody>
      </table>
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