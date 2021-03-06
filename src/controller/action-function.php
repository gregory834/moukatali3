<?php

if ( isset ($_SESSION['user']) ) {
    $user_id = $_SESSION['user']['id'];
// si l'utilisateur clique sur le bouton J'aime ou Je n'aime pas
    if ( isset($_POST['action']) ) {
        $moukatage_id = $_POST['moukatage_id'];
        $action = $_POST['action'];
        switch ($action) {
            case 'like':
                $sql = "INSERT INTO moukatali.likes (user_id, moukatage_id, action)
                        VALUES ('$user_id', '$moukatage_id', 'like')
                        ON DUPLICATE KEY UPDATE action='like'";
                break;
            case 'dislike':
                $sql = "INSERT INTO moukatali.likes (user_id, moukatage_id, action)
                        VALUES ('$user_id', '$moukatage_id', 'dislike')
                        ON DUPLICATE KEY UPDATE action = 'dislike'";
                break;
            case 'unlike':
                $sql = "DELETE FROM moukatali.likes WHERE user_id = '$user_id' AND moukatage_id = '$moukatage_id'";
                break;
            case 'undislike':
                $sql = "DELETE FROM moukatali.likes WHERE user_id = '$user_id' AND moukatage_id = '$moukatage_id'";
                break;
            default:
                break;
        }

        // exécuter une requête pour effectuer des modifications dans la base de données ...
        $requete = $db_connect->prepare($sql);
        $requete->execute();
        echo getRatings($moukatage_id);
        exit(0);
    }
}

// Obtenir le nombre total de likes pour un article en particulier
function getLikes($moukatage_id) {
    global $db_connect;
    $sql = "SELECT COUNT(*) FROM moukatali.likes WHERE moukatage_id = $moukatage_id AND action = 'like'";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    
    return intval($result[0]);
}

// Obtenir le nombre total de dislikes pour un message particulier
function getDislikes($moukatage_id) {
    global $db_connect;
    $sql = "SELECT COUNT(*) FROM moukatali.likes WHERE moukatage_id = $moukatage_id AND action = 'dislike'";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

    return intval($result[0]);
}

// Obtenir le nombre total de mentions J'aime et Je n'aime pas pour un moukatage en particulier
function getRatings($moukatage_id) {
    global $db_connect, $moukatage_id;

    $rating = array();

    $likes_query = "SELECT COUNT(*) FROM moukatali.likes WHERE moukatage_id = $moukatage_id AND action = 'like'";
    $dislikes_query = "SELECT COUNT(*) FROM moukatali.likes WHERE moukatage_id = $moukatage_id AND action = 'dislike'";

    $likes_rs = $db_connect->query($likes_query);
    $dislikes_rs = $db_connect->query($dislikes_query);

    $likes = $likes_rs->fetch();
    $dislikes = $dislikes_rs->fetch();
    
    $total_likes = intval($likes[0]);
    $total_dislikes = intval($dislikes[0]);

    $sql = "UPDATE moukatali.moukatages SET likes = '$total_likes', dislikes = '$total_dislikes' WHERE id = '$moukatage_id'";
    $query = $db_connect->query($sql);
    
    $rating = [
        "likes" => $total_likes,
        "dislikes" => $total_dislikes
    ];
    
    return json_encode($rating);

}

// Vérifiez si l'utilisateur aime déjà le message ou non
function userLiked($moukatage_id) {
    global $db_connect, $user_id;

    if ( isset($_SESSION['user']) ) {
        $sql = "SELECT * FROM moukatali.likes WHERE user_id = $user_id AND moukatage_id = $moukatage_id AND action = 'like'";
        $requete = $db_connect->prepare($sql);
        $requete->execute();
        $count = $requete->rowCount();
        if ( $count > 0) {
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
        $sql = "SELECT * FROM moukatali.likes WHERE user_id = $user_id AND moukatage_id = $moukatage_id AND action = 'dislike'";
        $requete = $db_connect->prepare($sql);
        $requete->execute();
        $count = $requete->rowCount();
        if ( $count > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

?>