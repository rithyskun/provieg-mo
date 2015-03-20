<?php

/**
 * Affiche la liste des privilèges n'appertenant pas au fichier et correspondant à la recherche
 * @author Marcadet Antoine
 * @version 20070625
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP


$id_groupe = normalise($_POST['id_groupe'], 'int');
$id_privilege = normalise($_POST['id_privilege'], 'int');
$debut_groupe = normalise($_POST['debut_groupe']);

$db = Annuaire::lookup(KEY_DATABASE);
$res = $db->executeQuery("SELECT *
                    		FROM _adm_groupe AS ag
                    		WHERE ag.intitule_groupe LIKE '$debut_groupe%'
                    		AND ag.etat_doc = 1
                    		AND id_groupe NOT IN(
                    								SELECT id_groupe 
                    								FROM _adm_groupe_privilege 
                    								WHERE id_privilege = '$id_privilege'
                    								AND (etat_doc = 1 OR etat_doc = 2)
                    							)
                    		ORDER BY ag.intitule_groupe");
                    		
foreach($res as $k => $groupe) {
	echo '<option value="'.$groupe->id_groupe.'">'.$groupe->intitule_groupe.'</option>';
}

?>