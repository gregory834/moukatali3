<?php

// variables utilisateur Admin
$admin_id = 0;
$username = "";
$first_name = "";
$last_name = "";
$email = "";
$role ="";
$topic_title= "";
$topic_description = "";
$errors = array();
$update = false;
$update_topic= false;

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

// si l'utilisateur clique sur le bouton mettre à jour
if (isset($_POST['update-admin'])) {
    updateAdmin($_POST);
}

// si l'utilisateur clique sur l'icône supprimer
if (isset($_GET['delete-admin'])) {
    $admin_id = $_GET['delete-admin'];
    deleteAdmin($admin_id);
}

// Reçoit les nouvelles données d'administration du formulaire
// Créer un nouvel utilisateur administrateur
// Renvoie tous les utilisateurs administrateurs avec leurs rôles
function createAdmin($request_values) {

    global $db, $errors, $role, $username, $email, $first_name, $last_name;

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
    // Assurez-vous qu'aucun utilisateur n'est enregistré deux fois
    // l'e-mail et les noms d'utilisateur doivent être uniques
    $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {// si l'utilisateur existe
        if ($user['username'] === $username) {
            array_push($errors, "Ce nom d'utilisateur existe déjà");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Cet adresse mail existe déjà");
        }
    }
    // enregistrer l'utilisateur s'il n'y a pas d'erreurs dans le formulaire
    if (count($errors) == 0) {
        // crypter le mot de passe avant de l'enregistrer dans la base de données
        $password = password_hash($password_1, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($db, $query);

        $sql = "INSERT INTO user_info (user_id, username, first_name, last_name, email, password, my_points, vote_for, vote_against, my_vote_for, my_vote_against, role, registration_date, update_date) VALUES ((SELECT id from users WHERE username = '$username'), '$username','$first_name','$last_name', '$email', '$password', 0, 0, 0, 0, 0, '$role', now(), now())";
        
		mysqli_query($db, $sql);

		$_SESSION['message'] = "Administrateur créé avec succès";
		header('location: dashboard.php');
		exit(0);
	}
}

// Prend l'ID d'administrateur comme paramètre
// Récupère l'administrateur de la base de données
// définit les champs d'administration du formulaire pour l'édition
function editAdmin($admin_id) {
    global $db, $username, $role, $update, $admin_id, $email, $first_name, $last_name;

    $sql = "SELECT * FROM user_info WHERE user_id = $admin_id LIMIT 1";
    $result = mysqli_query($db, $sql);
    $admin = mysqli_fetch_assoc($result);
    // définir les valeurs du formulaire ($ username et $ email) sur le formulaire à mettre à jour
    $username = $admin['username'];
    $first_name = $admin['first_name'];
    $last_name = $admin['last_name'];
    $email = $admin['email'];
    $role = $admin['role'];
}

// récupére les entrées du formulaire et met à jour la base de données
function updateAdmin($request_values) {

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

	if(isset($request_values['role'])){
		$role = $request_values['role'];
    }
    // enregistrer l'utilisateur s'il n'y a pas d'erreurs dans le formulaire
	if (count($errors) == 0) {
		// crypter le mot de passe avant de l'enregistrer dans la base de données
        $password = password_hash($password_1, PASSWORD_DEFAULT);

        $query = "UPDATE users SET username = '$username', password = '$password' WHERE id = $admin_id";
        /*mysqli_query($db, $query);*/
        if (mysqli_query($db, $query)) {
            echo '1 OK';
        } else {
            exit('ERREUR 1');
        }

		$sql = "UPDATE user_info SET username='$username', first_name = '$first_name', last_name = '$last_name', email = '$email', role = '$role', password = '$password' WHERE user_id = $admin_id";
        mysqli_query($db, $sql);
        if (mysqli_query($db, $sql)) {
            echo '2 OK';
        } else {
            exit('ERREUR 2');
        }

		$_SESSION['message'] = "L'administrateur a bien été mis à jour";
		header('location: dashboard.php');
		exit(0);
	}

}

// supprimer l'utilisateur administrateur
function deleteAdmin($admin_id) {
    global $db;
    $sql = "DELETE FROM users WHERE id = $admin_id";
    if (mysqli_query($db, $sql)) {
        $_SESSION['message'] = "L'utilisateur a bien été supprimé";
        header("location: dashboard.php");
		exit(0);
    }
}

function getAdminUsers() {
    global $db, $roles;
    $sql = "SELECT * FROM user_info WHERE role IS NOT NULL";
    $result = mysqli_query($db, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
}

function getAllUsers() {
    global $db, $roles;
    $sql = "SELECT * FROM user_info WHERE role IS NULL";
    $result = mysqli_query($db, $sql);
    $all_users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_users;
}
//*******************************************************************************************************************************//




?>