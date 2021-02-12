<!-- CREATE USER WITH VALIDATION FORM AND SECURITY David -->




<?php

function create_user()
{

    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/

    require_once('bdd-connect.php');
    connectPdoBdd();
    echo 'Connection à la base de donnée OK <br/>';


    /******************************************
     * INITIALISATION des variables *
     ******************************************/
    echo ' Entrer de fonction creat-user <br/>';

    echo ' Inititialisation varibles GLOBAL  <br/>Initialisation  du tableaux des erreurs (IN FONCTIONS)  <br/>';
    // NOUS SERT PAR EXEMPLE A SORTIR LES INFORMATIOSN DU TABLEAUX DES ERREURS DE LA FONCTION
    global $errors, $success_inscription, $role, $pseudo, $email, $nom, $prenom, $pdo,  $password_hash;

    // INITIALISATION DES VARIABLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE D'INSERTION EN BASE DE DONNEE.
    $pseudo = ""; //initialisation
    $avatar = "";
    $email = "";
    $ville = "";
    $password_hash = "";
    // $telephone ="";
    $errors = array(); // VAR TABLEAUX QUI RECOIT LES MESSAGES D ERREUR POUR LE FORMULAIRE INSCRIPTION
    $success_inscription = array();
    $role = "user";
    echo ' suite... fin initilisation ... suite <br/>';

    /****************************************************************************************** */

    if (isset($_POST["inscription"])) {
        echo ' Debut de la fonction create user ok <br/>';
        /************************************************************************************
         TRAITEMENT DES VARIABLES POST RECUPERER DEPUIS PAGE INSCRIPTION APRES LE CLIQUE.
         *********************************************************************************/
        // ON RECUPERE LES VALEURS SAISIES DES POSTS ET ON LES TRAITE
        $pseudo = trim($_POST['pseudo']);
        $avatar = $_POST['avatar']; 
        
        //POUR LA PHOTO DE PROFIL

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
        echo ' suite... fin traitement des variables POST. <br/> Password pas encore haché ...suite <br/>';

        /****************************************
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
        // 
        if (empty($avatar)) {
            array_push($errors, "Entrer une photo de profil");
        }

        // echo 'Vérification taille image avatar';
        // // VERIFICATION TAILLE IMAGE
        // if ($_FILES[$_POST['avatar']] > 200000) {
        //     array_push($errors, "La taille de l'image ne doit pas dépasser 200 ko");
        // }

        // if (!in_array($picture_ext, ['jpg', 'jpeg', 'png'])) {
        //     array_push($errors, "Votre image doit être .jpg, .jpeg ou .png");
        // }

        // image file directory
        // $target_dir = ROOT_PATH . '/public/images/upload/' . basename($picture);

        // if (!move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir)) {
        //     array_push($errors, "Échec du téléchargement de l'image.");
        // }


        if (empty($nom)) {
            array_push($errors, "Entrer votre nom");
        }
        if (empty($prenom)) {
            array_push($errors, "Entrer votre prenom");
        }
        if (empty($genre)) {
            array_push($errors, "Entrer votre genre");
        }
        if (empty($age)) {
            array_push($errors, "Entrer votre age");
        }

        if (empty($email)) {
            array_push($errors, "Entrer une adresse mail");
        }

        if (empty($telephone)) {
            array_push($errors, "Entrer votre numéro de téléphone");
        }
        if (empty($ville)) {
            array_push($errors, "Entrer votre ville");
        }
        if (empty($password_1)) {
            array_push($errors, "Vous avez oublié le mot de passe");
        }
        // ON VERIFIE SI LES DEUX MOTS DE PASSE SAISIE SONT IDENTIQUES
        echo 'Vérification mots de passe si identique pendant la saisie des POSTS <br/>';
        if ($password_1 != $password_2) {
            array_push($errors, "les deux mots de passe ne correspondent pas");
        }

        echo ' suite .. Fin des vérifications des champs vide .. suite <br/>';

        // Assurez-vous qu'aucun utilisateur n'est enregistré deux fois
        // l'e-mail et les noms d'utilisateur doivent être uniques
        /******************************************************
         * VERIFICATION DOUBLON EMAIL METHODE PDO *
         *************************************************/

        echo 'start recherche doublons <br/>';
        $pdo =  connectPdoBdd();
        $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE  email = '$email' LIMIT 1";
        $reqEmail = $pdo->prepare("SELECT * FROM `users` WHERE email='$email'");
        $reqEmail->execute([$email]);
        $doublonEmail = $reqEmail->fetch();
        if ($doublonEmail) { // email existant
            if ($doublonEmail['email'] === $email) {
                array_push($errors, "Attention ! Cette addresse email existe déjà !");
            }
        } else { // email n'existe pas
            echo 'AUCUN DOUBLON EMAIL TROUVER <br/>';
        }

        /**********************************************
         * VERIFICATION BOUBLON PSEUDONYME METHODE PDO *
         **********************************************/

        $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE pseudo = '$pseudo' LIMIT 1";
        $reqPseudo = $pdo->prepare("SELECT * FROM `users` WHERE pseudo='$pseudo'");
        $reqPseudo->execute([$pseudo]);
        $doublonPseudo = $reqPseudo->fetch();
        if ($doublonPseudo) { // email existant
            if ($doublonPseudo['pseudo'] === $pseudo) {
                array_push($errors, "Attention ! Ce Pseudonyme existe déjà !");
            }
        } else { // email n'existe pas
            echo 'AUCUN DOUBLON PSEUDO TROUVER <br/>';
        }

        echo 'Fin de recherche de doublons <br/>';

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

            $reqt = "INSERT INTO `users` ( pseudo, prenom, nom, age, avatar, ville, telephone, email, password, genre, role, date_inscription) VALUES ( '$pseudo','$prenom','$nom', '$age', '$avatar', '$ville', '$telephone', '$email', '$password_hash', '$genre', '$role', now())";

            $reqInsert = $pdo->prepare($reqt); //preparation de la requete
            $reqInsert->execute(); //execution de la requete

            echo 'Fin de la requete d insertion <br/>  Fin de la fonction create-user <br/>';

            //REDIRECTION SUR LA PAGE STATICS DE CONFIRMATION DE L INSCRIPTION
?>
            <meta http-equiv="refresh" content="1; url=../pages/reussite-inscription.php" /> <?php

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