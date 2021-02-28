<?php

session_start();

$servername = 'localhost';
$database = "moukatali";
$login = 'root';
$pwd = '';

//On essaie de se connecter
try{
    $db_connect = new PDO("mysql:host=$servername; dbname=$database", $login, $pwd);
    //On définit le mode d'erreur de PDO sur Exception
    $db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '<div class="text-light">Connexion réussie</div>';
}

/*On capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}

?>