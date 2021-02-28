<?php

session_start();

// définir des constantes globales pour le chemin des liens, fichiers et dossiers
define('ROOT_PATH', realpath(dirname(__FILE__, 2)));
define('BASE_URL', 'http://localhost:8888/moukatali');

// on appelle la classe Log
require (ROOT_PATH . '/src/class/Log.class.php');
$log = new Log(ROOT_PATH . '/logs');


?>