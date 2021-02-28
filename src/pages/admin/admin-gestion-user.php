<div class="text-light">
  <?php
  require '../../../config/config.php';
  require '../../../config/database.php';
  require '../../controller/user-function.php';
  // require '../../controller/user-function.php';

  // $user_info = readUserById($_SESSION['user']['pseudo']);

  global $all_users, $delete_id_user;


  $all_users = getAllUsers();
  
  include('../../layout/head.php');
  var_dump($user_info);

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