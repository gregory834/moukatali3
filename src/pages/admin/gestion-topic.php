<?php
require '../../../config/config.php';
require ROOT_PATH . '/config/database.php';

require ROOT_PATH . '/src/controller/user-function.php';
require ROOT_PATH . '/src/controller/admin-function.php';
require ROOT_PATH . '/src/controller/topic-function.php';
$nav = "gestion-topic";

$topics = readAllTopics();
$pseudo = $user['pseudo'];
$role = $user['role'];
$auth = $user['auth'];


include(ROOT_PATH. '/src/layout/head.php');
?>

</head>

<title>Gestion Topics | Moukat A Li</title>

<body>
  <!-- HEADER -->
  <header class="header-main ">
    <div class="container">

    <?php include (ROOT_PATH . '/src/layout/navbar.php'); ?>

    </div>
  </header>

    <!-- SECTION -->
    <section id="form-subject">
      <div class="container text-center">

      <h1 class="h1-section text-light text-uppercase display-4 text-center py-3 mt-5">Gestion des Topics</h1>

        <form method="post" action="gestion-topic.php" enctype="multipart/form-data">

        <?php if ( count($success) > 0 ) : ?>
            <div class="alert alert-success" role="alert">
              <?php foreach ($success as $successs) : ?>
                <p class="mb-0"><?php echo ($successs); ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if ( count($errors_topic) > 0 ) : ?>
            <div class="alert alert-danger" role="alert">
              <?php foreach ($errors_topic as $error) : ?>
                <p class="mb-0"><?php echo ($error); ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- si vous modifiez un message, l'identifiant est requis pour identifier ce message -->
          <?php if ($update_topic === true) : ?>
            <input type="hidden" name="topic-id" value="<?php echo $topic_id; ?>">
          <?php endif ?>

          <!-- Image -->
          <div class="form-group" id="preview">
            <!--<span class="img-div">-->
            <!--<div class="img-placeholder"  onClick="triggerClick()"></div>-->
            <img src="" onClick="triggerClick()" id="profileDisplay" alt="Preview" style="height: 300px; width: 370px;" class="mb-3">
            <!--</span>-->
            <label for="preview" class="form-label text-center"></label>
            <input type="file" onChange="displayImage(this)" id="image" class="form-control form-control-lg" name="image" placeholder="Uploader une image">
          </div>

          <!-- Titre -->
          <div class="form-floating">
            <input type="text" class="form-control" placeholder="Title" name="title" value="<?= $title ?>">
            <label for="title">Titre</label>
          </div>
    
          <!-- BOUTON -->
          <div class="d-grid gap-2">
          <?php if ($update_topic === true) : ?>
            <button type="submit" id="btn-update" class="btn btn-info fw-bold text-uppercase mt-4 mb-5" name="update-topic">mettre à jour</button>
          <?php else : ?>
            <button type="submit" class="btn btn-dark fw-bold text-uppercase mt-4 mb-5" name="create-topic">créer</button>
          <?php endif; ?>

          </div>

        </form>
    </section>

    <!-- SECTION -->
    <section>
      <div class="container-fluid col-11  justify-content-center mt-5 mb-5">
        <h1 class="h1-section text-light text-uppercase text-center py-3 mt-5 mb-5 pt-5">Listes topics</h1>
        <!-- message -->
        <!-- include( '/includes/messages.php'); -->

        <?php if (empty($topics)) : ?>
          <div class="text-info text-center text-uppercase py-3">
            <p class="mb-0">Aucun topic créé pour le moment.</p>
          </div>
        <?php else : ?>
          <div class=" d-flex justify-content-center">
            <table class="col-11 table table-bordered bg-secondary  text-center text-light">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Intitulé</th>
                  <th scope="col">Date de création</th>
                  <th scope="col">Image</th>

                  <!-- Seul l'administrateur peut publier / annuler la publication du message -->
                  <?php //if ( $_SESSION['user']['role'] === "admin" || $_SESSION['user']['role'] === "author" ) : ?>
                    <th scope="col">publier</th>
                  <?php //endif; ?>
                
                  <th scope="col">mettre à jour</th>
                  <th scope="col">supprimer</th>
             
                </tr>
              </thead>
              <tbody>
                <!-- 8888888888888888888888888888888888888888888888888 -->
                <?php foreach ($topics as $key => $topic) : ?>
                  <div class="user">
                    <tr>
                      <th scope="row" class="align-middle"><?php echo $key + 1; ?></th>
                      <td class="align-middle"><?php echo $topic['title']; ?></td>
                      <td class="align-middle"><?php echo $topic['created_at']; ?></td>
                      <td class="align-middle"><?php echo $topic['image']; ?></td>

                      <!-- Seul l'administrateur peut publier / annuler la publication du message -->
                      <?php //if ( $_SESSION['user']['role'] === "admin" || $_SESSION['user']['role'] === "author" ) : ?>
                        <td class="align-middle">
                          <?php if ($topic['published'] == 0) : ?>
                            <a href="gestion-topic.php?unpublish=<?= $topic['id'] ?>" role="button">
                              <svg width="25" height="25" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                              </svg>
                            </a>
                          <?php else : ?>
                            <a href="gestion-topic.php?publish=<?= $topic['id'] ?>" role="button">
                              <svg width="25" height="25" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                              </svg>
                            </a>
                          <?php endif; ?>
                        </td>
                      <?php //endif; ?>
                      <td class="align-middle">
                        <a class="text-dark" href="gestion-topic.php?edit-topic=<?= $topic['id'] ?>" role="button">
                          <svg width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                          </svg>
                        </a>
                      </td>
                      <td class="align-middle">
                        <a class="text-dark" href="gestion-topic.php?delete-topic=<?= $topic['id'] ?>" role="button">
                          <svg width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                          </svg>
                          </svg>
                        </a>
                      </td>
                    </tr>
                  </div>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

        <?php endif; ?>
      </div>
    </section>

  




<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src=<?= BASE_URL . "/public/js/script.js" ?>></script>

</body>

</html>