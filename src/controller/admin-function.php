<?php

//initialisation des variables que l-on appellera dans les fonctions avec (globals)

$pseudo = "";
$email = "";
$last_name = "";
$first_name = "";
$role = "";
$update = "false";
$errors = array(); // VAR TABLEAUX QUI RECOIT LES MESSAGES D ERREUR POUR LE FORMULAIRE INSCRIPTION
$success = array ();


$roles = ['admin', 'author', 'user']; //pour l'attribution des roles dans l'input des roles
// $role = ['Admin'];

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
// si je clique sur le bouton se déconnecter
if ( isset($_POST['deconnexion']) ) {
    deconnexion();
}

// global $last_name;


function createAdmin($request_values)
{
    global $db_connect, $errors, $success, $role, $last_name, $first_name;

    $pseudo = trim($request_values['pseudo']);


    $last_name = htmlentities(trim(ucwords(strtolower($request_values['last_name']))));

    $first_name = htmlentities(trim(ucwords(strtolower($request_values['first_name']))));

    $email = trim($request_values['email']);

    $password_1 = trim($request_values['password_1']);

    $password_2 = trim($request_values['password_2']);

    $role = trim($request_values['role']);
    // if (isset($request_values['role'])) {
    //     $role = trim($request_values['role']);
    // }

    
    // validation du formulaire: assurez-vous que le formulaire est correctement rempli
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


        /******************************************************
     * VERIFICATION DOUBLON EMAIL METHODE PDO *
     *************************************************/
    //UN UTILISATEUR NE DOIT PAS POUVOIR S INSCRIRE DEUX FOIS AVEC LES MEME IDENTIFIANT
    // l'e-mail et les noms d'utilisateur doivent être uniques

    $reqt  = "SELECT * FROM moukatali.users WHERE email = '$email' OR pseudo = '$pseudo' LIMIT 1"; //requete de selection dans table user en fonction de l email
    $reqEmail = $db_connect->prepare($reqt); //préparation de la requete
    $reqEmail->execute([$email]);  //EXECUTION DE LA REQUETE
    $doublonEmail = $reqEmail->fetch();  //RECUPERATION RESULTAT DE LA REQUETE AUTREMENT DIT SI UN DOUBLON EST TROUVER EN FONCTION DE L EMAIL FOURNI
    // SI DOUBLON EXISTANT
    if ($doublonEmail) {
        array_push($errors, "Pseudo ou Email déjà existant");
    }
   
     
    // enregistrer l'utilisateur s'il n'y a pas d'erreurs dans le formulaire

    if (count($errors) == 0) {

        // crypter le mot de passe avant de l'enregistrer dans la base de données
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        //   FONCTIONNE AVEC CHOIS DU ROLE A L INSCRITION ADMIN



        $reqt = "INSERT INTO moukatali.users ( pseudo, first_name, last_name, email, password, role, created_at ) VALUES ( '$pseudo','$first_name','$last_name', '$email', '$password', '$role', now() )";

        $reqInsert = $db_connect->prepare($reqt); //preparation de la requete
        $reqInsert->execute(); //execution de la requete

        // var_dump($resultReqInsert1);
        array_push($success, "Compte  créé avec succès ");

        // verification par message erreur
        return $success;
        return $errors;
        exit(0);
        
    }
    // array_push($success, "Compte  créé avec succès ");
}




// GOOD
// Prend l'ID d'administrateur comme paramètre
// Récupère l'administrateur de la base de données
// définit les champs d'administration du formulaire pour l'édition
// récupére les entrées du formulaire et met à jour la base de données



function editAdmin($admin_id)
{
    global $db_connect, $pseudo, $role, $update, $admin_id, $email, $first_name, $last_name;
    $sql = "SELECT * FROM moukatali.users WHERE id = $admin_id LIMIT 1";
    $pdoStat = $db_connect->prepare($sql);
    $executeIsOk = $pdoStat->execute();
    $admin = $pdoStat->fetch();

    // définir les valeurs du formulaire ($ username et $ email) sur le formulaire à mettre à jour
    $pseudo = $admin['pseudo'];
    $first_name = $admin['first_name'];
    $last_name = $admin['last_name'];
    $email = $admin['email'];
    $role = $admin['role'];
}


//METTRE A JOUR UN PROFIL
function updateAdmin($request_values)
{
    global $db_connect, $errors,$success, $role, $pseudo, $update, $admin_id, $email, $first_name, $last_name;
    // obtenir l'identifiant de l'administrateur à mettre à jour
    $admin_id = $request_values['admin_id'];
    // définir l'état d'édition sur faux
    $update = false;
    $pseudo = trim($request_values['pseudo']);
    $first_name = htmlentities(trim(ucwords(strtolower($request_values['first_name']))));
    $last_name = htmlentities(trim(ucwords(strtolower($request_values['last_name']))));
    $email = trim($request_values['email']);
    $password_1 = trim($request_values['password_1']);
    $password_2 = trim($request_values['password_2']);

  // validation du formulaire: assurez-vous que le formulaire est correctement rempli
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

    if (isset($request_values['role'])) {
        $role = $request_values['role'];
    }


        /******************************************************
     * VERIFICATION DOUBLON EMAIL METHODE PDO *
     * on ne vérifie plus le doublon d email car si on update alors que l on ne souhaote pas changer cette vaaleur ce la bloquera les modif. a defaut, le champs sera vide pour le pseudo ou l email car elle sont definit en unique dans la bdd
     *************************************************/



    // enregistrer l'utilisateur s'il n'y a pas d'erreurs dans le formulaire
    if (count($errors) == 0) {
        // crypter le mot de passe avant de l'enregistrer dans la base de données
        $password = password_hash($password_1, PASSWORD_DEFAULT);


        $sql = "UPDATE moukatali.users SET pseudo='$pseudo', first_name = '$first_name', last_name = '$last_name', email = '$email', role = '$role', password = '$password' WHERE id = $admin_id";

        $reqInsert1 = $db_connect->prepare($sql); //preparation de la requete
        $reqInsert1->execute(); //execution de la requete
        array_push($success, "Mise à jour du profil réussie ! ");

    }
}


//GOOD
// supprimer l'utilisateur administrateur
function deleteAdmin($admin_id)
{
    global $db_connect, $success;
    $sql1 = "DELETE FROM moukatali.users WHERE id = $admin_id";
    $reqDeleteAdmin = $db_connect->prepare($sql1); //preparation de la requete
    $reqDeleteAdmin->execute(); //execution de la requete
    array_push($success, "Compte administrateur supprimé avec succès ");
}

//GOOD
// supprimer l'utilisateur administrateur
function deleteUser($delete_id_user)
{
    global $db_connect,  $delete_id_user;
    $delete_id_user = $_GET['delete-user'];
    $sql1 = "DELETE FROM moukatali.users WHERE id = $delete_id_user LIMIT 1";
    $reqDeleteAdmin = $db_connect->prepare($sql1); //preparation de la requete
    $reqDeleteAdmin->execute(); //execution de la requete
}


// FONCTION SE DECONNECTER
function deconnexion() {
    session_destroy();
    unset( $_SESSION['user'] );
    $redirect = BASE_URL . '/src/index.php';
    header('location: '.$redirect);
}

// ON RECU¨PERE TOUT CE QUI SE TROUVE DANS LA TABLE moukatali.users
function readAllAdmin() {

    global $db_connect;
    $admin = "admin";
    $author = "author";
    $reqt = "SELECT * FROM moukatali.users WHERE role = '$admin' OR role = '$author' ";
    $query = $db_connect->query($reqt);
    $admins = $query->fetchAll();
    return $admins;



// FONCTION POUR RECUPERER LES INFO UTILISATEUR
function readUserById($id)
{
    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/
    global $db_connect;

    $requete = "SELECT * from moukatali.users where id = '$id' ";
    $stmt = $db_connect->query($requete);
    $users = $stmt->fetch();

    return $users;
}
} 


// POUR LA PAGE AVEC LA LISTE DE TOUT LES MOUKATEUR AU ROLE DE USER
// ok fonctionelle
function getAllUsers()
{
    
    global $db_connect;
    $requet = "SELECT * FROM moukatali.users WHERE role= 'user'";
    $stmt = $db_connect->prepare($requet);
    $stmt->execute();
    $all_users = $stmt->fetchAll();
    return $all_users;
}











