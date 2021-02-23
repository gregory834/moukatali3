<?php
/**
 * Script de test de la classe Logger
 * Encodage: UTF-8 (sans BOM)
 * Auteur: www.finalclap.com
 * Date: 19/02/2012
**/
require 'lib/Logger.class.php';

if( isset($_GET['run']) ){
	header('Content-Type: text/plain; charset=utf-8');
	
	if( version_compare(PHP_VERSION, '5', '<') ){
		echo "Votre version de PHP (".PHP_VERSION.") est trop ancienne. PHP 5 minimum requis.";
		die();
	}
	
	// On créé un objet Logger (instanciation)
	$logger = new Logger('./logs');

	// Quelques logs avec différents types, nom et granularité
	$logger->log('erreurs', 'err_php', "Mon message d'erreur", Logger::GRAN_MONTH);
	$logger->log('statistiques', 'clic_liens_externes', "cible du lien : http://www.finalclap.com/", Logger::GRAN_MONTH);
	$logger->log('', 'sans_type', "Ce log n'a pas de type ni de granularité, il est simplement enregistré à la racine du dépôt", Logger::GRAN_VOID);
	
	// Un log qui enregistre pleins d'information que le visiteur :
	$referer	= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'none';
	$user_agent	= $_SERVER['HTTP_USER_AGENT'];
	$ip			= $_SERVER['REMOTE_ADDR'];
	$port		= $_SERVER['REMOTE_PORT'];
	$uri		= $_SERVER['REQUEST_URI'];
	$method		= $_SERVER['REQUEST_METHOD'];
	$row = "ip: $ip (port $port)	uri: $method $uri	referer: $referer	agent: $user_agent";
	$logger->log('statistiques', 'maxi_info', $row, Logger::GRAN_MONTH);
	
	echo "Test terminé, vous pouvez maintenant jeter un oeil dans votre dossier logs pour voir ce que le Logger y a écrit...";
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Page de test de la classe Logger</title>

	<link rel="stylesheet" type="text/css" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" />
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<div class="main">
		<div class="main_inner">
			<a href="http://www.finalclap.com/?utm_campaign=stockmotion%20readme&amp;utm_source=php-logger-class-test&amp;utm_content=header" style="float:right;">www.finalclap.com</a>
			<h1>Test Logger.class.php</h1>
			<p>Ceci est une page de test de la classe Logger.</p>
			<p>Si vous cliquez sur <strong>Lancer le test</strong>, des logs vont être écrits, vous pourrez ensuite les consulter via un navigateur en cliquant sur <strong>Voir les logs</strong>, ou avec un éditeur de texte en allant dans le dossier ./logs/.</p>
			<p style="margin-top:20px;">
				<a href="?run" class="btn danger">Lancer le test</a>
				<a href="./logs/" target="_blank" class="btn">Voir les logs </a>
			</p>
		</div>
	</div>

	<div class="footer">&copy; 2012 <a style="text-decoration:none;" href="http://www.finalclap.com/?utm_campaign=stockmotion%20readme&amp;utm_source=php-logger-class-test&amp;utm_content=footer">www.finalclap.com</a>.</div>

</body>
</html>