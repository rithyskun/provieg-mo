<?php

/**
 * Permet de supprimer un utilisateur
 * @author Léang Stéphanie
 * @version 20070620
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** SECTION VERIFICATIONS *************************************************/
	if(!isset($_GET['id'])) {
		rootLayoutMonster::setMessage('You have been redirected to this page because the \n identifier of the user is undefined', Message::AVERT);
		redirect('admin_user');
	}
	$id_utilisateur = $_GET['id'];
	if(!modelUser::exist($id_utilisateur)) {
		rootLayoutMonster::setMessage('The profile you ask don\'t exist', Message::ERROR);
		redirect('admin_user');
	}
	
    /** SECTION TRAITEMENTS ***************************************************/
	if(isset($_POST['pass'])) {
		if(modelUser::verifPass($_POST['pass'])) {	// le mot de passe est correct
			modelUser::delete($id_utilisateur);
			rootLayoutMonster::setMessage('The user account has been deleted');
			redirect('admin_user');
		}
		else {				
			rootLayoutMonster::setMessage('Entry does not match your password', Message::ERROR);
			redirect('admin_user_suppr', 'id=' . $id_utilisateur);
		}				
	}
		
    /** SECTION AFFICHAGE *****************************************************/
	$admin_user_detail = new flyLayout(REP_TPL . 'admin/admin_user_detail.tpl');
	$admin_user_detail->start();		
    $user = modelUser::getUser($id_utilisateur);
	$admin_user_detail->setVariable('login', $user->login);
	$admin_user_detail->setVariable('lib_etat_user', $user->lib_etat_user);
	$admin_user_detail->stop();
	
	$admin_user_suppr = new flyLayout(REP_TPL . 'admin/admin_user_suppr.tpl');
    $admin_user_suppr->start();
	$admin_user_suppr->setVariable('id_user', $id_utilisateur);
	$admin_user_suppr->includeFile('detail', $admin_user_detail);
	$admin_user_suppr->stop();
	
	$monster->setIncBody($admin_user_suppr);
}

$monster->display();

?>