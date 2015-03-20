<?php

/**
 * Affiche la liste des utilisateurs n'appertenant pas au groupe et correspondant à la recherche
 * @author Antoine Marcadet
 * @version 20070624
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_groupe = $_POST['id_groupe'];
$debut_login = normalise($_POST['debut_login']);

$db = Annuaire::lookup(KEY_DATABASE);
$res = $db->executeQuery("SELECT u.id_user, login
                    		FROM _adm_user AS u
                    		WHERE login LIKE '$debut_login%'		
                    		AND u.etat_doc = 1 		
                    		AND u.id_user NOT IN( 
                    							SELECT id_user 
                    							FROM _adm_user_groupe 
                    							WHERE id_groupe = $id_groupe
                    							AND etat_doc = 1
                    						)
                    		ORDER BY login");

foreach($res as $k => $user) {
	echo '<option value="'.$user->id_user.'">'.$user->login.'</option>';
}


?>