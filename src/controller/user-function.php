<?php


// INITIALISATION DES VARIBLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE D INSERTION EN BASE DE DONNEE et pour eviter les erreurs de variable indéfini
$pseudo = ""; //initialisation
$email = "";
$last_name = "";
$first_name = "";
$role = "TEST";
$auth = FALSE;
$user = "";

$errors = array(); // VAR TABLEAUX QUI RECOIT LES MESSAGES D ERREUR POUR LE FORMULAIRE INSCRIPTION

// Si je clique sur le bouton inscription
if ( isset($_POST['register']) ) {
    registerUser();
}

// si je clique sur le bouton connexion
if ( isset($_POST['connexion']) ) {
    connexionUser();
}

// si je clique sur le bouton modifier
if ( isset($_POST['modifier']) ) {
    updateUser();
}

// si je clique sur le bouton supprimer
if ( isset($_POST['supprimer']) ) {
    deleteUser();
}

// si je clique sur le bouton publier
if ( isset($_POST['publier']) ) {
    publier();
}

// si je clique sur le bouton se déconnecter
if ( isset($_POST['deconnexion']) ) {
    deconnexion();
}




// FONCTION INSCRIPTION
function registerUser() {

        global $db_connect, $errors, $log;

        /************************************************************************************
         * TRAITEMENT DES VARIABLES POST RECUPERER DEPUIS PAGE INSCRIPTION APRES LE CLIQUE *
         *********************************************************************************/
        // ON RECUPERE LES VALEURS SAISIES DES POSTS DANS LE FORMULAIRE ET ON LES TRAITE
        $pseudo = trim($_POST['pseudo']);

        $last_name = htmlentities(trim(ucwords(strtolower($_POST['last_name']))));

        $first_name = htmlentities(trim(ucwords(strtolower($_POST['first_name']))));

        $email = trim($_POST['email']);

        $role = "user";
        
        $password_1 = trim($_POST['password_1']);
        $password_2 = trim($_POST['password_2']);
      

         //POUR LA PHOTO DE PROFIL
         $avatar = strtolower(time() . '-' . $_FILES['avatar']['name']); //input de type file et securisation strtolower time (a etudier)
         

         /************************************
         * VALIDATION CHAMPS VIDE *
         ****************************************/
        // ON VERIFIE QUE LES CHAMPS SONT TOUS REMPLIES
        // ON PREPARE LES MESSAGE D ERREUR DANS NOTRE VARIBLE TABLEAUX $ERRORS []
        // Pour tester le echo test d un champs vide il faut au prealable enlever la securité sur le champs a tester. Son required , son pattern et son min ou max
        if (empty($pseudo)) {
            array_push($errors, "Entrer un pseudonyme");
            
        }

        if (empty($last_name)) {
            array_push($errors, "Entrer votre nom");
            
        }

        if (empty($first_name)) {
            array_push($errors, "Entrer votre prenom");
            
        }

        if (empty($email)) {
            array_push($errors, "Entrer une adresse mail");
            
        }

        if (empty($password_1)) {
            array_push($errors, "Vous avez oublié le mot de passe");
            
        }
        // ON VERIFIE SI LES DEUX MOTS DE PASSE SAISIE SONT IDENTIQUES
        if ($password_1 != $password_2) {
            array_push($errors, "les deux mots de passe ne correspondent pas");
            
        }

        // VERIFICATION DE LA TAILLE DE L IMAGE
        if ($_FILES["avatar"]["size"] > 600000) {
            array_push($errors, "Image volumineuse ! Elle ne peut dépasser 600ko .");
        }

        $imageFileType = strtolower(pathinfo($avatar, PATHINFO_EXTENSION)); //définition de l extension de l image
        // VERIFICATION DES EXTENSIONS
        if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            array_push($errors, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
        }

         // PARAMETRAGE DES VARIBLES D ACCES, EXTENSION, UPLOAD, ET DU DOSSIER DE DESTINATION DES IMAGES UPLOADER
         $target_dir = "../../public/images/uploads/avatar/";  //chemin du sossier ou les fichiers seront uploader
         $target_file = $target_dir . basename($avatar); //parametrage du nom de l image

         // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
         if ( !move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file) ) {
            array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
        }

        /******************************************************
         * VERIFICATION DOUBLON EMAIL METHODE PDO *
         *************************************************/
        //UN UTILISATEUR NE DOIT PAS POUVOIR S INSCRIRE DEUX FOIS AVEC LES MEME IDENTIFIANT
        // l'e-mail et les noms d'utilisateur doivent être uniques

        $sql = "SELECT * FROM moukatali.users WHERE pseudo = '$pseudo' OR email = '$email'";
        $requete = $db_connect->prepare($sql);
        $requete->execute();
        $row = $requete->fetch( PDO::FETCH_ASSOC );
        if ( is_array($row) ) {
            if ( $row['pseudo'] == $pseudo) {
                array_push( $errors, "Pseudo déjà existant");
            }
            if ( $row['email'] == $email) {
                array_push( $errors, "Email déjà existant");
            }
        }


        if ( count($errors) == 0 ) { // Si le tableau erreurs est vide

            //ON CRYPTE LE MOT DE PASSE AVANT L ENREGISTREMENT DANS LA BASE DE DONNEES
            $password_hash = password_hash($password_2, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE QUI A ETE TRAITER EN AMONT

            // REQUETE D INSERTION (CREATION) UTILISATEUR EN BASSE DE DONEE. 13 INFORMATIONS AU TOTAL INSERTION DANS L ODRE DE LA TABLE EN BASSE DE DONNEE
            //  ID EST AUTO INCREMENTER EN BDD

            $reqt = "INSERT INTO moukatali.users ( pseudo, first_name, last_name, avatar, email, password, role, created_at ) VALUES ( '$pseudo','$first_name','$last_name', '$avatar', '$email', '$password_hash', '$role', now() )";

            $reqInsert = $db_connect->prepare($reqt); //preparation de la requete
            $reqInsert->execute(); //execution de la requete

            $log->log('inscription', 'validation_inscription', "Fonction registerUser() : l'inscription a réussi", Log::FOLDER_MONTH); 

            header('location: ./login.php');
            exit;

        } else {
            $log->log('inscription', 'err_inscription', "Fonction registerUser() : l'inscription a échoué", Log::FOLDER_MONTH);
        }

}

// FONCTION CONNEXION UTILISATEUR
function connexionUser() {

    global $db_connect, $errors, $log;

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //TRAITEMENT DES CHAMPS VIDES
    // echo 'Traitement des champs vides <br/>';
    if (empty($email)) {
        array_push($errors, "Saisir une adresse email !");
    }
    // evitre l evoie du caractere ESPACE car le considere toujours comme un champs vide
    if (empty($password)) {
        array_push($errors, "Mot de passe requis");
    }

    /******************************************
     * REQUETE RECUPERATION POUR COMPARAISON *
     ******************************************/
    $reqt  = "SELECT * FROM  moukatali.users WHERE email = '$email' LIMIT 1";
    $valeur = array( 'email' => $email );
    $reqEmail = $db_connect->prepare($reqt);
    $reqEmail->execute($valeur);
    $user = $reqEmail->fetch( PDO::FETCH_ASSOC );

    if ( is_array($user) ) {
        if ( $user['email'] == $email && $user['delete_account'] == 0 ) {
            if ( password_verify($password, $user['password']) ) {
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['role'] = $user['role'];
                $log->log('connexion', 'conn_utilisateurs', "Fonction connexionUser() : l'authentification a réussi", Log::FOLDER_MONTH);
                switch ( $user['role'] ) {
                    case "admin":
                        header('location: ./admin/dashboard.php');
                        break;
                    case "author":
                        header('location: ./admin/gestion-topic.php');
                        break;
                    default:
                        header('location: ./moukatages.php');
                }
            } else {
                array_push($errors, " Identifiants erroné ! <br/> Vérifier vos informations ");
                $log->log('connexion', 'err_connexion', "Fonction connexionUser() : la connexion a echoué", Log::FOLDER_MONTH);
            }
        } else {
            array_push($errors, " Compte inexistant... <br/> Veuillez creer un compte.");
        }      
    } else {
        array_push($errors, " Compte inexistant... <br/> Veuillez creer un compte.");
    }

}


// FONCTION MODIFIER UTILISATEUR
function updateUser() {

    global $db_connect, $errors, $log;

    /************************************************************************************
     * TRAITEMENT DES VARIABLES POST RECUPERER DEPUIS PAGE INSCRIPTION APRES LE CLIQUE *
     *********************************************************************************/
    // ON RECUPERE LES VALEURS SAISIES DES POSTS DANS LE FORMULAIRE ET ON LES TRAITE
    $pseudo = trim($_POST['pseudo']);

    $last_name = htmlentities(trim(ucwords(strtolower($_POST['last_name']))));

    $first_name = htmlentities(trim(ucwords(strtolower($_POST['first_name']))));

    $email = trim($_POST['email']);
    
    $password_1 = trim($_POST['password_1']);
    $password_2 = trim($_POST['password_2']);
  

     //POUR LA PHOTO DE PROFIL
     $avatar = strtolower(time() . '-' . $_FILES['avatar']['name']); //input de type file et securisation strtolower time (a etudier)
     

     /************************************
     * VALIDATION CHAMPS VIDE *
     ****************************************/
    // ON VERIFIE QUE LES CHAMPS SONT TOUS REMPLIES
    // ON PREPARE LES MESSAGE D ERREUR DANS NOTRE VARIBLE TABLEAUX $ERRORS []
    // Pour tester le echo test d un champs vide il faut au prealable enlever la securité sur le champs a tester. Son required , son pattern et son min ou max
    if (empty($pseudo)) {
        array_push($errors, "Entrer un pseudonyme");
    }

    if (empty($last_name)) {
        array_push($errors, "Entrer votre nom");
    }

    if (empty($first_name)) {
        array_push($errors, "Entrer votre prenom");
    }

    if (empty($email)) {
        array_push($errors, "Entrer une adresse mail");
    }

    if (empty($password_1)) {
        array_push($errors, "Vous avez oublié le mot de passe");
    }
    // ON VERIFIE SI LES DEUX MOTS DE PASSE SAISIE SONT IDENTIQUES
    if ($password_1 != $password_2) {
        array_push($errors, "les deux mots de passe ne correspondent pas");
    }

    // VERIFICATION DE LA TAILLE DE L IMAGE
    if ($_FILES["avatar"]["size"] > 600000) {
        array_push($errors, "Image volumineuse ! Elle ne peut dépasser 600ko .");
    }

    $imageFileType = strtolower(pathinfo($avatar, PATHINFO_EXTENSION)); //définition de l extension de l image
    // VERIFICATION DES EXTENSIONS
    if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        array_push($errors, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
    }

     // PARAMETRAGE DES VARIBLES D ACCES, EXTENSION, UPLOAD, ET DU DOSSIER DE DESTINATION DES IMAGES UPLOADER
     $target_dir = "../../../public/images/uploads/";  //chemin du sossier ou les fichiers seront uploader
     $target_file = $target_dir . basename($avatar); //parametrage du nom de l image

     // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
     if ( !move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file) ) {
        array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
    }

    if (count($errors) == 0) {

        $password_hash = password_hash($password_2, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE QUI A ETE TRAITER EN AMONT
        
        $user_id = $_POST['user-id'];

        $reqt = "UPDATE moukatali.users SET pseudo = '$pseudo', first_name = '$first_name', last_name = '$first_name', avatar = '$avatar', email = '$email', password = '$password_hash' WHERE id = '$user_id' ";
        
        $reqUpdate = $db_connect->prepare($reqt); //preparation de la requete
        $reqUpdate->execute(); //execution de la requete

        $log->log('utilisateurs', 'edit_utilisateurs', "Fonction updateUser() : Mise à jour utilisateur réussi", Log::FOLDER_MONTH);

        header('location: ./profile.php');
    } else {
        $log->log('utilisateurs', 'edit_utilisateurs', "Fonction updateUser() : Echec mise à jour utilisateur", Log::FOLDER_MONTH);
    }

}

function deleteUser() {

    global  $db_connect, $log;

    // si le bouton supprimer est cliqué alors :
   
        // requete de suppression methode PDO
        $user_id = $_SESSION['user']['id'];
        $delete_account = 1;
        $reqt = "UPDATE moukatali.users SET delete_account = '$delete_account' WHERE id = '$user_id' "; //supprime la ligne du compte en repérant l id en bdd en fontion de l id de session . L id de session est stocker dans la varaible $delete_id_user.
        $reqUpdate = $db_connect->prepare($reqt); //preparation de la requete
        $reqUpdate->execute(); //execution de la requete
        $log->log('utilisateurs', 'del_utilisateurs', "Fonction deleteUser() : suppression utilisateur", Log::FOLDER_MONTH);

        // On efface également les donnée en session pour evité des bug d affichage
        //si le compte disparait et que la session est tjs active ainsi on détruit aussi la session
        session_destroy();
        unset($_SESSION['user']);
        $redirect = BASE_URL . '/src/index.php';
        header('location: '.$redirect);

}

// FONCTION SE DECONNECTER
function deconnexion() {
    session_destroy();
    unset( $_SESSION['user'] );
    $redirect = BASE_URL . '/src/index.php';
    header('location: '.$redirect);
}


// FONCTION PUBLIER
function publier() {

    global $db_connect, $errors, $log;

    $post = htmlentities(trim($_POST['text']));
    $topic_id = $_POST['main-topic'];
    $user_id = $_POST['user-id'];
        
    if (empty($post)) {
        array_push($errors, "Entrer un moukatage");
        
    }

    $sql = "SELECT * FROM moukatali.moukatages WHERE topic_id = '$topic_id' AND user_id = '$user_id'";
    $requete = $db_connect->prepare($sql);
    $requete->execute();
    $count = $requete->rowCount();

    if ( $count > 0 ) {
        array_push($errors, "Vous avez déjà publier sur ce topic");
    } else {
        if ( count($errors) == 0 ) {
            $reqt = "INSERT INTO moukatali.moukatages ( topic_id, user_id, post, created_at ) VALUES ( '$topic_id','$user_id','$post', now() )";
            $requete = $db_connect->prepare($reqt);
            $requete->execute();
            $log->log('moukatages', 'publier_commentaire', "Fonction publier() : " . $post . '-' . $topic_id . '-' . $user_id, Log::FOLDER_MONTH);
        }
    }


    


}


// FONCTION POUR RECUPERER LES INFO UTILISATEUR
function readUserById( $id ) {

    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/

    global $db_connect;

   
    $requete = "SELECT * from moukatali.users WHERE id = '$id' ";
    $stmt = $db_connect->query($requete);
    $stmt->execute();
    $user = $stmt->fetch( PDO::FETCH_ASSOC );

    return $user;
}





// 888888888888888888888888888888888888888888888888888888888888888888888888888888888888888

function getAllUsers()
{
    global $db_connect;
    // $admin = "role";
    $sql = "SELECT * FROM moukatali.users";
    $pdoStat = $db_connect->prepare($sql);
    $pdoStat->execute();
    $all_users = $pdoStat->fetchAll();
    return $all_users;
}

    

?>

