<?php

if ( isset ($_SESSION['user']) ) {
    $user_id = $_SESSION['user']['id'];
// si l'utilisateur clique sur le bouton J'aime ou Je n'aime pas
    if ( isset($_POST['action']) ) {
        $moukatage_id = $_POST['moukatage_id'];
        $action = $_POST['action'];
        switch ($action) {
            case 'like':
                $sql = "INSERT INTO likes (user_id, moukatage_id, action)
                        VALUES ('$user_id', '$moukatage_id', 'like')
                        ON DUPLICATE KEY UPDATE action='like'";
                break;
            case 'dislike':
                $sql = "INSERT INTO likes (user_id, moukatage_id, action)
                        VALUES ('$user_id', '$moukatage_id', 'dislike')
                        ON DUPLICATE KEY UPDATE action = 'dislike'";
                break;
            case 'unlike':
                $sql = "DELETE FROM likes WHERE user_id = '$user_id' AND moukatage_id = '$moukatage_id'";
                break;
            case 'undislike':
                $sql = "DELETE FROM likes WHERE user_id = '$user_id' AND moukatage_id = '$moukatage_id'";
                break;
            default:
                break;
        }

        // exécuter une requête pour effectuer des modifications dans la base de données ...
        $query = $db_connect->query($sql);
        echo getRatings($moukatage_id);
        exit(0);
    }
}

// Obtenez le nombre total de likes pour un article en particulier
function getLikes($moukatage_id) {
    global $db_connect;
    $sql = "SELECT COUNT(*) FROM likes WHERE moukatage_id = $moukatage_id AND action = 'like'";
    $query = $db_connect->query($sql);
    $result = $query->fetch_array();
    
    return intval($result[0]);
}

// Obtenir le nombre total de dislikes pour un message particulier
function getDislikes($moukatage_id) {
    global $db_connect;
    $sql = "SELECT COUNT(*) FROM likes WHERE moukatage_id = $moukatage_id AND action = 'dislike'";
    $query = $db_connect->query($sql);
    $result = $query->fetch_array();

    return intval($result[0]);
}

// Obtenez le nombre total de mentions J'aime et Je n'aime pas pour un article en particulier
function getRatings($moukatage_id) {
    global $db_connect, $moukatage_id;

    $rating = array();

    $likes_query = "SELECT COUNT(*) FROM likes WHERE moukatage_id = $moukatage_id AND action = 'like'";
    $dislikes_query = "SELECT COUNT(*) FROM likes WHERE moukatage_id = $moukatage_id AND action = 'dislike'";

    $likes_rs = $db_connect->query($likes_query);
    $dislikes_rs = $db_connect->query($dislikes_query);

    $likes = $likes_rs->fetch_array();
    $dislikes = $dislikes_rs->fetch_array();
    
    $total_likes = intval($likes[0]);
    $total_dislikes = intval($dislikes[0]);

    $sql = "UPDATE moukatages SET likes = '$total_likes', dislikes = '$total_dislikes' WHERE id = '$moukatage_id'";
    $query = $db_connect->query($sql);
    //printf("Message d'erreur : %s\n", $db_connect->error);
    
    $rating = [
        "likes" => $total_likes,
        "dislikes" => $total_dislikes
    ];
    //var_dump($rating);
    return json_encode($rating);

}

// Vérifiez si l'utilisateur aime déjà le message ou non
function userLiked($moukatage_id) {
    global $db_connect, $user_id;

    if ( isset($_SESSION['user']) ) {
        $sql = "SELECT * FROM likes WHERE user_id = $user_id AND moukatage_id = $moukatage_id AND action = 'like'";
        $result = $db_connect->query($sql);
        $rows = $result->num_rows;
        if ( $rows > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// Vérifiez si l'utilisateur n'aime pas déjà le message ou non
function userDisliked($moukatage_id) {
    global $db_connect, $user_id;

    if ( isset($_SESSION['user']) ) {
        $sql = "SELECT * FROM likes WHERE user_id = $user_id AND moukatage_id = $moukatage_id AND action = 'dislike'";
        $result = $db_connect->query($sql);
        $rows = $result->num_rows;
        if ( $rows > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
/*
$sql = "SELECT * FROM posts";
$result = mysqli_query($db_connect, $sql);
// récupérer tous les messages de la base de données
// les renvoyer sous forme de tableau associatif appelé $posts
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
*/


?>