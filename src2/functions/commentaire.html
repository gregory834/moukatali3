<?php


if (isset($_POST['posted'])) { // Si une valeur est ajouté dans le champ 'posted', on démarre la function 'publier'.

    publier(); //Création de la function publier.
}



//FONCTION PUBLIER.

function publier()
{
    $commentaire = $_POST['posted-comment']; // Déclaration de la variable '$commentaire' qui récupère la donnée entrer dans l'input 'posted-coment'.
    $user_id = $_SESSION['user']['user_id'];
    $topic_id = 1;


    if (empty($commentaire)) {  //Si la variable est 'vide = empty' alors il affichera le message "Remplir le champ".
        echo 'Remplir le champ !';
    }

    # Procédural

    //Connexion à la base de donnée.
    $link = mysqli_connect("localhost", "root", "", "moukatali"); //Vérifie la localisation, le mot de passe, et le nom de la base de donnée.
    /* Vérification de la connexion */
    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }


    /***  Préparation de la commande d'insertion  ***/
    $requete = "INSERT INTO comments (post, vote_for, vote_against, publication_date, user_id, topic_id)

                VALUES ('$commentaire',0,0,now(),$user_id, $topic_id)"; //Déclaration de la variable requête.
    // Afin d'inserer des valeurs dans les colonnes de la table 'comments'.

    mysqli_query($link, $requete); //recupère les données et les met dans la variable $stmt.
    //Fonction qui éxécute une requête sur la Base de donnée.

    if (mysqli_query($link, $requete)) {
        echo 'OK'; //Condition disant que si la fonction est éxécuté, on affichera 'OK', sinon 'Il y a une erreur'.
    } else {
        echo "Il y a une erreur";
    }
}


/*** FONCTION AFFICHER COMMENTAIRE ***/



function afficher()
{

    //Connexion à la base de donnée.
    $link = mysqli_connect("localhost", "root", "", "moukatali"); //Dabord  je me connecte à la base de donnée en vérifiant la localisation, le Mot de passe et le nom de la base de donnée.
    /* Vérification de la connexion */
    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }




    //Select la table 'Comments'.

    // $requete = "SELECT * FROM `comments`"; // Nouvelle requête qui permet de séléectionné la table 'comments'.
    $result = mysqli_query($link, $requete); //Variable qui à la fonction qui permet d'éxécuter la requête.



    // Mettre les résultats dans un tableau, créer un tableau.
    $tableau = mysqli_fetch_all($result, MYSQLI_ASSOC); // La fonction "mysql_fetch_assoc" lit une ligne de résultat MySQL dans un tableau associatif.



    //Foreach est une façon de parcourir les tableaux et les objets.
    foreach ($tableau as $key => $value) {

?>
        <!-- COMMENTAIRES -->
        <!-- #01 -->
        <div class="comment-box text-dark mb-3">

            <div class="d-flex justify-content-between">
                <p class="d-flex align-items-center"><span class="badge me-1">#10</span><?php echo $value['user_id'] ?></p>
                <p><?php echo $value['publication_date'] ?></p>
            </div>

            <div>
                <p><?php echo $value['post'] ?></p>
            </div>

            <div class="vote d-flex">

                <div class="vote-for me-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up">
                        <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                        </path>
                    </svg>
                    <span class="badge rounded-pill bg-dark text-white">10</span>
                </div>

                <div class="vote-against">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-down">
                        <path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17">
                        </path>
                    </svg>
                    <span class="badge rounded-pill bg-dark text-light">5</span>
                </div>

            </div>

        </div>
<?php

    }
}




/*************************************************** ***************************************************** */

//Ici j'éxécute la requête

// $db->exec($requete);



// ancien code à insérer dans le nouveau

// $commentaire = $_POST['commentaire']; //Déclaration de la variable $commentaire qui récupère la donnée entrer dans le champ

// $requete = "INSERT INTO `comment` (post, vote_for, vote_against)
//   VALUES ('$commentaire',0,0)";


// use exec()

// $pdo->exec($requete); //$pdo=bdd, exécute la $requete = requete
