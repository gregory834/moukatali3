<?php
//echo '<div class="text-light">CHEMIN CONFIG OK</div>';



// définir des constantes globales
define('ROOT_PATH', realpath(dirname(__FILE__, 2)));
define('BASE_URL', 'http://localhost:8888/moukatali3');

require (ROOT_PATH . '/src/class/Log.class.php');
$log = new Log(BASE_URL . '/logs');

?>