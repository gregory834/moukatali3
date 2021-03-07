<?php
require '../../config/config.php';
require ROOT_PATH . '/config/database.php';

require ROOT_PATH . '/src/controller/user-function.php';
$nav = "login";


include (ROOT_PATH . '/src/layout/head.php');
?>

<title>Login | Moukat A Li</title>

</head>

<body>
  
    
    <!-- HEADER -->
    <header class="header-main ">
        <div class="container">

            <?php include ROOT_PATH . '/src/layout/navbar.php' ?>

        </div>
    </header>

    <section id="form-connexion">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <!-- TITRE -->
            <div class="my-5 m-md-5 box-titre col-lg-6 col-md-6 col-sm-4 col-12 d-flex justify-content-center">
                <h2>ALLON MOUKATER !!&#x1F609;</h2>
            </div>
        

            <div class="mb-5 box-formulaire col-lg-8 col-md-8 ">
                <form class="col px-3 py-4" method="post">

                   <!-- MESSAGE D ERREUR -->
                   <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-dark mb-0">Email* </label>

                            <input type="email" class="form-control" name="email" placeholder="name@example.com" title="Veuillez inscrire votre email" size="60" minlength="3" maxlength="60" required value="">
                            </input>

                        </div>

                        <!-- MOT DE PASSE -->
                        <div class="mb-3 ">
                            <label class="mb-0 text-dark" for="mot de passe1">Mot de passe* </label>

                            <input type="password" class="form-control" name="password" required pattern="?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Saisir un mot de passe" minlength="1" maxlength="20" size="20" value="">
                            </input>

                        </div>


                        <div class="mt-3 d-flex justify-content-center">
                            <button type="submit" name="connexion" class="btn btn-dark">CONNEXION</button>
                        </div>

                        <div class="mt-1 d-flex justify-content-center text-dark"> <i>(* Champs obligatoires)</i></div>

                        <div class="mt-3 d-flex justify-content-center"><a href="./register.php" class="text-nav-foot pb-2">Pas
                                encore de compte !? INSCRIT TOI ICI !! </a><br>
                        </div>

                    </form>
            </div>
        </div>
    </section>

</body>

</html>