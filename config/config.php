<?php

session_start();

$local = 1;
// définir des constantes globales
define('ROOT_PATH', realpath(dirname(__FILE__, 2)));
if ($local == 1) {
    define('BASE_URL', 'http://localhost:8888/moukatali3');
} else {
    define('BASE_URL', 'https://moukat-a-li.herokuapp.com');
};



// on appelle la classe Log
require (ROOT_PATH . '/src/class/Log.class.php');
$log = new Log(ROOT_PATH . '/logs');

?>