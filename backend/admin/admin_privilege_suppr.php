<?php

/**
 * Permet de supprimer un privilège
 * @author Léang Stéphanie
 * @date 20070622
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) { 
    /** VERIFICATIONS *********************************************************************/
    if(!isset($_GET['id'])) {
		rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du privilège est non défini', Message::AVERT);
		redirect('admin_privilege');
	}
	$id_privilege = $_GET['id'];
	if(!modelAccessRight::exist($id_privilege)) {
		rootLayoutMonster::setMessage('Le profil que vous demandez n\'existe pas', Message::ERROR);
		redirect('admin_privilege');
	}
	
	/** TRAITEMENTS ***********************************************************************/
	if(isset($_POST['pass'])) {
		if(modelUser::verifPass($_POST['pass'])) {
			modelAccessRight::delete($id_privilege);
			rootLayoutMonster::setMessage('Votre privilège a bien été supprimé');
			redirect('admin_privilege');
		}
		else {
			rootLayoutMonster::setMessage('Erreur lors de la saisie de votre mot de passe', Message::ERROR);
			redirect('admin_privilege_suppr.', 'id=' . $id_privilege);
		}
	}

    /** AFFICHAGE *************************************************************************/
	$admin_privilege_detail = new flyLayout(REP_TPL . 'admin/admin_privilege_detail.tpl');
	$admin_privilege_detail->start();
	
	$privilege = modelAccessRight::getPrivilege($id_privilege);
	$admin_privilege_detail->setVariable('intitule_privilege', $privilege->intitule_privilege);
	//$admin_privilege_detail->setVariable('description_privilege', $privilege->description_privilege);
	$admin_privilege_detail->setVariable('lib_type_privilege', $privilege->lib_type_privilege);
	//$admin_privilege_detail->setVariable('id_privilege', $privilege->id_privilege);
	
	$admin_privilege_detail->stop();
	
	// formulaire de suppression
	$admin_privilege_suppr = new flyLayout(REP_TPL . 'admin/admin_privilege_suppr.tpl');
	$admin_privilege_suppr->start();		
	$admin_privilege_suppr->setVariable('id_privilege', $id_privilege);
	$admin_privilege_suppr->includeFile('detail', $admin_privilege_detail);
	$admin_privilege_suppr->stop();
	
    $monster->setIncBody($admin_privilege_suppr);
}

$monster->display();

?>