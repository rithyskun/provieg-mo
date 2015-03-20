<?php

/**
 * La page d'ajout d'un groupe pour un groupe
 * @author Léang Stéphanie
 * @date 20070626
 */

if(acces(__FILE__)){   
	if(isset($_POST['submit'])) { // le formulaire est posté, la page est accédée directement
		$id_privilege = $_GET['id'];
		if(isset($_POST['id_groupe'])) { // un élément de la liste est selectionné
			$id_groupe = $_POST['id_groupe'];
			
			foreach($_POST['id_groupe'] as $id_groupe) {		
				modelGroupe::linkPrivilege($id_groupe, $id_privilege);
			}
			
		//	modelgroupe::linkgroupe($id_groupe, $id_groupe);			
			rootLayoutMonster::setMessage('Le privilège a été ajouté à ce groupe');
			redirect('admin_privilege_detail', 'id='.$id_privilege.'&choix=groupe');
            
		}
	}
	
	$admin_privilege_groupe_ajout = new flyLayout(REP_TPL . 'admin/admin_privilege_groupe_ajout.tpl');
	$admin_privilege_groupe_ajout->start();	
	$admin_privilege_groupe_ajout->setVariable('ajax_file', REP_AJAX . 'admin/admin_privilege_groupe_liste.php');
	$admin_privilege_groupe_ajout->setVariable('url_action', 'admin_privilege_detail.php?id='.$id_privilege.'&choix=groupe');
	$admin_privilege_groupe_ajout->setVariable('id_privilege', $_GET['id']);

	
	//$listType = modelgroupe::getListType();
//    foreach($listType as $key => $type) {
//		$admin_privilege_groupe_ajout->setVariable('id_type_groupe', $type->id_type_groupe);
//		$admin_privilege_groupe_ajout->setVariable('lib_type_groupe', $type->lib_type_groupe);		
//		$admin_privilege_groupe_ajout->parseList('type_groupe');
//	}	

	$admin_privilege_groupe_ajout->stop();
}

?>