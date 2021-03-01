<?php
//echo '<div class="text-light">CHEMIN CONFIG OK</div>';



// définir des constantes globales
//define('ROOT_PATH', realpath(dirname(__FILE__, 2)));
define('ROOT_PATH_DIR', realpath(dirname(__DIR__)));
define('BASE_URL', 'http://127.0.0.1/edsa-moukatali');

//echo ROOT_PATH . ' ROOT<br/>';
//echo ROOT_PATH . ' ROOT_DIR<br/>';
//echo BASE_URL . ' BASE';

require (ROOT_PATH . '/src/class/Log.class.php');
$log = new Log(ROOT_PATH . '/logs');

?>