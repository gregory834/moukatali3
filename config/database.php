<?php

// Nom d'hôte du serveur MySQL
$db_host = 'localhost';
// Port
$db_port = 8888;
// Nom d'utilisateur du compte MySQL
$db_user = 'root';
// Mot de passe du compte MySQL
$db_pwd = 'root';
// La base de données utilisé
$database = 'moukatali';
// L'objet PDO
$db_connect = NULL;
// Chaîne de connexion
$conn = 'mysql:host = ' . $db_host . ';dbname = ' . $database;

// Connexion à l'intérieur d'un bloc try / catch
try {
    // Création d'objets PDO
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
}

?>