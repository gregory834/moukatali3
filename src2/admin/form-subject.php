<?php
include('../config.php');
include(ROOT_PATH . '/admin/includes/admin-functions.php');
include(ROOT_PATH . '/admin/includes/topic-functions.php');

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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/styles.css">

    <title>Créer un sujet - Moukat A Li</title>
</head>

<body>
    <!-- HEADER -->
    <header id="admin">
    <div class="container">
        <nav class="navbar navbar-dark">
        <a class="navbar-brand text-uppercase fw-light px-1 py-0" href="../index.php">moukat a li</a>
            <ul class="nav justify-content-end text-uppercase align-items-center">
            <li class="nav-item">
                <a class="nav-link text-light fw-light" href="dashboard.php">dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light fw-light" href="topics.php">topics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light fw-light" href="moukateurs.php">moukateurs</a>
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
    <section id="form-subject">
        <div class="container text-center">

           
            <?php if ($update_topic == false): ?>
                <h1 class="text-uppercase text-center py-3">créer un topic</h1>
            <?php else: ?>
                <h1 class="text-uppercase text-center py-3">modifier le topic</h1>
            <?php endif ?>
            
            <form method="post" action="form-subject.php" enctype="multipart/form-data">
                
                <!-- erreurs de validation du formulaire -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>

                <!-- si vous modifiez un message, l'identifiant est requis pour identifier ce message -->
				<?php if ($update_topic === true): ?>
					<input type="hidden" name="topic-id" value="<?php echo $topic_id; ?>">
				<?php endif ?>
                <!-- Image -->
                <div class="form-group" id="preview">
                    <!--<span class="img-div">-->
                        <!--<div class="img-placeholder"  onClick="triggerClick()"></div>-->
                        <img src="../public/images/upload/<?= $topic_picture ?>" onClick="triggerClick()" id="profileDisplay" alt="Preview" style="height: 310px; width: 360px;">
                    <!--</span>-->
                    <label for="preview" class="form-label text-center"></label>
                    <input type="file" onChange="displayImage(this)" id="picture" class="form-control form-control-lg" name="picture" placeholder="Uploader une image">
                </div>
                <!-- Titre -->
                <div class="form-floating">
                    <input type="text" class="form-control" placeholder="Title" name="title" value="<?= $title ?>">
                    <label for="title">Titre</label>
                </div>
                <!-- Description -->
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="topic-description"><?= $topic_description ?></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>
                <!-- BOUTON -->
                <div class="d-grid gap-2">
                  <?php if ($update_topic == false): ?>
                    <button type="submit" class="btn btn-dark fw-bold text-uppercase mt-4 mb-5" name="create-topic">créer</button>
                  <?php else: ?>
                    <button type="submit" class="btn btn-secondary fw-bold text-uppercase mt-4 mb-5" name="update-topic">mettre à jour</button>
                  <?php endif ?>
                </div>
                

            </form>
        </div>
    </section>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
        <script src="../public/js/script.js"></script>

</body>

</html>