<?php

// si l'utilisateur clique sur le bouton J'aime ou Je n'aime pas
if (isset($_POST['action'])) {
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    switch ($action) {
        case 'like':
            $sql = "INSERT INTO rating_info (user_id, post_id, rating_action)
                    VALUES ($user_id, $post_id, 'like')
                    ON DUPLICATE KEY UPDATE rating_action='like'";
            break;
        case 'dislike':
            $sql = "INSERT INTO rating_info (user_id, post_id, rating_action)
                    VALUES ($user_id, $post_id, 'dislike')
                    ON DUPLICATE KEY UPDATE rating_action = 'dislike'";
            break;
        case 'unlike':
            $sql = "DELETE FROM rating_info WHERE user_id = $user_id AND post_id = $post_id";
            break;
        case 'undislike':
            $sql = "DELETE FROM rating_info WHERE user_id = $user_id AND post_id = $post_id";
            break;
        default:
            break;
    }

    // exécuter une requête pour effectuer des modifications dans la base de données ...
    mysqli_query($conn, $sql);
    echo getRatings($post_id);
    exit(0);
}

// Obtenez le nombre total de likes pour un article en particulier
function getLikes($id) {
    global $conn;
    $sql = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action = 'like'";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}

// Obtenir le nombre total de dislikes pour un message particulier
function getDislikes($id) {
    global $conn;
    $sql = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action = 'dislike'";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}

// Obtenez le nombre total de mentions J'aime et Je n'aime pas pour un article en particulier
function getRatings($id) {
    global $conn;

    $rating = array();

    $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action = 'like'";
    $dislikes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action = 'dislike'";

    $likes_rs = mysqli_query($conn, $likes_query);
    $dislikes_rs = mysqli_query($conn, $dislikes_query);

    $likes = mysqli_fetch_array($likes_rs);
    $dislikes = mysqli_fetch_array($dislikes_rs);

    $rating = [
        'likes' => $likes[0],
        'dislikes' => $dislikes[0]
    ];
    return json_encode($rating);

}

// Vérifiez si l'utilisateur aime déjà le message ou non
function userLiked($post_id) {
    global $conn, $user_id;

    $sql = "SELECT * FROM rating_info WHERE user_id = $user_id AND post_id = $post_id AND rating_action = 'like'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

// Vérifiez si l'utilisateur n'aime pas déjà le message ou non
function userDisliked($post_id) {
    global $conn, $user_id;

    $sql = "SELECT * FROM rating_info WHERE user_id = $user_id AND post_id = $post_id AND rating_action = 'dislike'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
/*
$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);
// récupérer tous les messages de la base de données
// les renvoyer sous forme de tableau associatif appelé $posts
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
*/
?>