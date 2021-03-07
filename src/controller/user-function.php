<?php


$pseudo = ""; 
$email = "";
$last_name = "";
$first_name = "";
$role = "";
$auth = 0;
$user = "";

$errors = array();

if ( isset($_POST['register']) ) {
    registerUser();
}

if ( isset($_POST['connexion']) ) {
    connexionUser();
}

if ( isset($_POST['modifier']) ) {
    updateUser();
}
/*
if ( isset($_POST['supprimer']) ) {
    deleteUser();
}
*/
if ( isset($_POST['publier']) ) {
    publier();
}

if ( isset($_POST['deconnexion']) ) {
    deconnexion();
}


// FONCTION INSCRIPTION
function registerUser() {

    global $db_connect, $errors, $log;

    $pseudo = trim($_POST['pseudo']);
    $last_name = htmlentities(trim(ucwords(strtolower($_POST['last_name']))));
    $first_name = htmlentities(trim(ucwords(strtolower($_POST['first_name']))));
    $email = trim($_POST['email']);
    $role = "user";
    $password_1 = trim($_POST['password_1']);
    $password_2 = trim($_POST['password_2']);
    $avatar = strtolower(time() . '-' . $_FILES['avatar']['name']);
        
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
    if ($password_1 != $password_2) {
        array_push($errors, "les deux mots de passe ne correspondent pas"); 
    }
    if ($_FILES["avatar"]["size"] > 600000) {
        array_push($errors, "Image volumineuse ! Elle ne peut dépasser 600ko .");
    }
    $imageFileType = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
    if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        array_push($errors, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
    }
 
    $target_dir = ROOT_PATH . "/public/images/uploads/avatar/";  
    $target_file = $target_dir . basename($avatar);

    if ( !move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file) ) {
        array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
    }

    $sql = "SELECT * FROM users";
    $query = $db_connect->query($sql);
    $users = $query->fetch_all(MYSQLI_ASSOC);

    if ( is_array($users) ) {
        foreach ($users as $key => $user) {
            if ( $user['pseudo'] === $pseudo ) {
                array_push( $errors, "Pseudo déjà existant");
            }
            if ( $user['email'] === $email) {
                array_push( $errors, "Email déjà existant");
            }
        }
    }

    if ( count($errors) == 0 ) {

        $password_hash = password_hash($password_2, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users ( pseudo, first_name, last_name, avatar, email, password, role, created_at ) VALUES ( '$pseudo','$first_name','$last_name', '$avatar', '$email', '$password_hash', '$role', now() )";
        $query = $db_connect->query($sql);

        $log->log('inscription', 'validation_inscription', "Fonction registerUser() : l'inscription a réussi", Log::FOLDER_MONTH); 

        header('location: ./login.php');

    } else {
        $log->log('inscription', 'err_inscription', "Fonction registerUser() : l'inscription a échoué", Log::FOLDER_MONTH);
    }

}

// FONCTION CONNEXION UTILISATEUR
function connexionUser() {

    global $db_connect, $errors, $log;

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (empty($email)) {
        array_push($errors, "Saisir une adresse email !");
    }
    if (empty($password)) {
        array_push($errors, "Mot de passe requis");
    }

    if ( empty($errors) ) {}

    $sql = "SELECT * FROM users WHERE email = '$email' ";
    $res = $db_connect->query($sql);
    $rows = $res->num_rows;
    
    if ( $rows > 0 ) {
        $user = $res->fetch_array();
        if ( password_verify($password, $user['password']) ) {
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['role'] = $user['role'];
            $sql = "UPDATE users SET auth = 1 WHERE email = '$email'";
            $query = $db_connect->query($sql);
            $_SESSION['user']['auth'] = 1;
            $log->log('connexion', 'conn_utilisateurs', "Fonction connexionUser() : l'authentification a réussi " . "- ID: " . $user['id'] . ' - ROLE: ' . $user['role'], Log::FOLDER_MONTH);
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
            array_push($errors, "Mot de passe incorrect");
        }
    } else {
        array_push($errors, " Compte inexistant... <br/> Veuillez créer un compte.");
    }

}


// FONCTION MODIFIER UTILISATEUR
function updateUser() {

    global $db_connect, $errors, $log;

    $pseudo = trim($_POST['pseudo']);

    $last_name = htmlentities(trim(ucwords(strtolower($_POST['last_name']))));

    $first_name = htmlentities(trim(ucwords(strtolower($_POST['first_name']))));

    $email = trim($_POST['email']);
    
    $password_1 = trim($_POST['password_1']);
    $password_2 = trim($_POST['password_2']);
  

     //POUR LA PHOTO DE PROFIL
     $avatar = strtolower(time() . '-' . $_FILES['avatar']['name']); //input de type file et securisation strtolower time (a etudier)
     

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
     $target_dir = "../../../public/images/uploads/avatar/";  //chemin du sossier ou les fichiers seront uploader
     $target_file = $target_dir . basename($avatar); //parametrage du nom de l image

     // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
     if ( !move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file) ) {
        array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
    }

    if (count($errors) == 0) {

        $password_hash = password_hash($password_2, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE QUI A ETE TRAITER EN AMONT
        
        $user_id = $_POST['user-id'];

        $reqt = "UPDATE users SET pseudo = '$pseudo', first_name = '$first_name', last_name = '$last_name', avatar = '$avatar', email = '$email', password = '$password_hash' WHERE id = '$user_id' ";
        
        $reqUpdate = $db_connect->prepare($reqt); //preparation de la requete
        $reqUpdate->execute(); //execution de la requete

        $log->log('utilisateurs', 'edit_utilisateurs', "Fonction updateUser() : Mise à jour utilisateur réussi", Log::FOLDER_MONTH);

        header('location: ./profile.php');
    } else {
        $log->log('utilisateurs', 'edit_utilisateurs', "Fonction updateUser() : Echec mise à jour utilisateur", Log::FOLDER_MONTH);
    }

}
/*
function deleteUser() {

    global  $db_connect, $log;

    // si le bouton supprimer est cliqué alors :
   
        // requete de suppression methode PDO
        $user_id = $_SESSION['user']['id'];
        $delete_account = 1;
        $reqt = "UPDATE users SET delete_account = '$delete_account' WHERE id = '$user_id' "; //supprime la ligne du compte en repérant l id en bdd en fontion de l id de session . L id de session est stocker dans la varaible $delete_id_user.
        $reqUpdate = $db_connect->prepare($reqt); //preparation de la requete
        $reqUpdate->execute(); //execution de la requete
        $log->log('utilisateurs', 'del_utilisateurs', "Fonction deleteUser() : suppression utilisateur", Log::FOLDER_MONTH);

        // On efface également les donnée en session pour evité des bug d affichage
        //si le compte disparait et que la session est tjs active ainsi on détruit aussi la session
        session_destroy();
        unset($_SESSION['user']);
        $redirect = BASE_URL . '/index.php';
        header('location: '.$redirect);

}
*/
// FONCTION SE DECONNECTER
function deconnexion() {
    global $db_connect;
    $user_id = $_SESSION['user']['id'];
    $sql = "UPDATE users SET auth = 0 WHERE id = '$user_id' ";
    $query = $db_connect->query($sql);
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

    
    $sql = "SELECT * FROM moukatages WHERE topic_id = '$topic_id' AND user_id = '$user_id'";
    $res = $db_connect->query($sql);
    $rows = $res->num_rows;

    if ( $rows > 0 ) {
        array_push($errors, "Vous avez déjà publier sur ce topic");
    } else {
        if ( count($errors) == 0 ) {
            $sql = "INSERT INTO moukatages ( topic_id, user_id, post, created_at ) VALUES ( '$topic_id','$user_id','$post', now() )";
            $res = $db_connect->query($sql);
            $log->log('moukatages', 'publier_commentaire', "Fonction publier() : " . $post, Log::FOLDER_MONTH);
        }
    }
    
}



function readUserById( $id ) {

    global $db_connect;

    $sql = "SELECT * from users WHERE id = '$id' ";
    $res = $db_connect->query($sql);
    $user = $res->fetch_array(MYSQLI_ASSOC);

    return $user;
}

function getAllUsers() {
    global $db_connect;
    $sql = "SELECT * FROM users ORDER BY created_at DESC";
    $query = $db_connect->query($sql);
    $all_users = $query->fetch_all(MYSQLI_ASSOC);
    return $all_users;
}

function dateToFrench($date, $format) {
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
  }

if ( isset($_SESSION['user']) ) {
    $user = readUserById( $_SESSION['user']['id'] );
    $user_id = $user['id'];
    $pseudo = $user['pseudo'];
    $role = $user['role'];
    $auth = $user['auth'];
    
}

?>