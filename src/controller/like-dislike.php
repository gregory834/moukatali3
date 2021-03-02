<?php

// si l'utilisateur clique sur le bouton J'aime ou Je n'aime pas
if ( isset($_POST['action']) ) {
    $moukatage_id = $_POST['moukatage_id'];
    $action = $_POST['action'];
    switch ($action) {
        case 'like':
            $sql = "INSERT INTO likes (user_id, moukatage_id, action)
                    VALUES ($user_id, $moukatage_id, 'like')
                    ON DUPLICATE KEY UPDATE action = 1";
            break;
        case 'dislike':
            $sql = "INSERT INTO likes (user_id, moukatage_id, action)
                    VALUES ($user_id, $moukatage_id, 'dislike')
                    ON DUPLICATE KEY UPDATE action = 0'";
            break;
        case 'unlike':
            $sql = "DELETE FROM likes WHERE user_id = $user_id AND moukatage_id = $moukatage_id";
            break;
        case 'undislike':
            $sql = "DELETE FROM likes WHERE user_id = $user_id AND moukatage_id = $moukatage_id";
            break;
        default:
            break;
    }

    // exécuter une requête pour effectuer des modifications dans la base de données ...
    mysqli_query($db_connect, $sql);
    echo getRatings($moukatage_id);
    exit(0);
}

// Obtenez le nombre total de likes pour un article en particulier
function getLikes($moukatage_id) {
    global $db_connect;
    $sql = "SELECT COUNT(*) FROM moukatali.likes WHERE moukatage_id = $moukatage_id AND action = 1";
    $req = $db_connect->query( $sql );
    $getLikes = $req->fetch();
    return $getLikes[0];
}

// Obtenir le nombre total de dislikes pour un message particulier
function getDislikes($moukatage_id) {
    global $db_connect;
    $sql = "SELECT COUNT(*) FROM moukatali.likes WHERE moukatage_id = $moukatage_id AND action = 0";
    $req = $db_connect->query( $sql );
    $getDislikes = $req->fetch();
    return $getDislikes[0];
}

// Obtenez le nombre total de mentions J'aime et Je n'aime pas pour un article en particulier
function getRatings($moukatage_id) {
    global $db_connect;

    $rating = array();

    $likes_query = "SELECT COUNT(*) FROM likes WHERE moukatage_id = $id AND action = 1";
    $dislikes_query = "SELECT COUNT(*) FROM likes WHERE moukatage_id = $id AND action = 0";

    $likes_rs = mysqli_query($db_connect, $likes_query);
    $dislikes_rs = mysqli_query($db_connect, $dislikes_query);

    $likes = mysqli_fetch_array($likes_rs);
    $dislikes = mysqli_fetch_array($dislikes_rs);

    $rating = [
        'likes' => $likes[0],
        'dislikes' => $dislikes[0]
    ];
    return json_encode($rating);

}

// Vérifiez si l'utilisateur aime déjà le message ou non
function userLiked($moukatage_id) {
    global $db_connect;
    $user_id = 2;
    $moukatage_id = 2;

    $sql = "SELECT COUNT(*) FROM moukatali.likes WHERE user_id = '$user_id' AND moukatage_id = '$moukatage_id' AND action = 1";
    $req = $db_connect->query( $sql );
    $userLiked = $req->fetch();

    if ( $userLiked ) {
        return true;
    } else {
        return false;
    }

}

// Vérifiez si l'utilisateur n'aime pas déjà le message ou non
function userDisliked($moukatage_id) {
    global $db_connect;

    $user_id = 2;
    $moukatage_id = 2;

    $sql = "SELECT COUNT(*) FROM moukatali.likes WHERE user_id = '$user_id' AND moukatage_id = '$moukatage_id' AND action = 0";
    $req = $db_connect->query( $sql );
    $userDisliked = $req->fetch();

    if ( $userDisliked ) {
        return true;
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