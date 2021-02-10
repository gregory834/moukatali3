<?php

// session_start();
// se connecter à la base de données
$host = "localhost";
$login = "root";
$pwd = "";
$database = "moukatali";
$db = mysqli_connect($host, $login, $pwd, $database);

if (!$db) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
    echo 'connect to bdd ok';
}
// définir des constantes globales
// define('ROOT_PATH', realpath(dirname(__FILE__)));
// define('BASE_URL', 'http://127.0.0.1/edsa-moukatali2/');

// define('BASE_URL', 'http://localhost:8888/moukat-a-li/src');
?>