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
  <link rel="stylesheet" href="../public/css/styles.css">

  <title>Espace Administrateur - Moukat A Li</title>
</head>

<body>
  <!-- HEADER -->
  <header id="admin">
    <div class="container">
      <nav class="navbar navbar-dark">
      <a class="navbar-brand text-uppercase fw-light px-1 py-0" href="../index.php">moukat a li</a>
        <ul class="nav justify-content-end text-uppercase align-items-center">
          <li class="nav-item">
            <a class="nav-link text-light fw-light border" href="form-subject.php">créer</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light fw-light" href="dashboard.php">dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light fw-light" href="topics.php">topics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-light disabled" href="#">signaler</a>
          </li>
          <li class="nav-item">
              <a id="logout-link" class="nav-link btn text-white text-uppercase fw-bold rounded-0 border-0 <?= $btn_logout ?>" href="../index.php?logout='1'" role="button">logout</a>
          </li>
        </ul>
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