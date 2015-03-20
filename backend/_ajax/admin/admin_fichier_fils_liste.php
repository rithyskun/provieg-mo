<?php

/**
 * Affiche la liste des fichiers correspondant au filtre
 * @author Marcadet Antoine
 * @version 20070625
 */ 
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_fichier = $_POST['id_fichier'];
$id_type_fichier = $_POST['id_type_fichier_fils'];
$debut_fils = $_POST['debut_fils'];

$db = Annuaire::lookup(KEY_DATABASE);

$sql = "SELECT af.id_fichier, af.nom_fichier
		FROM _adm_fichier AS af
		WHERE af.nom_fichier LIKE '$debut_fils%'
		AND af.etat_doc = 1
		AND af.id_fichier NOT IN(
								SELECT id_fichier_pere
								FROM _adm_fichier_recursif
								WHERE id_fichier_fils = '$id_fichier'
								AND etat_doc = 1
								OR etat_doc = 2
							)
		AND af.id_fichier NOT IN(
								SELECT id_fichier_fils
								FROM _adm_fichier_recursif
								WHERE id_fichier_pere = '$id_fichier'
								AND etat_doc = 1
								OR etat_doc = 2
							)";
if($id_type_fichier != 0) {
	/*if($id_type_fichier == 3)
		$sql .= " AND af.id_fichier NOT IN(
									SELECT id_fichier_fils
									FROM _adm_fichier_recursif AS afr3
									WHERE afr3.etat_doc = 1
									OR afr3.etat_doc = 2
								)";	*/
	$sql.= " AND af.id_type_fichier = $id_type_fichier";
}	
$sql.= " ORDER BY af.nom_fichier ASC";

$resultat = $db->executeQuery($sql);

foreach($resultat as $k => $fichier) {
	echo '<option value="'.$fichier->id_fichier.'">'.$fichier->nom_fichier.'.php</option>';
}


?>