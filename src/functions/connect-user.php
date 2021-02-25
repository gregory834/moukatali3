<!-- CONNETION USER WITH VALIDATION FORM AND SECURITY David -->
<!-- NE PAS OUBLIER DE LANCER UNE SESSION ET DE STOCKER DES INFOS EN VARIABLES DE SESSION -->
<?php

function connect_user()
{
    global $user;

    // la session user se lancera uniquement si on se connecte a votre compte
    session_start();

    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/
    require_once('bdd-connect.php');
    connectPdoBdd();

    /******************************************
     * INITIALISATION des variables *
     ******************************************/

    // NOUS SERT PAR EXEMPLE A SORTIR LES INFORMATIOSN DU TABLEAUX DES ERREURS DE LA FONCTION
    global $errors, $success_connect, $email, $password_connect, $pdo, $user;
    // INITIALISATION DES VARIABLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE DE RECUPERATION EN BASE DE DONNEE 
    $email = "";
    $password_connect = "";
    $errors = array();
    $success_connect = array();

    //TRAITEMENT DES POST
    if (isset($_POST['connection'])) {
        $email = trim($_POST['email']);
        $password_connect = trim($_POST['password-connect']);
        //TRAITEMENT DES CHAMPS VIDES
        if (empty($email)) {
            array_push($errors, "Saisir une adresse email !");
        }
        // evitre l evoie du caractere ESPACE car le considere toujours comme un champs vide
        if (empty($password_connect)) {
            array_push($errors, "Mot de passe requis");
        }


        // SI LES CHAMPS SONT REMPLIE ON VERIFIE LES INFOS SAISIE AVEC LA BDD
        /******************************************
         * REQUETE RECUPERATION POUR COMPARAISON *
         ******************************************/
        // echo ' vérification des conditions <br/>';
        if (empty($errors)) {
            echo 'Requete de recherche en bdd. <br/>';
            $pdo =  connectPdoBdd();
            $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE  email = '$email' LIMIT 1";
            $reqEmail = $pdo->prepare("SELECT * FROM `users` WHERE email='$email'");
            $reqEmail->execute();

            $user = $reqEmail->fetch();

            // test
            // $user =  $reqEmail->fetch();

            // echo 'Vérification du mot de passe et de l\' email. <br/>';
            if ($user) { // email existant
                // VERIFICATION DES CHAMPS SAISIE AVEC LES MATCH EN BDD
                // VERIFICATION DES CORRESPONDANCE DES MOTS DE PASSE (saisie à l'input et présente en bdd)
                // utilisation de la fonction password_verify qui compart le hasf password en bdd avec le mot de passe saisie à l'input lors de la connection
                // password_verify entre $password_connect et $doublonEmail['PASSWORD et non pas PASSWORD-CONNECT]. PASSWORD car cela correspond a commebnt il est nommé en bdd sur les ligne.


                $passmatch = password_verify($password_connect, $user['password']);
                var_dump($passmatch);

                if ($passmatch = false) {
                    array_push($errors, "Mot de passe incorrect <br/>!");
                }

                if ($user['email'] === $email && password_verify($password_connect, $user['password'])) {
                    // A CE STADE SI LE COMPTE EST TROUVER ALORS ON RECUPERE LES INFORMATIONS POUR LES STOCkER EN SESSION. SERVIRA NOTAMENT POUR LE FORMULAIRE DE MODIFICATION DU COMPTE ET AUSSI POUR DEMARRER UNE SESSION UNE FOIS L UTILISATEUR CONNECTER


                    /***************************************************************************************
                     * STOCKAGE DES INFORMATIONS BDD EN SESSION OU EN UTILISANT CEUX DU RESULTAT DE REQUETE *
                     *****************************************************************************************/

                    // $_SESSION = array();
                    // mettre les info utiles de l'utilisateur connecté dans le tableau de session

                    $_SESSION['user'] = $user;

                    // test des donnée stocker ici exemple un id
                    // var_dump($_SESSION['user']['id']);


                    // test des données recu de la bdd
                    // var_dump($user['pseudo']);
                    array_push($success_connect, "Connexion réussie !<br/> Cliquez sur SUIVANT ");


                    // on sort la valeur de l id de session (recuperer en bdd) pour l exploiter par la fonction read-user
                    return $_SESSION['user']['id'];
                    return $user['avatar'];
                    return $user['id'];
                    return $user['role'];

                    $id = $_SESSION['user']['id'];
                    return $id;
                    // ATTENTION !! POUR PAGE PROFIL SOIT ON REFAIT UNE REQUETE POUR AFFICHER LES INFOS SOIT ON UTILISE CEUX STOCKER EN SESSION

                } else {
                    array_push($errors, " Mot de passe erroné ! <br/> Vérifier vos informations ");
                }
            } else {
                array_push($errors, " Compte inexistant... <br/> Veuillez creer un compte.");
            }
        }
        // fin verification en bdd
    }
    global $user, $id;

    $id = $_SESSION['user']['id'];

    // fin function user
}

?>