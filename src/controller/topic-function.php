<?php

$title = "";
$image = "";
$user_id = "";
$topic_id = 0;
$published = 0;
$update_topic = false;
$success = array();
$errors_topic = array();

if (isset($_POST['create-topic'])) {
    createTopic($_POST);
}

if (isset($_GET['edit-topic'])) {
    $update_topic = true;
    $topic_id = $_GET['edit-topic'];
    editTopic($topic_id);
}

if (isset($_POST['update-topic'])) {
    updateTopic($_POST);
}

if (isset($_GET['delete-topic'])) {
    $topic_id = $_GET['delete-topic'];
    deleteTopic($topic_id);
}

function createTopic() {

    global $db_connect, $errors_topic, $success;

    if (isset($_POST["create-topic"])) {

        
        $image = strtolower(time() . '-' . $_FILES['image']['name']);
        $title = htmlentities(trim($_POST['title']));

        if (empty($title)) {
            array_push($errors_topic, "Entrer un titre");
        }
 
        if (empty($image)) {
            array_push($errors_topic, "Télécharger une image");
        }

        if ($_FILES["image"]["size"] > 600000) {
            array_push($errors_topic, "Image volumineuse ! Elle ne peut dépasser 600ko .");
        }

        $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            array_push($errors_topic, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
        }

        
        $target_dir = ROOT_PATH . "/public/images/uploads/topics/";
        $target_file = $target_dir . basename($image);
       
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            array_push($errors_topic, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
        }
    }
   
    if (count($errors_topic) == 0) {
        
        $sql = "INSERT INTO topics ( title, image, created_at ) VALUES ( '$title', '$image', now() )";
        $reqInsert = $db_connect->query($sql);
        array_push($success, "Topic créé avec succés");
        
    }
}


function editTopic($topic_id)
{
    global $db_connect, $title, $update_topic, $topic_id;

    $sql = "SELECT * FROM topics WHERE id = $topic_id LIMIT 1";

    $res = $db_connect->query($sql);
    $topic = $res->fetch_array();

    $title = $topic['title'];

}
function updateTopic($request_values)
{
    global $db_connect, $errors_topic, $title, $image, $topic_id, $success;

    $image = strtolower(time() . '-' . $_FILES['image']['name']);
    $topic_id = $_POST['topic-id'];
    $title = trim($request_values['title']);
    
    if (empty($title)) {
        array_push($errors_topic, "Entrer un titre");
        return $errors_topic;
    }

    if ($_FILES["image"]["size"] > 600000) {
        array_push($errors_topic, "Image volumineuse ! Elle ne peut dépasser 600ko .");
    }

    $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        array_push($errors_topic, "Format d'image non accepté ! Requis : png, jpeg, jpg ou png");
    }

    $target_dir = ROOT_PATH . "/public/images/uploads/topics/";
    $target_file = $target_dir . basename($image);

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        array_push($errors_topic, "Désolé, une erreur est survenue lors du transfert ... Veuillez recommençer.");
    }

    $sql = "SELECT * FROM topics WHERE id= '$topic_id' LIMIT 1";
    $query = $db_connect->query($sql);
    $row = $query->fetch_array(MYSQLI_ASSOC);
    $old_image = $row['image'];
    $file = ROOT_PATH . '/public/images/uploads/topics/' . $old_image;
    if ( file_exists($file) ) {
        unlink($file);
    }

    if (count($errors_topic) == 0) {
        
        $sql = "UPDATE topics SET title = '$title', image='$image', updated_at = now() WHERE id = $topic_id";
        $res = $db_connect->query($sql);
        array_push($success, "Modification du topics réussie ! ");
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
    
    if (isset($_GET['publish'])) {
        array_push($success, "Topic retiré ! ");
        $topic_id = $_GET['publish'];
    } else if (isset($_GET['unpublish'])) {
        array_push($success, "Topic publié ");
        $sql = "SELECT * FROM topics WHERE published = 1 ORDER BY created_at ASC";
        $res = $db_connect->query($sql);
        $topics_order = $res->fetch_all(MYSQLI_ASSOC);
        $rows = $res->num_rows;
        if ( $rows > 2 ) {
            $topic_id = $topics_order[0]['id'];
        } else {
            $topic_id = $_GET['unpublish'];
        }
        
    }
    togglePublishTopic($topic_id);
}


// activer - desactiver un topics
function togglePublishTopic($topic_id)
{
    global $db_connect;
    $sql = "UPDATE topics SET published = !published WHERE id = $topic_id";
    $query = $db_connect->query($sql);
    
}


// changement d etat de la publication

if (isset($_GET)) {
    
    if (isset($_GET['publish'])) {
        $topic_id = $_GET['publish'];
        $query = "UPDATE topics SET published = 0 WHERE published = 1 AND id = $topic_id LIMIT 1";
        $res = $db_connect->query($query);
        
    } else {
        if (isset($_GET['unpublish'])) {
            $topic_id = $_GET['unpublish'];
            $query = "UPDATE topics SET published = 1 WHERE published = 0 AND id = $topic_id LIMIT 1";
            $res = $db_connect->query($query);
            
        }
    }
    return $topic_id;
}





function readAllTopics(){
   global $db_connect, $topics;
   $sql = "SELECT * FROM topics ORDER BY created_at DESC ";
   $res = $db_connect->query($sql);
   // $listes_AllTpics = $pdoStat->fetchAll();
   $topics = $res->fetch_all(MYSQLI_ASSOC);
   return $topics;
}


function publishTopic() {
    global $db_connect;
    $sql = "SELECT * FROM topics WHERE published = 1 ORDER BY created_at DESC";
    $res = $db_connect->query($sql);
    $publish_topics = $res->fetch_all(MYSQLI_ASSOC);
    return $publish_topics;
}

function allPostByTopic($main_topic) {
    global $db_connect;

    $sql = "SELECT * FROM moukatages WHERE topic_id = '$main_topic' ORDER BY created_at DESC";
    $query = $db_connect->query($sql);
    $moukatages = $query->fetch_all(MYSQLI_ASSOC);
    return $moukatages;

}
