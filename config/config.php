<?php

session_start();

date_default_timezone_set('Indian/Reunion');


// définir des constantes globales
define('ROOT_PATH', realpath(dirname(__FILE__, 2)));
define('BASE_URL', 'http://localhost:8888/moukatali3');

// on appelle la classe Log
require (ROOT_PATH . '/src/class/Log.class.php');
$log = new Log(ROOT_PATH . '/logs');

?>