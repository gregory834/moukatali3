<?php

include('../config.php');
include(ROOT_PATH . '/functions/registration-login.php');
include(ROOT_PATH . '/functions/functions.php');

$user = getUserById($_SESSION['user']['user_id']);
$comments_user = postUserTopic($_SESSION['user']['user_id']);

if (isset($_GET['logout'])) {

    session_destroy();
    unset($_SESSION['user']);
    header('location: ../index.php');

}
/*
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
echo '<pre>';
var_dump($user);
echo '</pre>';
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
    <link rel="stylesheet" href="../public/css/styles.css">

    <title>Espace Moukateur - Moukat A Li</title>
</head>

<body>
    <!-- HEADER -->
    <header id="admin">
    <div class="container">
      <nav class="navbar navbar-dark">
      <a class="navbar-brand text-uppercase fw-light px-1 py-0" href="../index.php">moukat a li</a>
        <ul class="nav justify-content-end text-uppercase align-items-center">
          <li class="nav-item">
            <a class="nav-link btn text-white text-uppercase fw-bold rounded-0 border-0" href="form-edit.php?edit-user=<?php echo $user['user_id']; ?>">modifier mon profil</a>
          </li>
          <li class="nav-item">
              <a id="logout-link" class="nav-link btn text-white text-uppercase fw-bold rounded-0 border-0 <?= $btn_logout ?>" href="../index.php?logout='1'" role="button">logout</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
    <section>
        <div class="container text-center">
            <h1 class="text-uppercase text-center py-3">espace moukateur</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">nom d'utilisateur</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">email</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Mes points</th>
                <th scope="col">Statut</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                <td class="align-middle"><?php echo $user['username']; ?></td>
                <td class="align-middle"><?php echo $user['first_name']; ?></td>
                <td class="align-middle"><?php echo $user['last_name']; ?></td>
                <td class="align-middle"><?php echo $user['email']; ?></td>
                <td class="align-middle"><?php echo $user['phone']; ?></td>
                <td class="align-middle"><?php echo $user['my_points']; ?></td>
                <td class="align-middle"><?php echo $user['user_status']; ?></td>
                </tr>
            </tbody>
        </table>
        </div>
    </section>

    <section>
        <div class="container text-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Sujet</th>
                    <th scope="col">Commentaires</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments_user as $key => $comment_user): ?>
                    <tr>
                    <td class="align-middle"><?php echo $comment_user['title']; ?></td>
                    <td class="align-middle"><?php echo $comment_user['post']; ?></td>
                    </tr>
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