<?php

/**
 * Permet de supprimer un groupe
 * @author Stéphanie Léang
 * @date 20070619
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** SECTION VERIFICATIONS *************************************************/
	if(!isset($_GET['id'])) {
		rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant de l\'utilisateur est non défini', Message::AVERT);
		redirect('admin_groupe');
	}              
	$id_groupe = $_GET['id'];
	if(!modelGroupe::exist($id_groupe)) {
		rootLayoutMonster::setMessage('Le groupe que vous demandez n\'existe pas', Message::ERROR);
		redirect('admin_groupe');
	}
		
	/** SECTION TRAITEMENTS ***************************************************/
	if(isset($_POST['pass'])) {
		if(modelUser::verifPass($_POST['pass'])) {	// le mot de passe est correct
			modelGroupe::delete($id_groupe);
			$monster->setMessage('Le groupe a bien été supprimé');
			redirect('admin_groupe');
		}
		else {				
			$monster->setMessage('Erreur lors de la saisie de votre mot de passe', Message::ERROR);
			redirect('admin_groupe_suppr', 'id=' . $id_groupe);
		}
	}
		
    /** SECTION AFFICHAGE *****************************************************/
    $admin_groupe_detail = new flyLayout(REP_TPL . 'admin/admin_groupe_detail.tpl');
    $admin_groupe_detail->start();
    $groupe = modelGroupe::getGroupe($id_groupe);
	$admin_groupe_detail->setVariable('intitule_groupe', $groupe->intitule_groupe);
	$admin_groupe_detail->setVariable('description_groupe', $groupe->description_groupe);
	$admin_groupe_detail->stop();
    
    $admin_groupe_suppr = new flyLayout(REP_TPL . 'admin/admin_groupe_suppr.tpl');
    $admin_groupe_suppr->start();		
	$admin_groupe_suppr->setVariable('id_groupe', $id_groupe);		
	$admin_groupe_suppr->includeFile('groupe_detail', $admin_groupe_detail);
	$admin_groupe_suppr->stop();
    	    
    $monster->setIncBody($admin_groupe_suppr);
}

$monster->display();

?>