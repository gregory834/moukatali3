



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

<!-- METHODE PDO CONNECTION BDD -->

<?php 

function connectPdoBdd(){
    try {
        $user = "root"; $pass = ""; $pdo = new PDO('mysql:host=localhost;dbname=moukatali', $user, $pass);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo 'METHOD PDO CONNECTION REUSSI AVEC FONCTION connectPdoiBdd '; return $pdo;} 
catch (PDOException $e) {print "Erreur !: " . $e->getMessage() . "<br/>";die();}}
//   ATTENTION NE PAS EFFACER 
//FUNCTION CONNECTION METHODE PDO OK FONCTIONELLE
// connectPdoBdd();

?>