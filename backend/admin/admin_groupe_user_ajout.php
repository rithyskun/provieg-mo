<?php

/**
 * Permet d'ajouter un/des utilisateurs à un groupe
 * @author Léang Stéphanie
 * @version 20070625
 */

if(acces(__FILE__)) {
    $id_groupe = $_GET['id'];
	if(isset($_POST['submit'])) { // le formulaire est posté, la page est accédée directement			
        if(isset($_POST['id_user'])) { // un élément de la liste est selectionné			     
            foreach($_POST['id_user'] as $id_user) {		
				modelGroupe::linkUser($id_groupe, $id_user);
			}
			rootLayoutMonster::setMessage('L\'utilisateur a bien été ajouté au groupe');
		
		}
	}
	
	$admin_groupe_user_ajout = new flyLayout(REP_TPL . 'admin/admin_groupe_user_ajout.tpl');
	$admin_groupe_user_ajout->start(); 
	
	$admin_groupe_user_ajout->setVariable('ajax_file', REP_AJAX . 'admin/admin_groupe_user_liste.php');
	$admin_groupe_user_ajout->setVariable('url_action', 'admin_groupe_detail.php?id='.$id_groupe.'&choix=user');
	$admin_groupe_user_ajout->setVariable('id_groupe', $id_groupe);
	
	$admin_groupe_user_ajout->stop(); 
}

?>