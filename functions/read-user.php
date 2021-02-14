<!-- CETTE FONCTION NOUS SERVIRA A RECUPERER LES INFORMATIONS EN BDD D UN UTILISATEUR CONNECTER EN FONCTION DE SON ID DE SESSION QUI A ETAIT DEFINIT DANS LA FONCTIO CONNECT-USER LORS DE SA CONNECTION -->
<!-- SERVIRA EGALEMENT A FAIRE AFFICHER SES INFORMATIONS DANS SON PROFIL DIRECTEMENT DEPUIS LA BDD -->


<?php

//$id sera re affecter avec l id de session lors de l apel de la fonction en parametre genre readUser($_SESSION['user']['id]);

//TEST EN BRUT AVEC UN ID EXISTANT EN BDD ET EN GLOBAL POUR EXPLOITER L INFORMATIONS


global $id;
$id = $_SESSION['user']['id'];

function readUserById($id)
{

    /******************************************
     * CONNECTION A LA BDD (attention : on a l include qui apel la fonction de connection depuis connect-bdd.php) *
     ******************************************/

    require_once('bdd-connect.php');
    connectPdoBdd();
    echo 'Connection à la base de donnée OK <br/>';

    //faire sortir les resultat de la requete de lecture pour l exploiter sur les autres page en fonction de l id de session
    global $user, $id;

    $con = connectPdoBdd(); //RECUPERATION DE LA FONCTION DE CONNECTION A LA BDD ET STOCKE DANS LA VAR $con
    $requete = "SELECT * from `users` where id = '$id' ";
    $stmt = $con->query($requete);
    $user = $stmt->fetch();

    if (!empty($user)) {
        //test du resultat de la requete si trouver par id avec id en brut
        // var_dump($user['telephone']);
        return $user;
    } else {
        echo 'La fonction readUserById n\' as pas fonctionnée ... <br/>';
    }
    return $user;
}
// test de notre read user  fonction une fois qu elle est est creer
// readUserById($id);

?>