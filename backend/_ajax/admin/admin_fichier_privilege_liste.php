<?php

/**
 * Affiche la liste des privilèges n'appertenant pas au fichier et correspondant à la recherche
 * @author Marcadet Antoine
 * @version 20070625
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP


$id_fichier = $_POST['id_fichier'];
$id_type_privilege = $_POST['id_type_privilege'];
$debut_privilege = addslashes($_POST['debut_privilege']);

$db = Annuaire::lookup(KEY_DATABASE);
$res = $db->executeQuery("SELECT ap.id_privilege, ap.intitule_privilege
                    		FROM _adm_privilege AS ap
                    		WHERE ap.id_type_privilege = $id_type_privilege
                    		AND ap.intitule_privilege LIKE '$debut_privilege%'
                    		AND ap.etat_doc = 1
                    		AND id_privilege NOT IN(
                    								SELECT id_privilege 
                    								FROM _adm_privilege_fichier 
                    								WHERE id_fichier = '$id_fichier'
                    								AND (etat_doc = 1 OR etat_doc = 2)
                    							)
                    		ORDER BY ap.intitule_privilege");
                    		
foreach($res as $k => $privilege) {
	echo '<option value="'.$privilege->id_privilege.'">'.$privilege->intitule_privilege.'</option>';
}

?>