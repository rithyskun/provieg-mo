<?php
/**
 * show list of categories aren't attach to product and match search
 *  
 * @author Christophe Sokhom Sokchea
 * @version 20080311
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-t�te HTTP

$id_user = $_POST['id_user'];
$debut_group = normalise($_POST['debut_group']);

$db = Annuaire::lookup(KEY_DATABASE);

$res = $db->executeQuery("SELECT *
                    		FROM _adm_groupe
                    		WHERE intitule_groupe LIKE '$debut_group%'		
                    		AND etat_doc = 1                     		
							AND id_groupe NOT IN( 
                    							SELECT id_groupe
                    							FROM _adm_user_groupe
                    							WHERE id_user = $id_user
                    							AND etat_doc = 1
                    						)                  	
                    		ORDER BY intitule_groupe");

foreach($res as $k => $groupe) {
	echo '<option value="'.$groupe->id_groupe.'">'.$groupe->intitule_groupe.'</option>';
}


?>