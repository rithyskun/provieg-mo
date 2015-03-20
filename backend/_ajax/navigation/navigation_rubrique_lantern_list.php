<?php

/**
 * show list of categories aren't attach to product and match search
 *  
 * @author Christophe Sokhom Sokchea, Chandy
 * @version 20080311
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_famille = $_POST['id_famille'];
$debut_fichier = addslashes($_POST['debut_fichier']);
//***********************//
$famille = modelCategory::getCategory($id_famille);
$language_link = $famille->language_link;
$famille = modelCategory::getCategory(null,null,$language_link);
$language_code = $famille->language_code;
$id_famille = $famille->id_famille;
//***********************//
$db = Annuaire::lookup(KEY_DATABASE);

$res = $db->executeQuery("SELECT f.* 
                    		FROM lantern AS f
                    		WHERE f.name_lantern LIKE '$debut_fichier%'
                    		AND f.language_code = '$language_code'
                    		AND f.etat_doc = 1
                    		AND f.id_lantern NOT IN(
                    							SELECT id_lantern
                    							FROM navigation_rubrique_lantern
                    							WHERE id_navigation_rubrique = $id_famille 
                    							AND etat_doc = 1
                    						)
                    		ORDER BY f.name_lantern");

foreach($res as $k => $fichier) {
	if(modelCategory::root()->language_link!==$famille->language_link){
			echo '<option value="'.$fichier->id_lantern.'">'.$fichier->name_lantern.'</option>';	
	}	
}

?>