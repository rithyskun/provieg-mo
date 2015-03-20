<?php

/**
 * Affiche la liste des types MIME n'appertenant pas au répertoire et correspondant à la recherche
 * @author Antoine Marcadet
 * @version 20070817
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_repertoire = $_POST['id_repertoire'];
$debut_mime = normalise($_POST['debut_mime']);

$db = Annuaire::lookup(KEY_DATABASE);
$sql = "SELECT zz.*
		FROM zz_data_type_mime AS zz
		WHERE type_fichier LIKE '$debut_mime%'		
		AND zz.id_type_mime NOT IN ( 
        							SELECT id_type_mime 
        							FROM upload_repertoire_mime 
        							WHERE id_repertoire = $id_repertoire
        							AND etat_doc = 1
    					       	)
		ORDER BY type_fichier";
                            
$res = $db->executeQuery($sql);

foreach($res as $k => $typeMime) {
	echo '<option value="'.$typeMime->id_type_mime.'">'.$typeMime->type_fichier.' ('.$typeMime->type_mime.')</option>';
}

?>