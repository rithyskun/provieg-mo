<?php

/**
 * Affiche la liste des privilèges n'appertenant pas au fichier et correspondant à la recherche
 * @author Marcadet Antoine
 * @version 20070625
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_privilege = $_POST['id_privilege'];
$debut_fichier = normalise($_POST['debut_fichier']);

$db = Annuaire::lookup(KEY_DATABASE);

$res = $db->executeQuery("SELECT f.*
                    		FROM _adm_fichier AS f
                    		WHERE nom_fichier LIKE '$debut_fichier%'		
                    		AND f.etat_doc = 1 		
                    		AND f.id_fichier NOT IN( 
                    							SELECT id_fichier 
                    							FROM _adm_privilege_fichier
                    							WHERE id_privilege = $id_privilege
                    							AND etat_doc = 1
                    						)
                    		ORDER BY nom_fichier");

foreach($res as $k => $fichier) {
	echo '<option value="'.$fichier->id_fichier.'">'.$fichier->nom_fichier.'.php</option>';
}


?>