<?php

$pseudo = "";
$email = "";
$last_name = "";
$first_name = "";
$role = "";
$update = "false";
$errors = array();
$success = array ();


$roles = ['admin', 'author', 'user'];

// si je clique sur le bouton créer un administrateur
if ( isset($_POST['create-admin']) ) {
    createAdmin($_POST);
}
// si je clique sur l'icône modifier
if ( isset($_GET['edit-admin']) ) {
    $update = true;
    $admin_id = $_GET['edit-admin'];
    editAdmin($admin_id);
}
// si je clique sur l'icône supprimer un admin
if ( isset($_GET['delete-admin']) ) {
    $admin_id = $_GET['delete-admin'];
    deleteAdmin($admin_id);
}
// si je clique sur le bouton mettre à jour
if ( isset($_POST['update-admin']) ) {
    updateAdmin($_POST);
}
// si je clique sur l'icône supprimer un utilisateur
if (isset($_GET['delete-user'])) {
    $delete_id_user = $_GET['delete-user'];
    deleteAdmin($delete_id_user);
}
// si je clique sur le bouton se déconnecter
if ( isset($_POST['deconnexion']) ) {
    deconnexion();
}


function createAdmin($request_values) {

    global $db_connect, $errors, $success, $role, $last_name, $first_name;

    $pseudo = trim($request_values['pseudo']);
    $last_name = htmlentities(trim(ucwords(strtolower($request_values['last_name']))));
    $first_name = htmlentities(trim(ucwords(strtolower($request_values['first_name']))));
    $email = trim($request_values['email']);
    $password_1 = trim($request_values['password_1']);
    $password_2 = trim($request_values['password_2']);
    $role = trim($request_values['role']);

    switch ($role) {
        case "admin":
            $avatar = "admin.png";
            break;
        case "author":
            $avatar  = "author.png";
            break;
        case "user":
            $avatar = "user.png";
            break;
    }
    
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
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users ( pseudo, avatar, first_name, last_name, email, password, role, created_at ) VALUES ( '$pseudo', '$avatar', '$first_name', '$last_name', '$email', '$password', '$role', now() )";
        $query = $db_connect->query($sql); 
        array_push($success, "Compte créé avec succès ");
    }
    
}


function editAdmin($admin_id) {

    global $db_connect, $pseudo, $role, $update, $admin_id, $email, $first_name, $last_name;
    $sql = "SELECT * FROM users WHERE id = $admin_id LIMIT 1";
    $query = $db_connect->query($sql);
    $admin = $query->fetch_array(MYSQLI_ASSOC);

    $pseudo = $admin['pseudo'];
    $first_name = $admin['first_name'];
    $last_name = $admin['last_name'];
    $email = $admin['email'];
    $role = $admin['role'];

}


//METTRE A JOUR UN PROFIL
function updateAdmin($request_values) {

    global $db_connect, $errors,$success, $role, $pseudo, $update, $admin_id, $email, $first_name, $last_name;
    
    $admin_id = $request_values['admin_id'];
    $update = false;
    $pseudo = trim($request_values['pseudo']);
    $first_name = htmlentities(trim(ucwords(strtolower($request_values['first_name']))));
    $last_name = htmlentities(trim(ucwords(strtolower($request_values['last_name']))));
    $email = trim($request_values['email']);
    $password_1 = trim($request_values['password_1']);
    $password_2 = trim($request_values['password_2']);

  
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
    if (isset($request_values['role'])) {
        $role = $request_values['role'];
    }

    if (count($errors) == 0) {     
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET pseudo='$pseudo', first_name = '$first_name', last_name = '$last_name', email = '$email', role = '$role', password = '$password' WHERE id = $admin_id";
        $query = $db_connect->query($sql);
        $_SESSION['user']['role'] = $role;
        array_push($success, "Mise à jour du profil réussie !");
    }

}

// supprimer l'utilisateur administrateur
function deleteAdmin($id) {

    global $db_connect, $success;
    $sql = "DELETE FROM users WHERE id = $id";
    $query = $db_connect->query($sql); //preparation de la requete
    array_push($success, "Compte supprimé avec succès ");
}


function readAllAdmin() {

    global $db_connect;
    $admin = "admin";
    $author = "author";
    $reqt = "SELECT * FROM users WHERE role = '$admin' OR role = '$author' ";
    $query = $db_connect->query($reqt);
    $admins = $query->fetch_all(MYSQLI_ASSOC);
    return $admins;

} 

?>