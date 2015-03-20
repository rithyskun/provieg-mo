<?php
/**
* module de deconnexion de l'utilisateur
* avec mise à jour de la table des connectes
*/

define('REP_ROOT', '');

require('config.php');
$url = 'index.php';

if(isset($_SESSION['login'])) {
	modelUser::insertHisto(modelUser::TYPE_HISTO_LOGOUT, $_SESSION['login']);
		
	// on detruit les variables de cette session
	session_unset();
	// on detruit la session en elle meme
	session_destroy();

	session_start();
}
	
header('Location: index.php');
exit();

// on redirige le visiteur
redirect($url);

?>