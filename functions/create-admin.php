<?php

// 8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
require_once('bdd-connect.php');
connectPdoBdd();
echo 'Connection à la base de donnée OK <br/>';
$db = connectPdoBdd();
// variables utilisateur Admin
$admin_id = 0;
$delete_id_user= 0;
$username = "";
$first_name = "";
$last_name = "";
$email = "";
$role = "";
$role = "Admin";
$topic_title = "";
$topic_description = "";
$errors = array();
$update = false;
$update_topic = false;
$success = array();
global $db, $errors, $role, $username, $email, $first_name, $last_name, $success;
// 88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
// si l'utilisateur clique sur le bouton créer un administrateur
if (isset($_POST['create-admin'])) {
    createAdmin($_POST);
}
// si l'utilisateur clique sur l'icône modifier
if (isset($_GET['edit-admin'])) {
    $update = true;
    $admin_id = $_GET['edit-admin'];
    editAdmin($admin_id);
}
if (isset($_GET['delete-admin'])) {
    $admin_id = $_GET['delete-admin'];
    deleteAdmin($admin_id);
}
// si l'utilisateur clique sur le bouton mettre à jour
if (isset($_POST['update-admin'])) {
    updateAdmin($_POST);
}
//supprime un user
if (isset($_GET['delete-user'])) {
    $delete_id_user = $_GET['delete-user'];
    deleteAdmin($delete_id_user);
}
// 88888888888888888888888888888888888888888888888888888
// POUR LE TABLEAU LISTE DE TOUT LES ADMINS AUTHOR ET MODERATOR
global $db, $roles;
// $roles = ['Admin', 'Author', 'Moderator', 'User'];
$role = "Admin";
$db = connectPdoBdd();
$sql = "SELECT * FROM users WHERE role = 'admin' OR role = 'author' OR role = 'moderator' ";
$pdoStat = $db->prepare($sql);
$executeIsOk = $pdoStat->execute();
$listes_AdminAuthorModerator = $pdoStat->fetchAll();
// var_dump($users['pseudo']);
global $users;
// 88888888888888888888888888888888888888888888888888888
function createAdmin($request_values)
{
    global $db, $errors, $role, $username, $email, $first_name, $last_name, $success;
    require_once('bdd-connect.php');
    connectPdoBdd();
    echo 'Connection à la base de donnée OK <br/>';
    $username = trim($request_values['username']);
    $first_name = htmlentities(trim(ucwords(strtolower($request_values['first-name']))));
    $last_name = htmlentities(trim(ucwords(strtolower($request_values['last-name']))));
    $email = trim($request_values['email']);
    $password_1 = trim($request_values['password-1']);
    $password_2 = trim($request_values['password-2']);
    if (isset($request_values['role'])) {
        $role = trim($request_values['role']);
    }
    // validation du formulaire: assurez-vous que le formulaire est correctement rempli
    if (empty($username)) {
        array_push($errors, "Entrer un nom d'utilisateur");
    }
    if (empty($first_name)) {
        array_push($errors, "Entrer votre prénom");
    }
    if (empty($last_name)) {
        array_push($errors, "Entrer votre nom");
    }
    if (empty($email)) {
        array_push($errors, "Entrer une adresse mail");
    }
    if (empty($role)) {
        array_push($errors, "Le rôle est requis pour les utilisateurs administrateurs");
    }
    if (empty($password_1)) {
        array_push($errors, "Vous avez oublié le mot de passe");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "les deux mots de passe ne correspondent pas");
    }
    // 888888888888888888888888888888888888888888888888888888888888888888
    /******************************************************
     * VERIFICATION BOUBLON EMAIL METHODE PDO *
     *************************************************/
    //UN UTILISATEUR NE DOIT PAS POUVOIR S INSCRIRE DEUX FOIS AVEC LES MEME IDENTIFIANT
    // l'e-mail et les noms d'utilisateur doivent être uniques
    echo 'start recherche doublons <br/>';
    $pdo =  connectPdoBdd(); //connection a la bdd
    $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE  email = '$email' LIMIT 1"; //requete de selection dans table user en fonction de l email
    $reqEmail = $pdo->prepare("SELECT * FROM `users` WHERE email='$email'"); //préparation de la requete
    $reqEmail->execute([$email]);  //EXECUTION DE LA REQUETE
    $doublonEmail = $reqEmail->fetch();  //RECUPERATION RESULTAT DE LA REQUETE AUTREMENT DIT SI UN DOUBLON EST TROUVER EN FONCTION DE L EMAIL FOURNI
    // SI DOUBLON EXISTANT
    if ($doublonEmail) {
        if ($doublonEmail['email'] === $email) {
            array_push($errors, "Attention ! Cette addresse email existe déjà !");
            return $errors;
        }
        //SI AUCUN DOUBLON ECHO TEST ET ON CONTINUE
    } else {
        echo 'AUCUN DOUBLON EMAIL TROUVER <br/>';
    }
    /**********************************************
     * VERIFICATION BOUBLON PSEUDONYME METHODE PDO *
     **********************************************/
    //  IDEM QUE POUR L EMAIL. C EST UN CHOIX DE SEPARER LES DEUX REQUETE AU LIEU D EN FAIRE UNE POUR DEUX. LE BUT ETANT DE BIEN AVANCER ETAPE PAR ETAPE
    $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE pseudo = '$username' LIMIT 1";
    $reqPseudo = $pdo->prepare("SELECT * FROM `users` WHERE pseudo='$username'");
    $reqPseudo->execute([$username]);
    $doublonPseudo = $reqPseudo->fetch();
    if ($doublonPseudo) { // email existant
        if ($doublonPseudo['pseudo'] === $username) {
            array_push($errors, "Attention ! Ce Pseudonyme existe déjà !");
            return $errors;
        }
        // SI AUCUN DOUBLON ECHO TEST ET ON CONTINUE
    } else { // email n'existe pas
        echo 'AUCUN DOUBLON PSEUDO TROUVER <br/>';
    }
    echo 'Fin de recherche de doublons <br/>';
    // 88888888888888888888888888888888888888888888888888888888888888888
    // enregistrer l'utilisateur s'il n'y a pas d'erreurs dans le formulaire
    if (count($errors) == 0) {
        // crypter le mot de passe avant de l'enregistrer dans la base de données
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        //   FONCTIONNE AVEC CHOIS DU ROLE A L INSCRITION ADMIN
        $db = connectPdoBdd();
        $sql = "INSERT INTO users (  pseudo, prenom, nom, email, password,  role, date_inscription) VALUES ( '$username','$first_name','$last_name', '$email', '$password',  '$role', now())";
        $reqInsert1 = $db->prepare($sql); //preparation de la requete
        $reqInsert1->execute(); //execution de la requete
        $resultReqInsert1 = $reqInsert1;
        var_dump($resultReqInsert1);
        array_push($success, "Compte  créé avec succès ");
        // verification par message erreur
        return $success;
        return $errors;
        exit(0);
        // 888888888888888888888888888888888888888888888888888888888888888888888888888
    }
    array_push($success, "Compte  créé avec succès ");
}
// 88888888888888888888888888888888888888888888888888888
//*******************************************************************************************************************************//
// 88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
// GOOD
// Prend l'ID d'administrateur comme paramètre
// Récupère l'administrateur de la base de données
// définit les champs d'administration du formulaire pour l'édition
// récupére les entrées du formulaire et met à jour la base de données
function editAdmin($admin_id)
{
    global $db, $username, $role, $update, $admin_id, $email, $first_name, $last_name;
    $sql = "SELECT * FROM `users` WHERE id = $admin_id LIMIT 1";
    $pdoStat = $db->prepare($sql);
    $executeIsOk = $pdoStat->execute();
    $admin = $pdoStat->fetch();
    // définir les valeurs du formulaire ($ username et $ email) sur le formulaire à mettre à jour
    $username = $admin['pseudo'];
    $first_name = $admin['nom'];
    $last_name = $admin['prenom'];
    $email = $admin['email'];
    $role = $admin['role'];
}
// 88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
function updateAdmin($request_values)
{
    global $db, $errors, $role, $username, $update, $admin_id, $email, $first_name, $last_name;
    // obtenir l'identifiant de l'administrateur à mettre à jour
    $admin_id = $request_values['admin_id'];
    // définir l'état d'édition sur faux
    $update = false;
    $username = trim($request_values['username']);
    $first_name = htmlentities(trim(ucwords(strtolower($request_values['first-name']))));
    $last_name = htmlentities(trim(ucwords(strtolower($request_values['last-name']))));
    $email = trim($request_values['email']);
    $password_1 = trim($request_values['password-1']);
    $password_2 = trim($request_values['password-2']);
    if (isset($request_values['role'])) {
        $role = $request_values['role'];
    }
    // enregistrer l'utilisateur s'il n'y a pas d'erreurs dans le formulaire
    if (count($errors) == 0) {
        // crypter le mot de passe avant de l'enregistrer dans la base de données
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $query = "UPDATE users SET pseudo = '$username', password = '$password' WHERE id = $admin_id";

        $reqInsert1 = $db->prepare($query); //preparation de la requete
        $reqInsert1->execute(); //execution de la requete

     
        $sql = "UPDATE users SET pseudo='$username', prenom = '$first_name', nom = '$last_name', email = '$email', role = '$role', password = '$password' WHERE id = $admin_id";

        $reqInsert1 = $db->prepare($sql); //preparation de la requete
        $reqInsert1->execute(); //execution de la requete
    }
}
// 88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
//GOOD
// supprimer l'utilisateur administrateur
function deleteAdmin($admin_id)
{
    global $db, $success;
    $sql1 = "DELETE FROM users WHERE id = $admin_id";
    $reqDeleteAdmin = $db->prepare($sql1); //preparation de la requete
    $reqDeleteAdmin->execute(); //execution de la requete
    array_push($success, "Compte administrateur supprimé avec succès ");
}
// 88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
// POUR LA PAGE AVEC LA LISTE DE TOUT LES MOUKATEUR AU ROLE DE USER
global $all_users;
// 8888888888888888888888888
// ok fonctionelle
function getAllUsers()
{
    global $all_users;
    global $db, $roles;
    $admin = "role";
    $db = connectPdoBdd();
    $requet = "SELECT * FROM users WHERE role= 'user'";
    $stmt = $db->query($requet);
    $all_users = $stmt->fetchAll();
    return $all_users;
}

//GOOD
// supprimer l'utilisateur administrateur
function deleteUser($delete_id_user)
{
    global $db,  $delete_id_user;
    $delete_id_user = $_GET['delete-user'];
    $sql1 = "DELETE FROM users WHERE id = $delete_id_user LIMIT 1";
    $reqDeleteAdmin = $db->prepare($sql1); //preparation de la requete
    $reqDeleteAdmin->execute(); //execution de la requete
}