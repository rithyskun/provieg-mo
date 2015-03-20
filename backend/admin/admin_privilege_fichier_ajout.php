<?php

/**
 * La page d'ajout d'un fichier pour un privilege
 * @author Marcadet Antoine
 * @date 12/06/06
 */

if(acces(__FILE__)) {
	if(isset($_GET['id'])) {
		$id_privilege = $_GET['id'];
		if(isset($_POST['submit'])) {
			foreach($_POST['id_fichier'] as $id_fichier) {
            modelAccessRight::linkFichier($id_privilege, $id_fichier);
			}
			rootLayoutMonster::setMessage('Le fichier a été ajouté à ce privilège');			
            //$monster->setMessage('Le fichier a été ajouté à ce privilège');
		}
	}

	$admin_privilege_fichier_ajout = new flyLayout(REP_TPL . 'admin/admin_privilege_fichier_ajout.tpl');
    $admin_privilege_fichier_ajout->start();	
	$admin_privilege_fichier_ajout->setVariable('ajax_file', REP_AJAX . 'admin/admin_privilege_fichier_liste.php');
	$admin_privilege_fichier_ajout->setVariable('url_action', 'admin_privilege_detail.php?id='.$id_privilege.'&choix=fichier');
	$admin_privilege_fichier_ajout->setVariable('id_privilege', $_GET['id']);
	$admin_privilege_fichier_ajout->stop();
}

?>