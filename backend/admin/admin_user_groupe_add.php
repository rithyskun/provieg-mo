<?php

/**
 * Permet d'ajouter un/des privilèges à un groupe
 * @author Rithy Khin
 * @version 20070623
 */

if(acces(__FILE__)) { 
    $id_user = $_GET['id'];	
	if(isset($_POST['submit'])) { // le formulaire est posté, la page est accédée directement
		if(isset($_POST['id_group'])) { // un élément de la liste est selectionné			
			foreach($_POST['id_group'] as $id_group) {        	
				modelGroupe::linkGroup($id_group,$id_user);
			}
			rootLayoutMonster::setMessage('The groups has been add to user');
				redirect('admin_user_detail', 'id=' . $id_user . '&choix=groupe');
		}
	}
	
	$admin_user_groupe_add = new flyLayout(REP_TPL . 'admin/admin_user_groupe_add.tpl');
    $admin_user_groupe_add->start();
    
	$admin_user_groupe_add->setVariable('ajax_file', REP_AJAX . 'admin/admin_user_groupe_liste.php');
	$admin_user_groupe_add->setVariable('url_action', 'admin_user_detail.php?id='.$id_user.'&choix=groupe');
	$admin_user_groupe_add->setVariable('id_user', $id_user);
	$admin_user_groupe_add->setVariable('debut_group', (isset($_POST['debut_group']))?$_POST['debut_group']:'');
	
	$admin_user_groupe_add->stop();  
//	$admin_user_groupe_add->setVariable('id_type_privilege', 0);
	//$admin_user_groupe_add->setVariable('lib_type_privilege', '(tous)');	
	//$admin_user_groupe_add->parseList('option_privilege');
	
	//$listType = modelAccessRight::getListType();
//	foreach($listType as $k => $type_privilege) {
//		$admin_user_groupe_add->setVariable('id_type_privilege', $type_privilege->id_type_privilege);
//		$admin_user_groupe_add->setVariable('lib_type_privilege', $type_privilege->lib_type_privilege);	
//		$admin_user_groupe_add->setVariable('selected_type', ((isset($_POST['type_privilege']) and ($_POST['type_privilege']==$type_privilege->id_type_privilege)) )?'selected="selected"':'');	
//		$admin_user_groupe_add->parseList('option_privilege');
//	}	
	
	//$admin_user_groupe_add->setVariable('id_dossier', 0);
//	$admin_user_groupe_add->setVariable('url_dossier', '(tous)');	
//	$admin_user_groupe_add->parseList('option_dossier');
	
	//$listDossier = modelFolder::getList();
//	foreach($listDossier as $k => $dossier) {
//		$admin_user_groupe_add->setVariable('id_dossier', $dossier->id_dossier);
//		$admin_user_groupe_add->setVariable('url_dossier', $dossier->url_dossier);	
//		$admin_user_groupe_add->setVariable('selected_dossier', (isset($_POST['url_dossier']) and $_POST['url_dossier']==$dossier->id_dossier)?'selected="selected"':'');	
//		$admin_user_groupe_add->parseList('option_dossier');
//	}

}

?>