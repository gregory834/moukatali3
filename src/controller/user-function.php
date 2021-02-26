<?php

// INITIALISATION DES VARIBLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE D INSERTION EN BASE DE DONNEE 
$pseudo = ""; //initialisation
$email = "";
$last_name = "";
$first_name = "";

$errors = array(); // VAR TABLEAUX QUI RECOIT LES MESSAGES D ERREUR POUR LE FORMULAIRE INSCRIPTION

// Si je clique sur le bouton inscription
if (isset($_POST['register'])) {
    registerUser();
}

// si je clique sur le bouton connexion
if (isset($_POST['connexion'])) {
    connexionUser();
}

// si je clique sur le bouton modifier
if (isset($_POST['modifier'])) {
    updateUser();
}

// si je clique sur supprimer
if (isset($_POST['supprimer'])) {
    deleteUser();
}




// FONCTION INSCRIPTION
function registerUser()
{

    global $db_connect, $errors;

    /************************************************************************************
     * TRAITEMENT DES VARIABLES POST RECUPERER DEPUIS PAGE INSCRIPTION APRES LE CLIQUE *
     *********************************************************************************/
    // ON RECUPERE LES VALEURS SAISIES DES POSTS DANS LE FORMULAIRE ET ON LES TRAITE
    $pseudo = trim($_POST['pseudo']);

    $avatar = strtolower(time() . '-' . $_FILES['avatar']['name']);

    $last_name = htmlentities(trim(ucwords(strtolower($_POST['last_name']))));

    $first_name = htmlentities(trim(ucwords(strtolower($_POST['first_name']))));

    $email = trim($_POST['email']);

    $role = "user";

    $password_1 = trim($_POST['password_1']);

    $password_2 = trim($_POST['password_2']);

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
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        array_push($errors, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
    }

    // PARAMETRAGE DES VARIBLES D ACCES, EXTENSION, UPLOAD, ET DU DOSSIER DE DESTINATION DES IMAGES UPLOADER
    $target_dir = "../../public/images/uploads/";  //chemin du sossier ou les fichiers seront uploader
    $target_file = $target_dir . basename($avatar); //parametrage du nom de l image

    // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
        array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
    }

    /******************************************************
     * VERIFICATION DOUBLON EMAIL METHODE PDO *
     *************************************************/
    //UN UTILISATEUR NE DOIT PAS POUVOIR S INSCRIRE DEUX FOIS AVEC LES MEME IDENTIFIANT
    // l'e-mail et les noms d'utilisateur doivent être uniques

    $reqt  = "SELECT * FROM  `users` WHERE  email = '$email' OR pseudo = '$pseudo' LIMIT 1"; //requete de selection dans table user en fonction de l email
    $reqEmail = $db_connect->prepare($reqt); //préparation de la requete
    $reqEmail->execute([$email]);  //EXECUTION DE LA REQUETE
    $doublonEmail = $reqEmail->fetch();  //RECUPERATION RESULTAT DE LA REQUETE AUTREMENT DIT SI UN DOUBLON EST TROUVER EN FONCTION DE L EMAIL FOURNI
    // SI DOUBLON EXISTANT
    if ($doublonEmail) {
        array_push($errors, "Pseudo ou Email déjà existant");
    }

    if (count($errors) == 0) { // Si le tableau erreurs est vide

        //ON CRYPTE LE MOT DE PASSE AVANT L ENREGISTREMENT DANS LA BASE DE DONNEES
        $password_hash = password_hash($password_2, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE QUI A ETE TRAITER EN AMONT

        // REQUETE D INSERTION (CREATION) UTILISATEUR EN BASSE DE DONEE. 13 INFORMATIONS AU TOTAL INSERTION DANS L ODRE DE LA TABLE EN BASSE DE DONNEE
        //  ID EST AUTO INCREMENTER EN BDD

        $reqt = "INSERT INTO `users` ( pseudo, first_name, last_name, avatar, email, password, role, created_at ) VALUES ( '$pseudo','$first_name','$last_name', '$avatar', '$email', '$password_hash', '$role', now() )";

        $reqInsert = $db_connect->prepare($reqt); //preparation de la requete
        $reqInsert->execute(); //execution de la requete

        header('location: ./login.php');
    }
}

// FONCTION CONNEXION UTILISATEUR
function connexionUser()
{

    global $db_connect, $errors;

    $email = trim($_POST['email']);
    $password_connect = trim($_POST['password_connect']);

    //TRAITEMENT DES CHAMPS VIDES
    // echo 'Traitement des champs vides <br/>';
    if (empty($email)) {
        array_push($errors, "Saisir une adresse email !");
    }
    // evitre l evoie du caractere ESPACE car le considere toujours comme un champs vide
    if (empty($password_connect)) {
        array_push($errors, "Mot de passe requis");
    }

    /******************************************
     * REQUETE RECUPERATION POUR COMPARAISON *
     ******************************************/
    // echo ' vérification des conditions <br/>';
    if (empty($errors)) {


        $reqt  = "SELECT * FROM  `users` WHERE  email = '$email' LIMIT 1";
        $reqEmail = $db_connect->prepare($reqt);
        $reqEmail->execute([$email]);
        $user = $reqEmail->fetch();

        // test
        // $user =  $reqEmail->fetch();

        // echo 'Vérification du mot de passe et de l\' email. <br/>';
        if ($user && $user['delete_account'] == 0) { // email existant
            // VERIFICATION DES CHAMPS SAISIE AVEC LES MATCH EN BDD
            // VERIFICATION DES CORRESPONDANCE DES MOTS DE PASSE (saisie à l'input et présente en bdd)
            // utilisation de la fonction password_verify qui compart le hasf password en bdd avec le mot de passe saisie à l'input lors de la connection
            // password_verify entre $password_connect et $doublonEmail['PASSWORD et non pas PASSWORD-CONNECT]. PASSWORD car cela correspond a commebnt il est nommé en bdd sur les ligne.


            $passmatch = password_verify($password_connect, $user['password']);

            if ($passmatch = false) {
                array_push($errors, "Mot de passe incorrect <br/>!");
            }

            if ($user['email'] === $email && password_verify($password_connect, $user['password'])) {

                // A CE STADE SI LE COMPTE EST TROUVER ALORS ON RECUPERE LES INFORMATIONS POUR LES STOCER EN SESSION. SERVIRA NOTAMENT POUR LE FORMULAIRE DE MODIFICATION DU COMPTE ET AUSSI POUR DEMARRER UNE SESSION UNE FOIS L UTILISATEUR CONNECTER


                /***************************************************************************************
                 * STOCKAGE DES INFORMATIONS BDD EN SESSION OU EN UTILISANT CEUX DU RESULTAT DE REQUETE *
                 *****************************************************************************************/

                // $_SESSION = array();
                // mettre les info utiles de l'utilisateur connecté dans le tableau de session
                $_SESSION['user']['pseudo'] = $user['pseudo'];
                $_SESSION['user']['role'] = $user['role'];


                if ($_SESSION['user']['role']  === 'user') {
                    header('location: ./moukatages.php');
                }
                else{
                    header('location: ./admin/dashboard.php');
                }
            } else {

                array_push($errors, " Mot de passe erroné ! <br/> Vérifier vos informations ");
            }
        } else {

            array_push($errors, " Compte inexistant... <br/> Veuillez creer un compte.");
        }
    }
}


// FONCTION MODIFIER UTILISATEUR
function updateUser()
{

    global $db_connect, $errors;

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

    if (empty($avatar)) {
        array_push($errors, "Entrer une photo de profil");
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
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        array_push($errors, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
    }

    // PARAMETRAGE DES VARIBLES D ACCES, EXTENSION, UPLOAD, ET DU DOSSIER DE DESTINATION DES IMAGES UPLOADER
    $target_dir = "../../../public/images/uploads/";  //chemin du sossier ou les fichiers seront uploader
    $target_file = $target_dir . basename($avatar); //parametrage du nom de l image

    // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
        array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
    }

    /******************************************************
     * VERIFICATION DOUBLON EMAIL METHODE PDO *
     * on ne vérifie plus le doublon d email car si on update alors que l on ne souhaote pas changer cette vaaleur ce la bloquera les modif. a defaut, le champs sera vide pour le pseudo ou l email car elle sont definit en unique dans la bdd
     *************************************************/

    if (count($errors) == 0) {

        $password_hash = password_hash($password_2, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE QUI A ETE TRAITER EN AMONT

        $user_pseudo = $_SESSION['user']['pseudo'];

        $reqt = "UPDATE  `users` SET pseudo = '$pseudo' ,first_name = '$first_name' , last_name = '$first_name' , avatar = '$avatar', email = '$email' , password = '$password_hash' WHERE pseudo = '$user_pseudo' ";

        $reqUpdate = $db_connect->prepare($reqt); //preparation de la requete

        $reqUpdate->execute(); //execution de la requete

        $_SESSION['user']['pseudo'] = $pseudo; // on réaffecte avec le nouveau pseudo

        header('location: ./profile.php');
    }
}

function deleteUser()
{

    global  $db_connect;

    // si le bouton supprimer est cliqué alors :

    // requete de suppression methode PDO
    $user_pseudo = $_SESSION['user']['pseudo'];
    $delete_account = 1;
    $reqt = "UPDATE `users` SET delete_account = '$delete_account' WHERE pseudo = '$user_pseudo' "; //supprime la ligne du compte en repérant l id en bdd en fontion de l id de session . L id de session est stocker dans la varaible $delete_id_user.
    $reqUpdate = $db_connect->prepare($reqt); //preparation de la requete
    $reqUpdate->execute(); //execution de la requete

    // On efface également les donnée en session pour evité des bug d affichage
    //si le compte disparait et que la session est tjs active ainsi on détruit aussi la session
    session_destroy();
    unset($_SESSION['user']);

    header('location: ../../index.php');
}


// FONCTION POUR RECUPERER LES INFO UTILISATEUR
function readUserById($pseudo)
{

    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/

    global $db_connect;


    $requete = "SELECT * from `users` where pseudo = '$pseudo' ";
    $stmt = $db_connect->query($requete);
    $user = $stmt->fetch();

    return $user;
}






// 888888888888888888888888888888888888888888888888888888888888888888888888888888888888888

function getAllUsers()
{
    global $all_users;
    global $db_connect;
    // $admin = "role";
    $requet = "SELECT * FROM users WHERE role= 'user'";
    $stmt = $db_connect->query($requet);
    $all_users = $stmt->fetchAll();
    return $all_users;
}
