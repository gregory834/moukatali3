
<!-- METHODE PDO CONNECTION BDD -->
<?php 
function connectPdoBdd(){
   
    try {
        $conn = "root";
        $pass = "";
        $pdo = new PDO('mysql:host=localhost;dbname=moukatali', $conn, $pass);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $db='moukatali';
<<<<<<< HEAD:functions/bdd-connect.php
         echo 'METHOD PDO CONNECTION REUSSI AVEC FONCTION connectPdoBdd<br/>'; return $pdo;} 
catch (PDOException $e) {print "Erreur !: " . $e->getMessage() . "<br/>";die();}}
=======
         echo 'METHOD PDO CONNECTION REUSSI AVEC FONCTION connectPdoBdd<br/>';
        return $pdo;} 
    catch (PDOException $e) {print "Erreur !: " . $e->getMessage() . "<br/>";die();}}
// connectPdoBdd();

>>>>>>> 0ac8ea26513238ea04282772432f5119bda49226:src/functions/bdd-connect.php
?>



