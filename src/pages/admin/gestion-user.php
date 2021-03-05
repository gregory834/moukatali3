<?php
require '../../../config/config.php';
require ROOT_PATH . '/config/database.php';

require ROOT_PATH . '/src/controller/admin-function.php';

$all_users = getAllUsers();

include('../../layout/head.php');

?>

</head>

  <title>Gestion User | Moukat A Li</title>

  <body>
    <!-- NABVAR ADMIN -->
    <header class="header-main ">
      <div class="container"> <?php include(BASE_URL . '/src/layout/nav-admin.php'); ?></div>
    </header>




    <!-- SECTION -->
    <section>
      <div class="container">
        <h1 class="text-uppercase display-4 text-center py-3 mt-5">liste des moukateurs</h1>
        <table class="col-11 table table-bordered bg-secondary text-center text-light">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Avatar</th>
              <th scope="col">Pseudo</th>
              <th scope="col">Email</th>
              <th scope="col">Date d'inscription</th>
              <th scope="col">Etat du compte</th>
              <th scope="col">Supprimer</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_users as $key => $all_user) : ?>
            <?php if ( $all_user['role'] === "user" ): ?>
              <div class="user">
                <tr>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td><?php echo $all_user['pseudo']; ?></td>
                  <td><?php echo $all_user['id']; ?></td>
                  <td><?php echo $all_user['email']; ?></td>
                  <td><?php echo $all_user['created_at']; ?></td>
                  <td><?php echo $all_user['delete_account']; ?></td>
                  <td class="align-middle">
                    <a class="text-dark" href="gestion-user.php?delete-user=<?= $all_user['id'] ?>" role="button">
                      <svg width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                  </td>
                </tr>
              </div>
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