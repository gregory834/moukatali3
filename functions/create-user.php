<!-- CREATE USER WITH VALIDATION FORM AND SECURITY David -->
<?php

function create_user()
{
    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/

    require_once('bdd-connect.php');
    connectPdoBdd();


    /******************************************
     * INITIALISATION des variables *
     ******************************************/

    // NOUS SERT PAR EXEMPLE A SORTIR LES INFORMATIOSN DU TABLEAUX DES ERREURS DE LA FONCTION
    global $errors, $success_inscription, $role, $pseudo, $email, $nom, $prenom, $pdo,  $password_hash;

    // INITIALISATION DES VARIBLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE D INSERTION EN BASE DE DONNEE 
    $pseudo = ""; //initialisation
    $avatar = "";
    $email = "";
    $password_hash = "";
    $errors = array(); // VAR TABLEAUX QUI RECOIT LES MESSAGES D ERREUR POUR LE FORMULAIRE INSCRIPTION
    $success_inscription = array();
    $role = "User";

    if (isset($_POST["inscription"])) {
        /************************************************************************************
         * TRAITEMENT DES VARIABLES POST RECUPERER DEPUIS PAGE INSCRIPTION APRES LE CLIQUE *
         *********************************************************************************/
        // ON RECUPERE LES VALEURS SAISIES DES POSTS ET ON LES TRAITE
        $pseudo = trim($_POST['pseudo']);
        // $avatar = $_POST['avatar'];

        //POUR LA PHOTO DE PROFIL
        $avatar = strtolower(time() . '-' . $_FILES['avatar']['name']); //input de type file et securisation strtolower time (a etudier)
        // $avatar = strtolower(time() . '-' . $_FILES[$_POST['avatar']]);


        $nom = htmlentities(trim(ucwords(strtolower($_POST['nom']))));
        $prenom = htmlentities(trim(ucwords(strtolower($_POST['prenom']))));
        $genre = trim($_POST['genre']); //BOLLEEN EN BDD
        $age = trim($_POST['age']); // TYPE DATE EN BDD
        $email = trim($_POST['email']);
        $telephone = trim($_POST['telephone']);
        $password_1 = trim($_POST['password_1']);
        $password_2 = trim($_POST['password_2']);
        $ville = htmlentities(trim(ucwords(strtolower($_POST['ville']))));

        // TEST SI UNE DES VARIABLE QUI RECCUPERE UN POST FONCTIONNE ICI AVEC LE POST PASSWORD
        // var_dump($password_1);

        /************************************
         * VALIDATION CHAMPS VIDE *
         ****************************************/
        // ON VERIFIE QUE LES CHAMPS SONT TOUS REMPLIES
        // ON PREPARE LES MESSAGE D ERREUR DANS NOTRE VARIBLE TABLEAUX $ERRORS []
        // Pour tester le echo test d un champs vide il faut au prealable enlever la securité sur le champs a tester. Son required , son pattern et son min ou max
        if (empty($pseudo)) {
            array_push($errors, "Entrer un pseudonyme");
        }

        // TEST SI UN CHAMP EST VIDE
        // echo 'CHAMP VIDE POUR PSEUDO! </br>';
        //     var_dump($errors);
        if (empty($avatar)) {
            array_push($errors, "Entrer une photo de profil");
            $uploadOk = 0;
        }

        /************************************************************************************
         * IMAGE VALIDATATION ET UPLOAD
         * SOURCE DU CODE ET RE ADAPTER EN FONCTION DE LA BDD ET DES CHEMINS D ACCES
         * https://www.w3schools.com/php/php_file_upload.asp 
         * ATTENTION NE PAS EFFACER LE DOSSIER QUI SE NOMME UPLOADS DANS LE FICHIER DES IMAGES!!
         **************************************************************************************/


        // PARAMETRAGE DES VARIBLES D ACCES, EXTENSION, UPLOAD, ET DU DOSSIER DE DESTINATION DES IMAGES UPLOADER
        $target_dir = "../../images/uploads/";  //chemin du sossier ou les fichiers seront uploader
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]); //parametrage du nom de l image
        $uploadOk = 1; //condition si uplooad aboutie
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //définition de l extension de l image

        //VERIFICATION SI L IMAGE EST UNE VRAI OU UNE FAUSSE
        if (isset($_POST["inscription"])) {
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";


                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                array_push($errors, "Ce fichier n'est pas une image !");
                $uploadOk = 0; //CONDITION = 0 CAR N EST PAS UNE IMAGE
            }
        }



        // VERIFICATION DE LA TAILLE DE L IMAGE
        if ($_FILES["avatar"]["size"] > 600000) {
            echo "Sorry, your file is too large.";
            array_push($errors, "Image volumineux ! Elle ne peut dépasser 600ko .");
            $uploadOk = 0;  //CONDITION = 0 CAR N EST TROP VOLUMINEUSE
        }

        // VERIFICATION DES EXTENSIONS
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

        ) {
            array_push($errors, "Format d'image non accepté ! Requis : png, pjeg ou png");
            $uploadOk = 0;
        }

        // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
        if ($uploadOk == 0) {
            array_push($errors, "Désoler, votre image n'as pas été transférées.");
            // SI AUCUNE ERREUR ALORS ON PRECEDE AU TELECHARGEMENT DANS LE DOSSIER UPLOAD PREALABLEMENT CREER.
            // LA FONCTION MOVE UPLOAD FILE PREND DEUX PARAMETRE (VARIABLE DE NOTRE IMAGE TRAITER  , SON CHEMIN DE DESTINATION)
        } else {
            // CONDITION QUAND TRANSFERT REUSSI
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $avatar = $_FILES["avatar"]["name"];
                // echo "The file " . htmlspecialchars(basename($_FILES["avatar"]["name"])) . " has been uploaded. ";
            }
            // CONDITION QUAND LE TRANSFERT ECHOUE
            else {
                // echo "Sorry, there was an error uploading your file.";
                array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
            }
        }
        // FIN DES VERIFICATIONS SUR IMAGES


        // SUITE DES VERIFICATIONS SI CHAMPS VIDE

        if (empty($nom)) {
            array_push($errors, "Entrer votre nom");
        }
        if (empty($prenom)) {
            array_push($errors, "Entrer votre prenom");
        }
        // if (empty($genre)) {
        //     array_push($errors, "Entrer votre genre");
        // }
        // if (empty($age)) {
        //     array_push($errors, "Entrer votre age");
        // }

        if (empty($email)) {
            array_push($errors, "Entrer une adresse mail");
        }

        // if (empty($telephone)) {
        //     array_push($errors, "Entrer votre numéro de téléphone");
        // }
        // if (empty($ville)) {
        //     array_push($errors, "Entrer votre ville");
        // }
        if (empty($password_1)) {
            array_push($errors, "Vous avez oublié le mot de passe");
        }
        // ON VERIFIE SI LES DEUX MOTS DE PASSE SAISIE SONT IDENTIQUES
        if ($password_1 != $password_2) {
            array_push($errors, "les deux mots de passe ne correspondent pas");
        }










        // 88888888888888888888888888888888888888888888888888888888888888888888888888888888


        /************************************
         * DOUBLE SECURITE , ICI AU NIVEAU DE PHP (NOM MODIFIABLE DEPUIS L INSPECTEUR DES ELEMENTS HTMPL) *
         ****************************************/

        // RESTE A FAIRE

        // 8888888888888888888888888888888888888888888888888888888888888888888888888888888









        /******************************************************
         * VERIFICATION BOUBLON EMAIL METHODE PDO *
         *************************************************/

        //UN UTILISATEUR NE DOIT PAS POUVOIR S INSCRIRE DEUX FOIS AVEC LES MEME IDENTIFIANT
        // l'e-mail et les noms d'utilisateur doivent être uniques

        echo 'start recherche doublons <br/>';
        $pdo =  connectPdoBdd(); //connection a la bdd
        $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE  email = '$email' LIMIT 1"; //requete de selection dans table user en fonction de l email
        $reqEmail = $pdo->prepare($reqt); //préparation de la requete
        $reqEmail->execute([$email]);  //EXECUTION DE LA REQUETE
        $doublonEmail = $reqEmail->fetch();  //RECUPERATION RESULTAT DE LA REQUETE AUTREMENT DIT SI UN DOUBLON EST TROUVER EN FONCTION DE L EMAIL FOURNI

        // SI DOUBLON EXISTANT
        if ($doublonEmail) {
            if ($doublonEmail['email'] === $email) {
                array_push($errors, "Attention ! Cette addresse email existe déjà !");
            }
            //SI AUCUN DOUBLON ECHO TEST ET ON CONTINUE
        } else {
            echo 'AUCUN DOUBLON EMAIL TROUVER <br/>';
        }

        /**********************************************
         * VERIFICATION BOUBLON PSEUDONYME METHODE PDO *
         **********************************************/

        //  IDEM QUE POUR L EMAIL. C EST UN CHOIX DE SEPARER LES DEUX REQUETE AU LIEU D EN FAIRE UNE POUR DEUX. LE BUT ETANT DE BIEN AVANCER ETAPE PAR ETAPE
        $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE pseudo = '$pseudo' LIMIT 1";
        $reqPseudo = $pdo->prepare("SELECT * FROM `users` WHERE pseudo='$pseudo'");
        $reqPseudo->execute([$pseudo]);
        $doublonPseudo = $reqPseudo->fetch();
        if ($doublonPseudo) { // email existant
            if ($doublonPseudo['pseudo'] === $pseudo) {
                array_push($errors, "Attention ! Ce Pseudonyme existe déjà !");
            }
            // SI AUCUN DOUBLON ECHO TEST ET ON CONTINUE.
        } else { // email n'existe pas
            echo 'AUCUN DOUBLON PSEUDO TROUVER <br/>';
        }
        echo 'Fin de recherche de doublons <br/>';

        // FIN DES VERIFICATIONS A CE STADE TOUT EST BON. ON PEUT PASSER A LA REQUETE D INSERTION QUI CREER LE COMPTE UTILISATEUR 
        // ENSUITE ON REDIRIGE LE CLIENT SUR UNE PAGE STATICS DE CONFIRMATION D INSCRIPTION AVANT DE SORTIR DE NOTRE FONCTION
        // AVEC UNE BALISE META .
        //LA PAGE CONTIENDRA UN BOUTON SUIVANT









        /***********************************************
         * INSERTION (CREATE) UTILISATEUR EN BDD *
         ************************************************/

        // ON ENREGISTRE L UTILISATEUR SI IL N Y A AUCUNE ERREUR DANS LE FORMULAIRE
        // ON OUBLIE SURTOUT PAS DE ASSIGNER LE ROLE PAR DEFAUT EN TANT QUE UTILISATEUR
        // SI AUCUNE ERREUR N'EST TROUVE C EST A DIRE SI LA VARIABLE ERRORS RESTE VIDE. ALORS ON EFFECTUE LA REQUETE D INSERTION SQL EN BASE DE DONNEE.

        //CONDITION SI AUCUNE ERREUR EST PRESENTE VAR ERRORS = ["VIDE"];

        if (count($errors) == 0) {
            echo 'debut condition si aucune erreur <br/>';

            array_push($success_inscription, "Inscription réussie !<br/> Veuillez patienter.. ");

            //ON CRYPTE LE MOT DE PASSE AVANT L ENREGISTREMENT DANS LA BASE DE DONNEES
            echo 'Cryptage du mot de passe (hash) <br/>';
            $password_hash = password_hash($password_2, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE QUI A ETE TRAITER EN AMONT

            // Verification du hash

            var_dump($password_hash);

            // resultat = string(60) "$2y$10$/guNGisFaPtfCJysQb9VketX1Vho3MlKDXSvNOZvhYNUtybhaD4vW"

            echo 'Début de la requete d\' insertion <br/>';

            // TEST REQUETE FONCTIONNELLE EN BDD
            // ATTENTION AU DUPLICATA DES ID ET DES CLE PRIMAIRE COMME PSEUDO
            //INSERT INTO `users` (pseudo, prenom, nom, age, avatar, ville, telephone, email, password, genre, role, date_inscription) VALUES ( "pseudoO","prenom","nom", "34", "avatar", "ville", 0000000000, "email@gmail.com", "hashpasswor", 1, "user", now());

            // REQUETE D INSERTION (CREATION) UTILISATEUR EN BASSE DE DONEE. 13 INFORMATIONS AU TOTAL INSERTION DANS L ODRE DE LA TABLE EN BASSE DE DONNEE
            //  ID EST AUTO INCREMENTER EN BDD

            $reqt = "INSERT INTO `users` ( pseudo, name, first_name, avatar, email, password, role, date_inscription) VALUES ( '$pseudo','$prenom','$nom', '$avatar', '$email', '$password_hash','$role', now())";

            $reqInsert = $pdo->prepare($reqt); //preparation de la requete
            $reqInsert->execute(); //execution de la requete

            echo 'Fin de la requete d insertion <br/>  Fin de la fonction create-user <br/>';

            //REDIRECTION SUR LA PAGE STATICS DE CONFIRMATION DE L INSCRIPTION
?>
            <meta http-equiv="refresh" content="1; url=../formUser/connection.php" /><?php

                                                                                        }
                                                                                        // 888888888888888888888888888888888888888888888888888888888888888888888888888
                                                                                        // FIN CONDITION IF COUNT ERRORS == 0{}
                                                                                    }
                                                                                    // 888888888888888888888888888888888888888888888888888888888888888888888888888
                                                                                    // FIN DU ISSET CLIQUE INSCRIPTION
                                                                                }
                                                                                // 888888888888888888888888888888888888888888888888888888888888888888888888888
                                                                                // FIN FONCTION CREATE-USER
                                                                                echo 'sorti de la fonction <br/>'

                                                                                            ?>