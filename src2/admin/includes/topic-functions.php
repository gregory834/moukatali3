<?php

$title = "";
$topic_description = "";
$picture = "";
$topic_id = 0;
$published = 0;
$update_topic= false;

// récupére tous les topics de la BDD
function getAllTopics() {

	global $db;

	// L'administrateur peut afficher tous les topics
	// L'auteur ne peut voir que ses topics
	if ($_SESSION['user']['role'] == "admin") {
		$sql = "SELECT * FROM topics";
	} elseif ($_SESSION['user']['role'] == "author" || $_SESSION['user']['role'] == "moderator") {
		$user_id = $_SESSION['user']['user_id'];
		$sql = "SELECT * FROM topics WHERE user_id = $user_id";
	}
	$result = mysqli_query($db, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_topics = array();
	foreach ($topics as $topic) {
		$topic['author'] = getTopicAuthorById($topic['user_id']);
		array_push($final_topics, $topic);
	}
	return $final_topics;
}

// récupére l'auteur d'un topic
function getTopicAuthorById($user_id) {

    global $db;
    
	$sql = "SELECT username FROM users WHERE id = $user_id";
	$result = mysqli_query($db, $sql);
	if ($result) {
		// retourner le nom d'utilisateur
		return mysqli_fetch_assoc($result)['username'];
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

// si l'utilisateur clique sur le bouton de mise à jour
if (isset($_POST['update-topic'])) {
	updateTopic($_POST);
}

// si l'utilisateur clique sur le bouton Supprimer la publication
if (isset($_GET['delete-topic'])) {
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
}



function createTopic($request_values) {

    global $db, $errors;

    $user_id = $_SESSION['user']['user_id'];
    $picture = strtolower(time() . '-' . $_FILES['picture']['name']);
    $title = htmlentities(trim($request_values['title']));
    $topic_description = htmlentities(trim($request_values['topic-description']));
    
    // validation formulaire
    if (empty($title)) {
        array_push($errors, "Entrer un titre");
    }
    if (empty($topic_description)) {
        array_push($errors, "Entrer une description");
    }
    
    // validation image
    if (empty($picture)) {
        array_push($errors, "Veuillez uploader une image");
    }
    // valider la taille de l'image, la taille est calculée en octet
    if($_FILES['picture']['size'] > 200000) {
        array_push($errors, "La taille de l'image ne doit pas dépasser 200 ko");
    }
    // On vérifie l'extension et la taille de l'image
    $picture_ext = pathinfo($picture, PATHINFO_EXTENSION); // ou $picture_ext = pathinfo($picture)['extension'];
    if (!in_array($picture_ext, ['jpg', 'jpeg', 'png'])) {
        array_push($errors, "Votre image doit être .jpg, .jpeg ou .png");
    }
    // image file directory
    $target_dir = ROOT_PATH . '/public/images/upload/' . basename($picture);

    if (!move_uploaded_file($_FILES['picture']['tmp_name'], $target_dir)) {
        array_push($errors, "Échec du téléchargement de l'image.");
    }

    // créer si aucune erreur
    if (count($errors) == 0) {

        $query = "INSERT INTO topics (user_id, picture, title, topic_description, nb_comment, vote_for, vote_against, published, creation_date, update_date) VALUES($user_id, '$picture', '$title', '$topic_description', 0, 0, 0, 0, now(), now())";

        if(mysqli_query($db, $query)){ // si le sujet a été insérer avec succès
            
            $_SESSION['message'] = "Sujet créé avec succés";
            echo "Sujet créé avec succés";
            header('location: subject.php');
            exit(0);
        }
    }
}

/* * * * * * * * * * * * * * * * * * * * *
* - Prend l'identifiant de publication comme paramètre
* - Récupère le message de la base de données
* - définit les champs de publication sur le formulaire pour modification
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id) {
    global $db, $title, $topic_description, $update_topic, $topic_id;
    $sql = "SELECT * FROM topics WHERE id = $topic_id LIMIT 1";
    $result = mysqli_query($db, $sql);
    $topic = mysqli_fetch_assoc($result);
    // définir les valeurs du formulaire sur le formulaire à mettre à jour
    $title = $topic['title'];
    $topic_description = $topic['topic_description'];
}

function updateTopic($request_values) {
    global $db, $errors, $title, $picture, $topic_id, $topic_description;

    $topic_id = $_POST['topic-id'];
    $title = trim($request_values['title']);
    $topic_description = htmlentities(trim($request_values['topic-description']));
    

    // validation formulaire
    if (empty($title)) {
        array_push($errors, "Entrer un titre");
    }
    if (empty($topic_description)) {
        array_push($errors, "Entrer une description");
    }

    // si une nouvelle image vedette a été fournie
    if (isset($_POST['picture'])) {
        $picture = strtolower(time() . '-' . $_FILES['picture']['name']);
        // pour le téléchargement de l'images
        $target_dir = ROOT_PATH . '/public/images/upload/' . basename($picture);
        // VALIDATION
        // valider la taille de l'image, la taille est calculée en octet
        if($_FILES['picture']['size'] > 200000) {
            array_push($errors, "La taille de l'image ne doit pas dépasser 200 ko");
        }
        // On vérifie l'extension et la taille de l'image
        $picture_ext = pathinfo($picture, PATHINFO_EXTENSION); // ou $picture_ext = pathinfo($picture)['extension'];
        if (!in_array($picture_ext, ['jpg', 'jpeg', 'png'])) {
            array_push($errors, "Votre image doit être .jpg, .jpeg ou .png");
        }
        if (empty($errors)) {
          if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir)) {
            $results = mysqli_query($db, "SELECT * FROM topics WHERE id = $topic_id");
            $topics = mysqli_fetch_all($results, MYSQLI_ASSOC);
            /*
            $file = ROOT_PATH . '/public/images/upload/' . $topics[0]['picture'];
            $del_file = fopen($file);
            fclose($del_file);
            *//*
            if (file_exists($file)) {
              unlink($file);
            }*/
            
            $query = "UPDATE topics SET picture = '$picture' WHERE id = $topic_id";
            mysqli_query($db, $query);
          } else {
            array_push($errors, "Une erreur s'est produite lors du téléchargement du fichier");
          }
        }
    }

    // enregistrer le sujet s'il n'y a pas d'erreurs dans le formulaire
    if (count($errors) == 0) {
        $query = "UPDATE topics SET title = '$title', topic_description = '$topic_description', update_date = now()  WHERE id = $topic_id";
        
        if(mysqli_query($db, $query)) {
            $_SESSION['message'] = "le sujet a été mis à jour.";
            header('location: subject.php');
            exit(0);
        } else {
            echo 'ERREUR BDD';
        }
    }
}

// supprimer topic
function deleteTopic($topic_id) {
    global $db;
    $sql = "DELETE FROM topics WHERE id = $topic_id";
    if (mysqli_query($db, $sql)) {
        $_SESSION['message'] = "Le sujet a bien été supprimé";
        header("location: subject.php");
        exit(0);
    }
}
/*
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
// activer - desactiver
function togglePublishTopic($topic_id, $message)
{
	global $db;
	$sql = "UPDATE topics SET published = !published WHERE id = $topic_id";

	if (mysqli_query($db, $sql)) {
		$_SESSION['message'] = $message;
		header("location: topics.php");
		exit(0);
	}
}
*/
if (isset($_GET)) {
    if (isset($_GET['publish'])) {
        $topic_id = $_GET['publish'];
        $query = "UPDATE topics SET published = 0 WHERE published = 1";
        mysqli_query($db, $query);
        $sql = "UPDATE topics SET published = 1 WHERE id = $topic_id";
        mysqli_query($db, $sql);
    }
    if (isset($_GET['unpublish'])) {
        $topic_id = $_GET['unpublish'];
        $query = "UPDATE topics SET published = 1 WHERE published = 0";
        mysqli_query($db, $query);
        $sql = "UPDATE topics SET published = 0 WHERE id = $topic_id";
        mysqli_query($db, $sql);
    }
}

?>