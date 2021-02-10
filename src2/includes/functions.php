<?php

// si l'utilisateur clique sur le bouton publier
if (isset($_POST['posted'])) {
    createComment($_POST);
}

function createComment($request_values) {
    global $db, $errors;

    $posted_comment = htmlentities(trim($request_values['posted-comment']));
    $user_id = $_SESSION['user']['user_id'];
    $topic_id = $request_values['topic-id'];
    
    // validation input
    if (empty($posted_comment)) {
        array_push($errors, "Entrer un commentaire");
    }
    
    // on vérifie si l'utilisateur n'a pas dèjà commenté 
    $post_check_query = "SELECT * FROM comments WHERE user_id = '$user_id' AND topic_id = '$topic_id'";
    $result = mysqli_query($conn, $post_check_query);

    if (mysqli_num_rows($result) > 0) { // if post exists
        array_push($errors, "Vous avez déja posté un commentaire.");
    }
    // poster le commentaire si il n'y a pas d'erreur
    if (count($errors) == 0) {
        $query = "INSERT INTO comments (post, vote_for, vote_against, publication_date, user_id, topic_id) VALUES ('$posted_comment', 0, 0, now(), '$user_id', '$topic_id')";
        if(mysqli_query($db, $query)){ // si le commentaire a été inséré dans la BDD
            $_SESSION['message'] = "Commentaire posté!";
            exit(0);
        } else {
            //echo 'ERREUR BDD';
            exit('ERREUR BDD');
        }
    }
}



?>