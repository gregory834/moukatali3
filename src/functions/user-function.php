<?php

// INITIALISATION DES VARIBLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE D INSERTION EN BASE DE DONNEE 
$pseudo = ""; //initialisation
$email = "";
$last_name = "";
$first_name = "";

$errors = array(); // VAR TABLEAUX QUI RECOIT LES MESSAGES D ERREUR POUR LE FORMULAIRE INSCRIPTION

// Si je clique sur le bouton inscription
if ( isset($_POST['register']) ) {
    registerUser();
}




// FONCTION INSCRIPTION
function registerUser() {

        global $db_connect, $errors;

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
         $target_dir = "../../public/images/uploads/";  //chemin du sossier ou les fichiers seront uploader
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
        
        $reqt  = "SELECT * FROM  `users` WHERE  email = '$email' OR pseudo = '$pseudo' LIMIT 1"; //requete de selection dans table user en fonction de l email
        $reqEmail = $db_connect->prepare($reqt); //préparation de la requete
        $reqEmail->execute([$email]);  //EXECUTION DE LA REQUETE
        $doublonEmail = $reqEmail->fetch();  //RECUPERATION RESULTAT DE LA REQUETE AUTREMENT DIT SI UN DOUBLON EST TROUVER EN FONCTION DE L EMAIL FOURNI
        // SI DOUBLON EXISTANT
        if ( $doublonEmail ) {
            array_push($errors, "Pseudo ou Email déjà existant");
        }

        if ( count($errors) == 0 ) { // Si le tableau erreurs est vide

            //ON CRYPTE LE MOT DE PASSE AVANT L ENREGISTREMENT DANS LA BASE DE DONNEES
            $password_hash = password_hash($password_2, PASSWORD_DEFAULT); //NOUVELLE VARIABLE QUI ACCUILLE LE HASH DU MOT DE PASSE SAISIE QUI A ETE TRAITER EN AMONT

            // REQUETE D INSERTION (CREATION) UTILISATEUR EN BASSE DE DONEE. 13 INFORMATIONS AU TOTAL INSERTION DANS L ODRE DE LA TABLE EN BASSE DE DONNEE
            //  ID EST AUTO INCREMENTER EN BDD

            $reqt = "INSERT INTO `users` ( pseudo, first_name, last_name, avatar, email, password, role, created_at ) VALUES ( '$pseudo','$first_name','$last_name', '$avatar', '$email', '$password_hash', '$role', now() )";

            $reqInsert = $db_connect->prepare($reqt); //preparation de la requete
            $reqInsert->execute(); //execution de la requete

            header('location: login.php');


        }



}




?>