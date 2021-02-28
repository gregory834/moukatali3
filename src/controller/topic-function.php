<?php

function getTopicById($topics_id) {

    global $db_connect;
   
    $requete = "SELECT * from `topics` where topics_id = '$topics_id' ";
    $stmt = $db_connect->query($requete);
    $topic = $stmt->fetch();

    return $topic;
}

?>