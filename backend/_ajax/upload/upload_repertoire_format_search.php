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
$debut_format = normalise($_POST['debut_format']);

$db = Annuaire::lookup(KEY_DATABASE);
$sql = "SELECT uf.*
		FROM upload_format_image AS uf
		WHERE nom_format LIKE '$debut_format%'
        AND uf.etat_doc = 1	
		AND uf.id_format NOT IN ( 
        							SELECT id_format 
        							FROM upload_repertoire_format
        							WHERE id_repertoire = $id_repertoire
        							AND etat_doc = 1
    					       	)
		ORDER BY nom_format";
                            
$res = $db->executeQuery($sql);

foreach($res as $k => $format) {
	echo '<option value="'.$format->id_format.'">'.$format->nom_format.'</option>';
}

?>