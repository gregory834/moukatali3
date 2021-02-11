

<!-- METHODE PDO CONNECTION BDD -->

<?php 

function connectPdoBdd(){
    try {
        $conn = "root"; $pass = ""; $pdo = new PDO('mysql:host=localhost;dbname=moukatali', $conn, $pass);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $db='moukatali';
         echo 'METHOD PDO CONNECTION REUSSI AVEC FONCTION connectPdoBdd '; return $pdo;} 
catch (PDOException $e) {print "Erreur !: " . $e->getMessage() . "<br/>";die();}}
//   ATTENTION NE PAS EFFACER 
//FUNCTION CONNECTION METHODE PDO OK FONCTIONELLE
// connectPdoBdd();

?>






<!-- METHODE SQLI CONNECTION BDD-->

<?php
      function connectSqliBdd(){
        $servername = 'localhost'; $username = 'root'; $password = ''; $dbname = 'moukatali';
        //On établit la connexion
        $conn = new mysqli($servername, $username, $password, $dbname);
        //On vérifie la connexion
        if($conn->connect_error){ die('Erreur : ' .$conn->connect_error);}
        echo 'METHOD SQLI CONNECTION REUSSI AVEC FONCTION connectSqliBdd ';}
//   ATTENTION NE PAS EFFACER 
//   connectSqliBdd();
?>

