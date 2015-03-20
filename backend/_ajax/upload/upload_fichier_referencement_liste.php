<?php

/**
 * Affiche la liste des tag correspondant au filtre
 * @author Léang Stéphanie
 * @version 20070711
 */ 
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_fichier = normalise($_POST['id_fichier'], 'int');
$debut_tag = normalise($_POST['debut_tag']);
$id_groupe = normalise($_POST['groupe_tag'], 'int');

$sql = "SELECT *
		FROM referencement_tag AS t 
        LEFT JOIN referencement_groupe_tag AS g ON g.id_tag = t.id_tag
		WHERE t.libelle_tag LIKE '$debut_fichier%'
		AND t.etat_doc = 1
		AND t.id_tag NOT IN (SELECT id_tag FROM referencement_tag_fichier
                            WHERE id_fichier = $id_fichier
                            AND etat_doc = 1)     
		";
if($id_groupe != 0)
    $sql .= "AND g.id_groupe = $id_groupe";

$resultat = $db->executeQuery($sql);

foreach($resultat as $k => $tag) {
	echo '<option value="'.$tag->id_tag.'">'.$tag->libelle_tag.'</option>';
}

?>