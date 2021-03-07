<?php

// Nom d'hôte du serveur MySQL
$db_host = 'remotemysql.com:3306';
// Port
$db_port = 3306;
// Nom d'utilisateur du compte MySQL
$db_user = 'yj8Z0v0tn2';
// Mot de passe du compte MySQL
$db_pwd = '0weXwVdyYy';
// La base de données utilisé
$database = 'yj8Z0v0tn2';
// L'objet PDO
$db_connect = NULL;
// Chaîne de connexion
$conn = 'mysql:host = ' . $db_host . ';dbname = ' . $database;

// Connexion à la BDD

$db_connect = new Mysqli($db_host, $db_user, $db_pwd, $database, $db_port);
if ($db_connect->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $db_connect->connect_errno . ") " . $db_connect->connect_error;
}
//echo $db_connect->host_info . "\n OK";

?>