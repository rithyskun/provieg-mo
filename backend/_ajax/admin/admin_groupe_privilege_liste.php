<?php

/**
 * Affiche la liste des privileges n'appertenant pas au groupe et correspondant à la recherche
 * @author Antoine Marcadet
 * @version 20070624
 */
 
define('REP_ROOT', '../../');
require(REP_ROOT . 'config.php');

header('Content-type: text/html; charset=utf-8'); // en-tête HTTP

$id_groupe = $_POST['id_groupe'];
$debut_privilege = normalise($_POST['debut_privilege']);
$type_privilege  = normalise($_POST['type_privilege']);
$id_dossier      = normalise($_POST['url_dossier']);

$db = Annuaire::lookup(KEY_DATABASE);
$sql = "SELECT ap.id_privilege, ap.intitule_privilege
		FROM _adm_privilege AS ap
		WHERE ap.intitule_privilege LIKE '$debut_privilege%'
		AND ap.etat_doc = 1
		AND id_privilege NOT IN ( 
								SELECT id_privilege 
								FROM _adm_groupe_privilege AS agp 
								WHERE id_groupe = '$id_groupe' 
								AND etat_doc = 1
							)";
if($type_privilege != 0) {
$sql.=	" AND ap.id_type_privilege = $type_privilege";
}
if($id_dossier != 0) {
$sql.= " AND id_privilege IN (
								SELECT ap.id_privilege
								FROM _adm_privilege AS ap, _adm_privilege_fichier AS apf, _adm_fichier AS af
								WHERE af.id_dossier = $id_dossier
								AND af.id_fichier = apf.id_fichier
								AND apf.id_privilege = ap.id_privilege
								AND apf.etat_doc = 1
								AND af.etat_doc = 1
								AND ap.etat_doc = 1
							)";
}

$res = $db->executeQuery($sql);

foreach($res as $k => $privilege) {
	echo '<option value="'.$privilege->id_privilege.'">'.$privilege->intitule_privilege.'</option>';
}


?>