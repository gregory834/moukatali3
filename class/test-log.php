<?php

if ( isset($_POST['connection']) ) {

    $log = new Log('../../logs');

    $log->log( 'connexion-utilisateur', 'utilisateur connecté', log::FOLDER_MONTH );

    $referer	= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'none';
	$user_agent	= $_SERVER['HTTP_USER_AGENT'];
	$ip			= $_SERVER['REMOTE_ADDR'];
	$port		= $_SERVER['REMOTE_PORT'];
	$uri		= $_SERVER['REQUEST_URI'];
	$method		= $_SERVER['REQUEST_METHOD'];
	$message = "ip: $ip (port $port)	uri: $method $uri	referer: $referer	agent: $user_agent";
	$log->log('statistiques', 'maxi_info', $message, Log::FOLDER_MONTH);
    die();
}

?>