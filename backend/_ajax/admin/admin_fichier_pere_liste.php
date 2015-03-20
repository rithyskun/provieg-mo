<?php

/**
 * Affiche la liste des fichiers correspondant au filtre
 * @author Marcadet Antoine
 * @version 20070625
 */ 
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_fichier = normalise($_POST['id_fichier'], 'int');
$id_type_fichier = $_POST['id_type_fichier_pere'];
$debut_pere = normalise($_POST['debut_pere']);

$db = Annuaire::lookup(KEY_DATABASE);

$sql = "SELECT af.id_fichier, af.nom_fichier
		FROM _adm_fichier AS af
		WHERE af.nom_fichier LIKE '$debut_pere%'
		AND af.etat_doc = 1
		AND id_fichier NOT IN(
								SELECT id_fichier_pere
								FROM _adm_fichier_recursif
								WHERE id_fichier_fils = '$id_fichier'
								AND etat_doc in (1,2)
							)
		AND id_fichier NOT IN(
								SELECT id_fichier_fils
								FROM _adm_fichier_recursif
								WHERE id_fichier_pere = '$id_fichier'
								AND etat_doc in (1,2)
							)";
if($id_type_fichier != 0) 
	$sql .= " AND af.id_type_fichier = $id_type_fichier";
$sql .= " ORDER BY af.nom_fichier ASC";

$resultat = $db->executeQuery($sql);

foreach($resultat as $k => $fichier) {
	echo '<option value="'.$fichier->id_fichier.'">'.$fichier->nom_fichier.'.php</option>';
}

?>