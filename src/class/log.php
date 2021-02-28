<?php

if( isset($_POST['connection']) ){
	
	// On créé un objet Log (instanciation)
	$log = new Log('../../logs');

	// Quelques logs avec différents types, nom et sous-dossier
	/*$log->log('erreurs', 'err_php', "Message d'erreur", Log::FOLDER_MONTH);
	$log->log('statistiques', 'clic_bouton_connexion', "connexion utilisateur", Log::FOLDER_MONTH);
	$log->log('', 'sans_type', "Ce log est simplement enregistré à la racine du dépôt", Log::FOLDER_ROOT);*/

	// Enregistrement d'un événement dans un fichier .log :
	$log->log('connexion', 'conn_utilisateurs', "Fonction connexion() : l'authentification a réussi", Log::FOLDER_MONTH);
	
	// Un log qui enregistre des informations sur le visiteur :
	$referer	= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'none';
	$user_agent	= $_SERVER['HTTP_USER_AGENT'];
	$ip			= $_SERVER['REMOTE_ADDR'];
	$port		= $_SERVER['REMOTE_PORT'];
	$uri		= $_SERVER['REQUEST_URI'];
	$method		= $_SERVER['REQUEST_METHOD'];
	$message = "ip: " . $ip . " (port " . $port . ")" . " uri:" . $method . $uri	. " referer:" . $referer	. " agent:" . $user_agent;
	$log->log('statistiques', 'info_utilisateur', $message, Log::FOLDER_MONTH);
	
	echo "Test terminé";
	die();
}

?>