<?php
require '../../../config/config.php';
require '../../../config/database.php';
require '../../controller/user-function.php';

$user = readUserById( $_SESSION['user']['pseudo'] );


include ('../../layout/head.php');
?>

<title>Profil | Moukat A Li</title>

</head>

    <body>
        
        <!-- HEADER -->
        <header class="header-main ">
            <div class="container">
            <?php include (BASE_URL . '/src/layout/nav.php'); ?>
            </div>
        </header>

        <!-- CONTAINER  -->
        <!-- <h3 class="pt-3 mb-5 text-white text-center">DASHBOARD</h3> -->
        <!-- user_info -->
        <section>

            <div class="container">
                <h5 class="text-light py-5 text-center">Bienvenue <?php echo $user['pseudo']; ?></h5>
            </div>

            <div class="container col-lg-8 col-md-8 d-flex justify-content-center">
                <div id="user_info">
                    
                    <!-- photo_de_profile -->
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            
                            <img id="img_avatar" src=<?php echo BASE_URL . '/public/images/uploads/' . $user['avatar']; ?> alt="" class="img-fluid">
                        </div>
                    </div>
                    <!---Information user (NOM, Prénom, Addresse, Tel Sexe...)-->
                    <div class="col  d-flex justify-content-around  text-dark">
                        <div class="justify-content-around">
                            <h5><img src="../../icons/user-fill.png" class="icon-size mr-4" /><?php echo ($user['last_name']) ?>&nbsp;<?php echo ($user['first_name']) ?></h5>
                            <h5><img src="../../icons/mail-open-fill.png" class="icon-size mr-4" /><?php echo ($user['email']) ?></h5>
                            
                        </div>
                    </div>



                    <!-- modifier profile -->
                    <div class="d-flex flex-column flex-md-row text-center align-items-center justify-content-md-around mt-4">

                        <a class="btn btn-profil text-uppercase font-weight-bold mb-3 mb-md-0" href=<?php echo BASE_URL . '/src/pages/user/update-user.php' ?> type="submit" role="button">Modifier</a>

                        


                        <!-- JAVASCRIPT ANIMATION BTN DELETE AND FONCTIONALITY -->
                        <div class="btn1 ">
                            <div class="btn1-back ">
                                <p>Est tu certain de vouloir supprimer ton compte? Cette action est irreversible !</p>

                                <form method="POST" class="yes">

                                <button id="confirm" data-toggle="modal" data-target="#popup" type="submit" name="supprimer" class="yes ">Oui</button>
                                <button class="no">Non</button>

                                </form>

                            </div>
                            <div class="btn1-front text-uppercase font-weight-bold">Supprimer </div>
                        </div>

                        <!----- POPUP ----->
                        <div class="modal fade hidden" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="modal-title text-dark" id="exampleModalLongTitle">Nous traitons votre demande !</h5>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>


                </div>

            </div>
        </section>

        <!-- FOOTER -->
        <footer class="text-center py-5 d-flex flex-column">
            <a href="#" class="mb-1">Contact</a>
            <a href="#" class="mb-1">C.G.V.</a>
            <a href="#" class="mb-1">C.G.U.</a>
            <a href="#">Mentions légales</a>
        </footer>

        <!-- jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script>
        <script src="../../../public/js/btn-sup-modal.js"></script>
        <script>

            btn = document.getElementById('confirm');

            popup = document.getElementById('popup');

            btn.addEventListener('click', evt => {
                popup.classList.remove('hidden')
                popup.classList.add('visibility')
            })
        </script>

    </body>

    </html>