<?php
require '../../config/config.php';
require '../../config/database.php';
require '../controller/user-function.php';




include ('../layout/head.php');
?>

<title>Inscription | Moukat A Li</title>

</head>


<body>

    
    <!-- HEADER -->
    <header class="header-main ">
        <div class="container">

        <?php include (BASE_URL . '/src/layout/nav.php'); ?>

        </div>
    </header>
    
    <section id="form-inscription">
        <div class="container d-flex flex-column align-items-center justify-content-center">

            <!-- TITRE -->
            <div class="mt-5 mb-5 ml-5 mr-5 box-titre col-lg-6 col-md-6 col-sm-4 d-flex justify-content-center">
                <h2>MI VEU MOUKATER !! &#x1F60B;</h2>
            </div>
        </div>

        <div class="container d-flex flex-column align-items-center justify-content-center">
            <!-- FORMULAIRE -->
            <!-- FORMULAIRE D'INSCRIPTION -->
            <div class="mb-5 box-formulaire col-lg-8 col-md-8 col-12">

                <form class="col px-3 py-4" method="POST" enctype="multipart/form-data">

                    <!-- MESSAGE D ERREUR -->
                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>

                    <!-- PSEUDONYME DATA TYPE VARCHAR-->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Pseudonyme*</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Moukateur 974" title="Choisir un pseudo ou un nom d'utilisateur">
                        </input>
                        <!-- NE PAS AFFACER SERVIRA POUR EXPLIQUER LA SECURIT2 FORMULAIRE DU COT2 DE PHP (double securisation) -->
                        <!-- required
                        pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" 
                        minlength="4"
                        maxlength="30" 
                        size="30" 
                         value="" -->
                    </div>

                    <!-- PHOTO DE PROFIL DATA TYPE VARCHAR CAR ON ENREGISTRE UN LIEN D IMAGE -->

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Avatar*</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" required>
                        </input>

                    </div>

                    <!-- ATTENTION nom et prénom sur la meme ligne ! -->

                    <div class="mb-3 d-flex flex-column flex-md-row justify-content-between">
                        <!-- NOM DATA TYPE VARCHAR-->
                        <div class=" col-md-6 col-12 px-0 mb-3 mb-md-0 pr-md-1">

                            <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Nom*</label>
                            <input type="text" class="form-control" id="nom" name="last_name" placeholder="DUPONT" title="Veuillez inscrire votre Nom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="">
                            </input>
                        </div>

                        <!-- PRENOM DATA TYPE VARCHAR-->
                        <div class="col-md-6 col-12 px-0 pl-md-1">
                            <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Prénom*</label>
                            <input type="text" class="form-control" id="prenom" name="first_name" placeholder="Vinshan" title="Veuillez inscrire votre prénom" required pattern="([A-z0-9À-ž\s]){2,}" minlength="4" maxlength="50" size="50" value="">
                            </input>
                        </div>
                    </div>


                    <!-- EMAIL DATA TYPE SQL VARCHAR -->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Email* </label>

                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
                        </input>

                    </div>


                    <!-- MOT DE PASSE DATA TYPE VARCHAR 100 CAR LE MOTE DE PASSE SERA HASHER-->
                    <div class="mb-3 ">
                        <label class="text-dark mb-0" for="mot de passe1">Mot de passe* </label>

                        <input type="password" class="form-control" id="password_1" name="password_1" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Saisir un mot de passe" minlength="1" maxlength="20" size="20" value="">
                        </input>

                    </div>

                    <!-- CONFIRMATION MOT DE PASSE PAS NECESSAIRE A L INSERTION EN BDD MAIS UTILSE POUR CONFIRMER LE PASSWORD-->
                    <div class="mb-3 ">
                        <label class="text-dark mb-0" for="mot de passe2">Confirmation* </label>

                        <input type="password" class="form-control" id="password_2" name="password_2" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Confirmation mot de passe" minlength="1" maxlength="20" size="20" value="">
                        </input>

                    </div>


                    <!-- BOUTON INSCRIPTION -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="register" class="btn btn-dark">INSCRIPTION</button>

                    </div>
                    <div class="mt-3 d-flex justify-content-center"> <i>(* Champs obligatoires)</i></div>

                    <div class="mt-3 d-flex justify-content-center"><a href="login.php" class="text-nav-foot pb-2">Déjà un compte pour moukater ? </a><br>
                    </div>
                    
            
                </form>
            </div>

        </div>


    </section>


</body>




<!--    VUE JS -->
<script>



</script>
<!-- FIN VUE JS -->

</html>