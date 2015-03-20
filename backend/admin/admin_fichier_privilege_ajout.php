<?php

/**
 * La page d'ajout d'un privilege pour un fichier
 * @author Léang Stéphanie
 * @date 20070626
 */

if(acces(__FILE__)){   
	if(isset($_POST['submit'])) { // le formulaire est posté, la page est accédée directement
		$id_fichier = $_GET['id'];
		if(isset($_POST['id_privilege'])) { // un élément de la liste est selectionné
			$id_privilege = $_POST['id_privilege'];
			
			foreach($_POST['id_privilege'] as $id_privilege) {		
				modelFile::linkPrivilege($id_fichier, $id_privilege);
			}
			
		//	modelFile::linkPrivilege($id_fichier, $id_privilege);			
			rootLayoutMonster::setMessage('Le privilège a été ajouté à ce fichier');
			redirect('admin_fichier_detail', 'id='.$id_fichier.'&choix=privilege');
            
		}
	}	
	
	$admin_fichier_privilege_ajout = new flyLayout(REP_TPL . 'admin/admin_fichier_privilege_ajout.tpl');
	$admin_fichier_privilege_ajout->start();	
	$admin_fichier_privilege_ajout->setVariable('ajax_file', REP_AJAX . 'admin/admin_fichier_privilege_liste.php');
	$admin_fichier_privilege_ajout->setVariable('url_action', 'admin_fichier_detail.php?id='.$id_fichier.'&choix=privilege');
	$admin_fichier_privilege_ajout->setVariable('id_fichier', $_GET['id']);

	
	$listType = modelAccessRight::getListType();
    foreach($listType as $key => $type) {
		$admin_fichier_privilege_ajout->setVariable('id_type_privilege', $type->id_type_privilege);
		$admin_fichier_privilege_ajout->setVariable('lib_type_privilege', $type->lib_type_privilege);		
		$admin_fichier_privilege_ajout->parseList('type_privilege');
	}	

	$admin_fichier_privilege_ajout->stop();
}

?>