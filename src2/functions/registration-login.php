<?php
// déclaration de variable
$username = "";
$email = "";
$errors = array(); // tableau qui recevra les erreurs du formulaire
$success_reg = false;

// INSCRIPTION UTILISATEUR
if (isset($_POST['register'])) {
    // récupére les valeurs d'entrées du formulaire
    $username = trim($_POST['username']);
    $first_name = htmlentities(trim(ucwords(strtolower($_POST['first-name']))));
    $last_name = htmlentities(trim(ucwords(strtolower($_POST['last-name']))));
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password_1 = trim($_POST['password-1']);
    $password_2 = trim($_POST['password-2']);
    // validation du formulaire
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
    if (empty($phone)) {
        array_push($errors, "Entrer votre numéro de téléphone");
    }
    if (empty($password_1)) {
        array_push($errors, "Vous avez oublié le mot de passe");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "les deux mots de passe ne correspondent pas");
    }
    // on s'assure qu'aucun utilisateur n'est enregistré deux fois.
    // l'email et les noms d'utilisateur doivent être uniques.
    $user_check_query = "SELECT * FROM user_info WHERE username = '$username' OR email = '$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {// si l'utilisateur existe
        if ($user['username'] === $username) {
            array_push($errors, "Ce nom d'utilisateur existe déjà");
        }
        if ($user['email'] === $email) {
            array_push($errors, "l'email existe déjà");
        }
    }
    // enregistrer l'utilisateur s'il n'y a pas d'erreurs dans le formulaire
    if (count($errors) == 0) {
        // crypter le mot de passe avant de l'enregistrer dans la base de données
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($db, $query);
        
        $sql = "INSERT INTO user_info (user_id, username, first_name, last_name, email, phone, password, my_points, vote_for, vote_against, my_vote_for, my_vote_against, registration_date, update_date) VALUES ((SELECT id from users WHERE username = '$username'), '$username','$first_name','$last_name', '$email', '$phone', '$password', 0, 0, 0, 0, 0, now(), now())";
        //mysqli_query($db, $query);
        if (mysqli_query($db, $sql)) {
            $success_reg = true;
            header('location: login.php');
        } else {
            echo 'ERREUR BDD';
        }
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

?>