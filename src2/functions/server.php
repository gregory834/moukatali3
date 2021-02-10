<?php
// démarrer une session
// session_start();
date_default_timezone_set('Indian/Reunion');

// connexion au serveur
$host = "localhost";
$login = "root";
$pwd = "";
$db = "moukatali";

$sql_connect = new mysqli($host, $login, $pwd, $db);

// vérification de la connexion
if($sql_connect->connect_error){
    die('Erreur : ' .$sql_connect->connect_error);
}
echo 'Connexion réussie<br>';

// connexion à la BDD
$db = mysqli_connect($host, $login, $pwd, $db);

/*
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'information_schema';
$db_port = 8889;

$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);
	
if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}

echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: '.$mysqli->host_info;
echo '<br>';
echo 'Protocol version: '.$mysqli->protocol_version;

$mysqli->close();
*/

?>