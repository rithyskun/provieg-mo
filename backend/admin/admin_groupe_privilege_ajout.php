<?php

/**
 * Permet d'ajouter un/des privilèges à un groupe
 * @author Léang Stéphanie
 * @version 20070625
 */

if(acces(__FILE__)) { 
    $id_groupe = $_GET['id'];	
	if(isset($_POST['submit'])) { // le formulaire est posté, la page est accédée directement
		if(isset($_POST['id_privilege'])) { // un élément de la liste est selectionné			
			foreach($_POST['id_privilege'] as $id_privilege) {        	
				modelGroupe::linkPrivilege($id_groupe, $id_privilege);
			}
			rootLayoutMonster::setMessage('Le privilège a bien été ajouté au groupe');
			
		}
	}
	
	$admin_groupe_privilege_ajout = new flyLayout(REP_TPL . 'admin/admin_groupe_privilege_ajout.tpl');
    $admin_groupe_privilege_ajout->start();
    
	$admin_groupe_privilege_ajout->setVariable('ajax_file', REP_AJAX . 'admin/admin_groupe_privilege_liste.php');
	$admin_groupe_privilege_ajout->setVariable('url_action', 'admin_groupe_detail.php?id='.$id_groupe.'&choix=privilege');
	$admin_groupe_privilege_ajout->setVariable('id_groupe', $id_groupe);
	$admin_groupe_privilege_ajout->setVariable('debut_privilege', (isset($_POST['debut_privilege']))?$_POST['debut_privilege']:'');

	$admin_groupe_privilege_ajout->setVariable('id_type_privilege', 0);
	$admin_groupe_privilege_ajout->setVariable('lib_type_privilege', '(tous)');	
	$admin_groupe_privilege_ajout->parseList('option_privilege');
	
	$listType = modelAccessRight::getListType();
	foreach($listType as $k => $type_privilege) {
		$admin_groupe_privilege_ajout->setVariable('id_type_privilege', $type_privilege->id_type_privilege);
		$admin_groupe_privilege_ajout->setVariable('lib_type_privilege', $type_privilege->lib_type_privilege);	
		$admin_groupe_privilege_ajout->setVariable('selected_type', ((isset($_POST['type_privilege']) and ($_POST['type_privilege']==$type_privilege->id_type_privilege)) )?'selected="selected"':'');	
		$admin_groupe_privilege_ajout->parseList('option_privilege');
	}	
	
	$admin_groupe_privilege_ajout->setVariable('id_dossier', 0);
	$admin_groupe_privilege_ajout->setVariable('url_dossier', '(tous)');	
	$admin_groupe_privilege_ajout->parseList('option_dossier');
	
	$listDossier = modelFolder::getList();
	foreach($listDossier as $k => $dossier) {
		$admin_groupe_privilege_ajout->setVariable('id_dossier', $dossier->id_dossier);
		$admin_groupe_privilege_ajout->setVariable('url_dossier', $dossier->url_dossier);	
		$admin_groupe_privilege_ajout->setVariable('selected_dossier', (isset($_POST['url_dossier']) and $_POST['url_dossier']==$dossier->id_dossier)?'selected="selected"':'');	
		$admin_groupe_privilege_ajout->parseList('option_dossier');
	}

	$admin_groupe_privilege_ajout->stop();  
}

?>