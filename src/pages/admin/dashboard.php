<?php
require '../../../config/config.php';
require ROOT_PATH . '/config/database.php';

require ROOT_PATH . '/src/controller/user-function.php';
require ROOT_PATH . '/src/controller/admin-function.php';
$nav = "dashboard";

$admins = readAllAdmin();
//$pseudo = $user['pseudo'];
$role = $user['role'];
$auth = $user['auth'];

include(ROOT_PATH . '/src/layout/head.php');
?>

<title>Dashboard | Moukat A Li</title>

<body>
  
  <header class="header-main ">
    <div class="container">

    <?php include (ROOT_PATH . '/src/layout/navbar.php'); ?>

    </div>
  </header>

  <!-- SECTION -->
  <section id="form-admin">
    <div class="container">

      <h1 class="text-uppercase display-1 text-center py-3 mt-5">Tableau de bord</h1>
      
      <form method="POST" class="m-auto">
        <!-- MESSAGE D ERREUR -->
        <?php if (count($errors) > 0) : ?>
          <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) : ?>
              <p><?php echo $error ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif ?>

        <!-- LESSAGE SUCCESS -->
        <?php if (count($success) > 0) : ?>
          <div class="alert alert-success" role="alert">
            <?php foreach ($success as $successs) : ?>
              <p><?php echo ($successs); ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>


        <!-- ATTRIBUTION D UN ADMIN ID EN CHAMPS HIDDEN SUT ON UPDATE UN PROFIL -->
        <?php if ($update === true) : ?>
          <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
        <?php endif ?>


        <!-- PSEUDO -->
        <div class="mb-3">
          <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo" title="Choisir un pseudo ou un nom d'utilisateur" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" minlength="4" maxlength="30" size="30" value="<?php echo $pseudo; ?>">
        </div>


        <!-- PRENOM -->
        <div class="mb-3">
          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom" title="Veuillez inscrire votre Prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="<?php echo $first_name; ?>">
        </div>


        <!-- NOM -->
        <div class="mb-3">
          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom" title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="<?php echo $last_name; ?>">
        </div>


        <!-- EMAIL -->
        <div class="mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="<?php echo $email; ?>">
        </div>

        <!-- ASSIGNER UN ROLE -->
        <div class="mb-3">
          <select class="form-control" name="role">
            <option value="<?php echo $role; ?>" selected disabled>Assigner un rôle</option>
            <?php foreach ($roles as $role) : ?>
              <option value="<?php echo $role; ?>">
                <?php echo $role; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>


        <!-- PASSWORD -->
        <div class="mb-3">
          <input type="password" class="form-control" name="password_1" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1" maxlength="20" size="20" placeholder="Mot de passe">
        </div>


        <!-- PASSWORD CONFIRMATION -->
        <div class="mb-3">
          <input type="password" class="form-control" name="password_2" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1" maxlength="20" size="20" placeholder="Confirmer mot de passe">
        </div>


        <!-- BOUTONS CREATE OR UPDATE -->
        <!-- si on modifie l'utilisateur , on affiche le bouton de mise à jour au lieu du bouton de création -->


        <?php if ($update === true) : ?>
          <button type="submit" id="btn-update" class="btn btn-info fw-bold text-uppercase" name="update-admin">mettre à jour</button>
        <?php else : ?>
          <button type="submit" id="btn-create" class="btn btn-dark fw-bold text-uppercase" name="create-admin">créer un administrateur</button>
        <?php endif; ?>


      </form>
  </section>



  <section id="list-admin" class="py-5">
    <div class="container">
      <!--<h1>liste utilisateurs</h1>-->
      <!-- Display notification message -->
      <?php //include('/includes/messages.php'); 

      // echo ($admins['pseudo']);
      ?>

      <?php if (empty($admins)): ?>
        <h6 class="text-light text-center">AUCUN ADMIN</h6>
      <?php else: ?>
        <table class="table table-bordered text-light text-center">

          <thead class="text-uppercase">
            <tr>
              <th scope="col"></th>
              <th scope="col">nom d'utilisateur</th>
              <th scope="col">email</th>
              <th scope="col">rôle</th>
              <th colspan="2">actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($admins as $key => $admin): ?>
              <div class="user">
                <tr>
                  <?php //if ( $user['role'] = "admin" ): ?>
                  <th scope="row"><?php echo $key + 1; ?></th>
                  <td class="align-middle text-light"><?php echo $admin['pseudo']; ?></td>
                  <td class="align-middle text-light" style="font-size:2vh;"><?php echo $admin['email']; ?></td>
                  <td class="align-middle text-light" style="font-size:2vh;"><?php echo $admin['role']; ?></td>
                  <td class="align-middle">
                    <a class="text-light" href="dashboard.php?edit-admin=<?php echo $admin['id']; ?>" role="button">
                      <svg width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg>
                    </a>
                  </td>
                  <td class="align-middle">
                    <?php if ( $admin['id'] != $_SESSION['user']['id'] ): ?>
                    <a class="text-danger" href="dashboard.php?delete-admin=<?php echo $admin['id']; ?>" role="button">
                      <svg width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16" disabled>
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                    </a>
                    <?php endif; ?>
                  </td>
                  <?php //endif; ?>
                </tr>
              </div>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </section>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>