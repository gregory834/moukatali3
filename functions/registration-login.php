<?php
include 'server.php';
// include 'config.php';
// TRAITEMENT DES DONNE POST FORMULAIRE D INSCRIPTION

//TEST SIMPLE DU BOUTON SI FONCTIONNEL
if(isset($_POST["register"])){
    echo 'le boutton register est cliqué localisation registration-login.php';
}

// INITIALISATION DES VARIBLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE D INSERTION EN BASE DE DONNEE 
$pseudo = ""; //initialisation
$avatar = ""; 
$email = ""; 
$ville = ""; 
// $telephone ="";
$errors = array(); // VAR TABLEAUX QUI RECOIT LES MESSAGES D ERREUR POUR LE FORMULAIRE INSCRIPTION
$success_reg = false; //POUR DEFINIR LA REUSSITE DE L INSCRIPTION
$role = "user"; 

//SI LE BOUTON REGISTER EST CLIQUE ALORS :
if (isset($_POST["register"])) {

    // ON RECUPERE LES VALEURS SAISIES DES POSTS ET ON LES TRAITE
    $pseudo = trim($_POST['pseudo']);
    $avatar = $_POST['avatar']; //POUR LA PHOTO DE PROFIL
    $nom = htmlentities(trim(ucwords(strtolower($_POST['nom']))));
    $prenom = htmlentities(trim(ucwords(strtolower($_POST['prenom']))));
    $genre= trim($_POST['genre']); //BOLLEEN EN BDD
    $age = trim($_POST['age']);// TYPE DATE EN BDD
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $password_1 = trim($_POST['password_1']);
    $password_2 = trim($_POST['password_2']);
    $ville = htmlentities(trim(ucwords(strtolower($_POST['ville']))));

   
// VALIDATION DU FORMULAIRE

    // ON VERIFIE QUE LES CHAMPS SONT TOUS REMPLIES
    // ON PREPARE LES MESSAGE D ERREUR DANS NOTRE VARIBLE TABLEAUX $ERRORS []
    if (empty($pseudo)) {
        array_push($errors, "Entrer un pseudonyme");
    }
    if (empty($avatar)) {
        array_push($errors, "Entrer une photo de profil");
    }
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
    if ($password_1 != $password_2) {
        array_push($errors, "les deux mots de passe ne correspondent pas");
    }

    // OK OK OK OK OK OK

    
    // ON S ASSURE QU'UN UTILISATEUR N EST PAS DEJA ENREGISTRER
    //L EMAIL ET LE NOM UTILISATEUR DOIVENT ETRE UNIQUE
    
    $user_check_query = "SELECT * FROM users WHERE pseudo = '$pseudo' OR email = '$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {//SI L UTILISATEUR EXISTE
        if ($user['pseudo'] === $pseudo) {
            array_push($errors, "Ce nom d'utilisateur existe déjà"); //MESSAGE D ERREUR ASSOCIEE A LA CONDITION
        }
        if ($user['email'] === $email) {//MESSAGE D ERREUR ASSOCIEE A LA CONDITION
            array_push($errors, "l'email existe déjà");
        }
    }
    
    // OK OK OK OK OK OK OK
 
    // ON ENREGISTRE L UTILISATEUR SI IL N Y A AUCUNE ERREUR DANS LE FORMULAIRE
    // ON OUBLIE SURTOUT PAS DE ASSIGNER LE ROLE PAR DEFAUT EN TANT QUE UTILISATEUR
    // SI AUCUNE ERREUR EST TROUVE C EST A DIRE SI LE VARIABLE ERRORS RESTE VIDE. ALORS ON EFFECTUE LA REQUETE D INSERTION SQL EN BASE DE DONNEE.

    // OK OK OK OK OK OK OK 


    if (count($errors) == 0) {
       
        //ON CRYPTE LE MOT DE PASSE AVANT L ENREGISTREMENT DANS LA BASE DE DONNEES

        $password = password_hash($password_1, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE ET TRAITER EN AMONT
        
        $query = "INSERT INTO `users` (pseudo, password) VALUES ('$pseudo', '$password')";
        mysqli_query($db, $query);
        
        // REQUETE D INSERTION (CREATION) UTILISATEUR EN BASSE DE DONEE. 13 INFORMATIONS AU TOTAL INSERTION DANS L ODRE DE LA TABLE EN BASSE DE DONNEE
        $sql = "INSERT INTO `users` (id, pseudo, prenom, nom, age, avatar, ville, telephone, email, password, genre, role, date_inscription) VALUES ((SELECT id from users WHERE pseudo = '$pseudo'), '$pseudo','$prenom','$nom', '$age', '$avatar', '$ville', '$telephone', '$email', '$password', '$genre', '$role', now())";

        // OK OK OK OK OK OK

        // TEST REQUETE FONCTIONNELLE EN BDD
        // ATTENTION AU DUPLICATA DES ID ET DES CLE PRIMAIRE COMME PSEUDO
        //INSERT INTO `users` (pseudo, prenom, nom, age, avatar, ville, telephone, email, password, genre, role, date_inscription) VALUES ( "pseudoO","prenom","nom", "34", "avatar", "ville", 0000000000, "email", "hashpasswor", 1, "user", now())


        // $id = uniqid((double)microtime()*1000000, true);
        // echo $id;

        // //mysqli_query($db, $query);
        // if (mysqli_query($db, $sql)) {
        //     $success_reg = true;
        //     header('location: connection.php');
        // } else {
        //     echo 'ERREUR BDD';
        // }
    }

}





// CONNEXION DE L'UTILISATEUR
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Nom d'utilisateur requis");
    }
    if (empty($password)) {
        array_push($errors, "Mot de passe requis");
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($db, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                // mettre les info utiles de l'utilisateur connecté dans le tableau de session
                $_SESSION['user'] = getInfoById($user['id']);

                // si l'utilisateur est administrateur, redirigez vers la zone d'administration
                if (in_array($_SESSION['user']['role'], ["admin", "author", "moderator"])) {
                    //$_SESSION['message'] = "Vous êtes maintenant connecté";
                    // rediriger vers la zone d'administration
                    header('location: admin/dashboard.php');
                    exit(0);
                } else {
                    //$_SESSION['message'] = "Vous êtes maintenant connecté";
                    // rediriger vers la zone publique
                    header('location: index.php');
                    exit(0);
                }
            } else {
                array_push($errors, "Mauvais identifiants");
            }

        } else {
            array_push($errors, "Vous n'êtes pas inscrit");
        }
        
    }
}

// Obtenir des informations sur l'utilisateur à partir de l'identifiant de l'utilisateur
function getUserById($id) {
    global $db;
    $sql = "SELECT * FROM user_info WHERE user_id = $id LIMIT 1";

    $result = mysqli_query($db, $sql);
    $user_info = mysqli_fetch_assoc($result);

    //renvoie les info utilisateur dans un format de tableau:
    // ['id' => 1, 'username' => 'Pseudo', 'email'=>'a@a.com', 'password'=> 'mot de passe']
    return $user_info;
}

function getInfoById($id) {
    global $db;
    $sql = "SELECT * FROM user_info WHERE user_id = $id LIMIT 1";

    $result = mysqli_query($db, $sql);
    $info = mysqli_fetch_assoc($result);
    $user_session['user_id'] = $info['user_id'];
    $user_session['username'] = $info['username'];
    if ($info['role'] != NULL) {
        $user_session['role'] = $info['role'];
    }
    
    return $user_session;

}

// ************* LOGOUT ************* //
if (isset($_GET['logout'])) {

    session_destroy();
    unset($_SESSION['user']);
    header('location: index.php');

}
