<?php

// Nom d'hôte du serveur MySQL
$db_host = 'remotemysql.com:3306';
// Port
$db_port = 3306;
// Nom d'utilisateur du compte MySQL
$db_user = 'yj8Z0v0tn2';
// Mot de passe du compte MySQL
<<<<<<< HEAD
$db_pwd = 'root';
=======
$db_pwd = '0weXwVdyYy';
>>>>>>> vincent
// La base de données utilisé
$database = 'yj8Z0v0tn2';
// L'objet PDO
$db_connect = NULL;
// Chaîne de connexion
$conn = 'mysql:host = ' . $db_host . ';dbname = ' . $database;

<<<<<<< HEAD
// Connexion à l'intérieur d'un bloc try / catch
try {
    // Création de l'objet PDO
    $db_connect = new PDO($conn, $db_user, $db_pwd);
    // Activer les exceptions sur les erreurs
    $db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connecter à la base de données.<br/>';
} catch (PDOException $e) {
    //  S'il y a une erreur, une exception est levée
    echo 'La connexion à la base de données a échoué.<br/>';
    echo "Erreur : " . $e->getMessage();
    $log->log('base_de_donnees', 'connexion_bdd', "Erreur : " . $e->getMessage(), Log::FOLDER_MONTH);
    die();
=======
// Connexion à la BDD

$db_connect = new Mysqli($db_host, $db_user, $db_pwd, $database, $db_port);
if ($db_connect->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $db_connect->connect_errno . ") " . $db_connect->connect_error;
>>>>>>> vincent
}
//echo $db_connect->host_info . "\n OK";

?>