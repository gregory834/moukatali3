<!-- CONNETION USER WITH VALIDATION FORM AND SECURITY David -->
<?php

global $user;
function connect_user()
{
    session_start();

    // echo 'début de la function de connection <br/>';
    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/
    require_once('bdd-connect.php');
    connectPdoBdd();
    // echo 'Connection à la base de donnée OK <br/>';
    /******************************************
     * INITIALISATION des variables *
     ******************************************/
    // echo ' Entrer de fonction connect-user <br/>';
    // echo ' Inititialisation varibles GLOBAL  <br/>Initialisation  du tableaux des erreurs (IN FONCTIONS)  <br/>';
    // NOUS SERT PAR EXEMPLE A SORTIR LES INFORMATIOSN DU TABLEAUX DES ERREURS DE LA FONCTION
    global $errors, $success_connect, $email, $password_connect, $pdo, $user;
    // INITIALISATION DES VARIABLES DONT CEUX PAR DEFAUT AFIN DE LES TRAITER AVANT REQUETE DE RECUPERATION EN BASE DE DONNEE 
    $email = "";
    $password_connect = "";
    $errors = array();
    $success_connect = array();

    //TRAITEMENT DES POST
    // echo 'Traitement des champs saisie <br/>';
    if (isset($_POST['connection'])) {
        $email = trim($_POST['email']);
        $password_connect = trim($_POST['password-connect']);
        //TRAITEMENT DES CHAMPS VIDES
        // echo 'Traitement des champs vides <br/>';
        if (empty($email)) {
            array_push($errors, "Saisir une adresse email !");
        }
        // evitre l evoie du caractere ESPACE car le considere toujours comme un champs vide
        if (empty($password_connect)) {
            array_push($errors, "Mot de passe requis");
        }
        // SI LES CHAMPS SONT REMPLIE ON VERIFIE LES INFOS SAISIE AVEC LA BDD
        // var_dump($errors);
        /******************************************
         * REQUETE RECUPERATION POUR COMPARAISON *
         ******************************************/
        // echo ' vérification des conditions <br/>';
        if (empty($errors)) {
            echo 'Requete de recherche en bdd. <br/>';
            $pdo =  connectPdoBdd();
            $reqt  = "SELECT COUNT(*) AS nbr FROM  `users` WHERE  email = '$email' LIMIT 1";
            $reqEmail = $pdo->prepare("SELECT * FROM `users` WHERE email='$email'");
            $reqEmail->execute([$email]);
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
                    // echo 'compte trouvé en bdd ok <br/>';
                    // A CE STADE SI LE COMPTE EST TROUVER ALORS ON RECUPERE LES INFORMATIONS POUR LES STOCER EN SESSION. SERVIRA NOTAMENT POUR LE FORMULAIRE DE MODIFICATION DU COMPTE ET AUSSI POUR DEMARRER UNE SESSION UNE FOIS L UTILISATEUR CONNECTER


                    /***************************************************************************************
                     * STOCKAGE DES INFORMATIONS BDD EN SESSION OU EN UTILISANT CEUX DU RESULTAT DE REQUETE *
                     *****************************************************************************************/

                    // $_SESSION = array();
                    // mettre les info utiles de l'utilisateur connecté dans le tableau de session
                    $_SESSION['user'] = ($user);
                    // echo 'stockage en session par ID user';
                    // echo 'Résultat de la requete qui possede aussi les infos stocké dans $user donc exploitable <br/>Mais necessite de redéclarer les requetes sur d autre pages';

                    // test des donnée stocker ici exemple un id
                    // var_dump($_SESSION['user']['id']);


            
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

    // echo 'test';

    $id = $_SESSION['user']['id'];

    // var_dump($_SESSION['user']['id']);
    // var_dump($_SESSION['user']['id']);

    // NE PAS EFFACER SERVIRA PEU ETRE PLUS TARD
    // Obtenir des informations sur l'utilisateur à partir de l'identifiant de l'utilisateur
    // function getUserById($id)
    // {
    //     global $db;
    //     $sql = "SELECT * FROM user_info WHERE user_id = $id LIMIT 1";

    //     $result = mysqli_query($db, $sql);
    //     $user_info = mysqli_fetch_assoc($result);

    //     //renvoie les info utilisateur dans un format de tableau:
    //     // ['id' => 1, 'username' => 'Pseudo', 'email'=>'a@a.com', 'password'=> 'mot de passe']
    //     return $user_info;
    // }


























    // fin function user
}

?>