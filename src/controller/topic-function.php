<?php
$title = "";

$image = "";

$user_id = "";
$topic_id = 0;
$published = 0;
$update_topic = false;
$success = array();
$errors = array();













// récupére tous les topics de la BDD
// L'administrateur peut afficher tous les topics
// L'auteur ne peut voir que ses topics

// function getAllTopics()
// {
//     global $db_connect, $final_topics;

//     if ($_SESSION['user']['role'] == "admin") {
//         $sql = "SELECT * FROM topics";
//     } elseif ($_SESSION['user']['role'] == "author" || $_SESSION['user']['role'] == "moderator") {
//         $user_id = $_SESSION['user']['id'];
//         return $user_id;
//         var_dump($user_id);

//         //Selectionne quel id de topic et lié a celui de l id de l utilisateur en fonction de son role
//         $sql = "SELECT * FROM topics WHERE id = $user_id";
//     }

//     $pdoStat = $db_connect->prepare($sql);
//     $result = $pdoStat->execute();
//     $topics = $db_connect->query($sql);
//     $final_topics = array();

//     foreach ($topics as $topic) {
//         $topic['author'] = getTopicAuthorById($topic['id']);
//         array_push($final_topics, $topic);
//     }
//     return $final_topics;
// }

// récupére l'auteur d'un topic
function getTopicAuthorById($user_id)
{
    global $db_connect;

    $sql = "SELECT nom FROM users WHERE id = $user_id";
    $result = $db_connect->query($sql);
    if ($result) {
        // retourner le nom d'utilisateur
        return ($result);
    } else {
        return null;
    }
}
// si l'utilisateur clique sur le bouton créer une publication
if (isset($_POST['create-topic'])) {
    createTopic($_POST);
}
// si l'utilisateur clique sur l'icône modifier
if (isset($_GET['edit-topic'])) {
    $update_topic = true;
    $topic_id = $_GET['edit-topic'];
    editTopic($topic_id);
}
// si l'utilisateur clique sur le bouton mettre à jour
if (isset($_POST['update-topic'])) {
    updateTopic($_POST);
}
// si l'utilisateur clique sur le bouton Supprimer la publication
if (isset($_GET['delete-topic'])) {
    $topic_id = $_GET['delete-topic'];
    deleteTopic($topic_id);
}
global $db_connect, $errors, $user_id;
// 88888888888888888888888888888888888888
// $user_id est définit a ce stade
var_dump($user_id);

function createTopic($request_values)
{

    global $db_connect, $errors, $success, $image, $user;

    if (isset($_POST["create-topic"])) {

        
        $image = strtolower(time() . '-' . $_FILES['image']['name']);
        $title = htmlentities(trim($_POST['title']));
        $published = 0; //par defaut le sujet n est pas actif
        global $db_connect, $errors, $success;
        

        $user_id = $user['id'];

        // var_dump($user_id);

        // 88888888888888888888888888888888888888888888888888888888888888
        // validation formulaire
        if (empty($title)) {
            array_push($errors, "Entrer un titre");
            return $errors;
            die;
        }
 
        if (empty($image)) {
            array_push($errors, "Entrer une photo de profil");
            return $errors;
            $uploadOk = 0;
            die;
        }

        // VERIFICATION DE LA TAILLE DE L IMAGE
        if ($_FILES["image"]["size"] > 600000) {
            array_push($errors, "Image volumineuse ! Elle ne peut dépasser 600ko .");
        }

        $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION)); //définition de l extension de l image
        // VERIFICATION DES EXTENSIONS
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            array_push($errors, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
        }

        // PARAMETRAGE DES VARIBLES D ACCES, EXTENSION, UPLOAD, ET DU DOSSIER DE DESTINATION DES IMAGES UPLOADER
        $target_dir = "../../../public/images/uploads/";  //chemin du sossier ou les fichiers seront uploader
        $target_file = $target_dir . basename($image); //parametrage du nom de l image

        // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
        }
    }
    // return $errors;
    // créer si aucune erreur
    if (count($errors) == 0) {
        // 8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
        // GOOD
        array_push($success, "Edition du sujet réussie !<br/>  ");
        $sql = "INSERT INTO topics (  title, image, quota_vote, published, created_at) VALUES(  '$title', '$image', 0, '$published', now())";
        $reqInsert = $db_connect->prepare($sql); //preparation de la requete
        $reqInsert->execute(); //execution de la requete
        return $errors;
        return $success;
        exit(0);
    }
}
/* * * * * * * * * * * * * * * * * * * * *
* - Prend l'identifiant de publication comme paramètre
* - Récupère le message de la base de données
* - définit les champs de publication sur le formulaire pour modification
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id)
{
    global $db_connect, $title, $update_topic, $topic_id;
    $sql = "SELECT * FROM topics WHERE id = $topic_id LIMIT 1";

    $pdoStat = $db_connect->prepare($sql);
    $executeIsOk = $pdoStat->execute();
    $topic = $pdoStat->fetch();
    // $result = mysqli_query($db, $sql);
    // $topic = mysqli_fetch_assoc($result);
    // définir les valeurs du formulaire sur le formulaire à mettre à jour
    $title = $topic['title'];

}
// 8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
function updateTopic($request_values)
{
    $published = 0; //par defaut le sujet n est pas actif
  
    // var_dump($user_id);
    global $db_connect, $errors, $title, $image, $topic_id, $success;
    $image = strtolower(time() . '-' . $_FILES['image']['name']);
    $topic_id = $_POST['topic-id'];
    $title = trim($request_values['title']);
    // validation formulaire
    if (empty($title)) {
        array_push($errors, "Entrer un titre");
        return $errors;
        die;
    }


    // VERIFICATION DE LA TAILLE DE L IMAGE
    if ($_FILES["image"]["size"] > 600000) {
        array_push($errors, "Image volumineuse ! Elle ne peut dépasser 600ko .");
    }

    $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION)); //définition de l extension de l image
    // VERIFICATION DES EXTENSIONS
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        array_push($errors, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
    }

    // PARAMETRAGE DES VARIBLES D ACCES, EXTENSION, UPLOAD, ET DU DOSSIER DE DESTINATION DES IMAGES UPLOADER
    $target_dir = "../../../public/images/uploads/";  //chemin du sossier ou les fichiers seront uploader
    $target_file = $target_dir . basename($image); //parametrage du nom de l image

    // VERIFICATION SI UNE ERREUR IMAGE EST SURVENUE
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        array_push($errors, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
    }

    // enregistrer le sujet s'il n'y a pas d'erreurs dans le formulaire
    if (count($errors) == 0) {
        array_push($success, "Modification du topics réussie ! ");
        $query = "UPDATE topics SET title = '$title',image='$image'  WHERE id = $topic_id";
        $reqInsert = $db_connect->prepare($query); //preparation de la requete
        $reqInsert->execute(); //execution de la requete
        return $errors;
        return $success;
        exit(0);
    }
}



// supprimer un topic 
function deleteTopic($topic_id)
{
    global $db_connect, $success;
    $sql1 = "DELETE FROM topics WHERE id = $topic_id";
    $reqDeleteAdmin = $db_connect->prepare($sql1); //preparation de la requete
    $reqDeleteAdmin->execute(); //execution de la requete
    array_push($success, "Topic supprimé avec succès");
}



// si l'utilisateur clique sur le bouton de publication de l'article
if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
    $message = "";
    if (isset($_GET['publish'])) {
        $message = "Sujet publié";
        $topic_id = $_GET['publish'];
    } else if (isset($_GET['unpublish'])) {
        $message = "Le sujet n'est pas publié";
        $topic_id = $_GET['unpublish'];
    }
    togglePublishTopic($topic_id, $message);
}


// activer - desactiver un topics
function togglePublishTopic($topic_id, $message)
{
    global $db_connect;
    $sql = "UPDATE topics SET published = !published WHERE id = $topic_id";
    $pdoStat = $db_connect->prepare($sql);
    $result = $pdoStat->execute();
    $topics = $db_connect->query($sql);
    // $final_topics = array();
}


// changement d etat de la publication

if (isset($_GET)) {
    global $topic_id;
    if (isset($_GET['publish'])) {
        $topic_id = $_GET['publish'];
        $query = "UPDATE topics SET published = 0 WHERE published = 1 AND id = $topic_id LIMIT 1";
        $pdoStat1 = $db_connect->prepare($query);
        $execut1 = $pdoStat1->execute();
        // CHANGE L ETAT DES AUTRE PUBLICATION 5CAR LIMITER A 2 sur 3 par admin
        $sql = "UPDATE topics SET published = 1 WHERE id != $topic_id";
        $pdoStat2 = $db_connect->prepare($sql);
        $execut2 = $pdoStat2->execute();
    } else {
        if (isset($_GET['unpublish'])) {
            $topic_id = $_GET['unpublish'];
            $query = "UPDATE topics SET published = 1 WHERE published = 0 AND id = $topic_id LIMIT 1";
            $pdoStat1 = $db_connect->prepare($query);
            $execut1 = $pdoStat1->execute();
            // CHANGE L ETAT DES AUTRE PUBLICATION 5CAR LIMITER A 2 sur 3 par admin
            $sql = "UPDATE topics SET published = 0 WHERE id != $topic_id";
            $pdoStat2 = $db_connect->prepare($sql);
            $execut2 = $pdoStat2->execute();
        }
    }
    return $topic_id;
}





function readAllTopics(){
   global $db_connect, $topics;
   $sql = "SELECT * FROM topics ORDER BY created_at DESC ";
   $pdoStat = $db_connect->prepare($sql);
   $executeIsOk = $pdoStat->execute();
   // $listes_AllTpics = $pdoStat->fetchAll();
   $topics = $pdoStat->fetchAll();
   return $topics;

//    var_dump($topics);
// 88888888888888888888888888888888888888888888888888888888888888888888
}



   

