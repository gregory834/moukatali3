
<?php
require '../../../config/config.php';
require ROOT_PATH . '/config/database.php';
date_default_timezone_set('Indian/Reunion');
require ROOT_PATH . '/src/controller/user-function.php';
require ROOT_PATH . '/src/controller/admin-function.php';
$nav = "gestion-user";

$all_users = getAllUsers();
$pseudo = $user['pseudo'];
$role = $user['role'];
$auth = $user['auth'];



include(ROOT_PATH. '/src/layout/head.php');
?>

</head>

  <title>Gestion Utilisateur | Moukat A Li</title>

  <body>
    
    <header class="header-main ">
      <div class="container">
      
      <?php include (ROOT_PATH . '/src/layout/navbar.php'); ?>
      
      </div>
    </header>




    <!-- SECTION -->
    <section>
      <div class="container">
        <h1 class="text-uppercase display-4 text-center py-3 mt-5">liste des moukateurs</h1>
        <table class="col-11 table table-bordered bg-secondary text-center text-light">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Pseudo</th>
              <th scope="col">Email</th>
              <th scope="col">Date d'inscription</th>
              <th scope="col">Etat du compte</th>
              <th scope="col">Supprimer</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($all_users as $key => $all_user) : ?>
            <?php if ( $all_user['role'] === "user" ): ?>
              <div class="user">
                <tr>
                  <th class="align-middle" scope="row"><?php echo $i; ?></th>
                  <td class="align-middle"><?php echo $all_user['pseudo']; ?></td>
                  <td class="align-middle"><?php echo $all_user['email']; ?></td>
                  <td class="align-middle"><?= dateToFrench($all_user['created_at'], 'd-m-Y') . '<br/>' . dateToFrench($all_user['created_at'], 'h:i') ?></td>
                  <td class="align-middle"> <?php echo $all_user['delete_account']; ?></td>
                  <td class="align-middle">
                    <a class="text-danger" href="gestion-user.php?delete-user=<?php echo $all_user['id']; ?>" role="button">
                      <svg width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                    </a>
                  </td>
                </tr>
              </div>
              <?php $i++ ; ?>
              <?php endif; ?>
            <?php endforeach; ?>

          </tbody>

        </table>
      </div>
    </section>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>