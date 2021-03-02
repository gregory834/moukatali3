<?php

session_start();

// définir des constantes globales
define('ROOT_PATH', realpath(dirname(__FILE__, 2)));
define('BASE_URL', 'http://127.0.0.1/edsa-moukatali');

// on appelle la classe Log
require (ROOT_PATH . '/src/class/Log.class.php');
$log = new Log(ROOT_PATH . '/logs');

?>