<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- CSS -->
  <!-- <link rel="stylesheet" href="../css/styles-admin.css"> -->
  <!-- style.css -->
  <link rel="stylesheet" href="../../css/styleGreg.css">
  <link rel="stylesheet" href="../../css/mon-style.css">
  <link rel="stylesheet" href="../../css/styleDav.css">

  <title>Espace Administrateur | Moukat A Li</title>
</head>

<body>
  <!-- _______________________________________________________________________________________________________________ -->

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
    <section id="form-admin">
      <div class="container">

        <h1 class="text-uppercase text-center py-3 mt-5">DASHBOARD administrateur</h1>
        

        <form method="POST" action="form-admin-create.php" class="m-auto">
          <!-- MESSAGE D'ERREUR-->

          <!-- Ici les values avec echo servirons à afficher les champs pré-remplies que si on est Administrateur, Autheur ou autre etc -->
          <!-- PSEUDO -->
          <div class="mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="pseudo" title="Choisir un pseudo ou un nom d'utilisateur" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" minlength="4" maxlength="30" size="30" value="">
          </div>
          <!-- PRENOM -->
          <div class="mb-3">
            <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Prénom" title="Veuillez inscrire votre Prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="">
          </div>
          <!-- NOM -->
          <div class="mb-3">
            <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Nom" title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="">
          </div>
          <!-- EMAIL -->
          <div class="mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
          </div>
          <!-- 888888888888888888888888888888888888888888888 -->
          <!-- ROLE OK FONCTIONNE MEME SI SA AFFCHIGE DANS L INOUT SANS LA MAJUSCULE-->
          <div class="mb-3">
          <select class="form-control" name="role">
            <option value="" selected disabled>Assigner un rôle</option>
            <option value="Admin">
            <option value="Author">
            <option value="Moderator">
            <option value="User">
            </option>
          </select>
        </div>
          <!-- 888888888888888888888888888888888888888888888 -->
          <!-- MOT DE PASSE -->
          <div class="mb-3">
            <input type="password" class="form-control" id="password-1" name="password-1" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1" maxlength="20" size="20" placeholder="Mot de passe">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="password-2" name="password-2" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="1" maxlength="20" size="20" placeholder="Confirmer mot de passe">
          </div>
          <!-- BOUTONS -->
          <!-- si on modifie l'utilisateur , on affiche le bouton de mise à jour au lieu du bouton de création -->
          <!-- 8888888888888888888888888888888888888888888888888888888 -->
          
            <button type="submit" id="btn-update" class="btn fw-bold text-uppercase" name="update-admin">mettre à jour</button>
          
            <button type="submit" id="btn-create" class="btn btn-dark fw-bold text-uppercase" name="create-admin">créer un administrateur</button>
          
          <!-- 8888888888888888888888888888888888888888888888888888888 -->
          <!-- on garde cette parti au cas ou le switch des boutons dérange trop -->
          <!-- <button type="submit" id="btn-update" class="btn fw-bold text-uppercase" name="update-admin">mettre à jour</button>

        <button type="submit" id="btn-create" class="btn btn-dark fw-bold text-uppercase" name="create-admin">créer un administrateur</button> -->
          <!-- 8888888888888888888888888888888888888888888888888888888 -->
        </form>
        

        
      </div>
    </section>




    <!-- 8888888888888888888888888888888888888888888888888888888 -->
    <section id="list-admin" class="py-5">
      <div class="container">
        <!--<h1>liste utilisateurs</h1>-->
        <!-- Display notification message -->
        <?php //include('/includes/messages.php'); 





        // echo ($admins['pseudo']);
        ?>

        
          <h6>AUCUN ADMIN</h6>
        
          <table class="table table table-bordered bg-secondary  text-center text-light">

            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">nom d'utilisateur</th>
                <th scope="col">email</th>
                <th scope="col">rôle</th>
                <th colspan="2">actions</th>
              </tr>
            </thead>
            <tbody>
             
                <div class="user">
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle"><a style="color:black;font-size:2vh;" href="#">1</a></td>
                    <td class="align-middle" style="color:black;font-size:2vh;">2</td>
                    <td class="align-middle" style="color:black;font-size:2vh;">3 </td>
                    <td class="align-middle">
                      <a class="text-dark" href="form-admin-create.php?edit-admin=<?php echo $ligne_AdminAuthorModerator['id']; ?>" role="button">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                      </a>
                    </td>
                    <td class="align-middle">
                      <a class="text-dark" href="form-admin-create.php?delete-admin=<?php echo $ligne_AdminAuthorModerator['id']; ?>" role="button">
                        <svg width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                      </a>
                    </td>
                  </tr>
                </div>
            
            </tbody>
          </table>
       
      </div>
    </section>

    <!-- 8888888888888888888888888888888888888888888888888888888 -->



    <!-- FOOTER -->
    <footer class="text-center py-5 d-flex flex-column">
      <a href="#" class="mb-1">Contact</a>
      <a href="#" class="mb-1">C.G.V.</a>
      <a href="#" class="mb-1">C.G.U.</a>
      <a href="#">Mentions légales</a>
    </footer>
  </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>