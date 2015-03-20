<?php

/**
 * Permet de modifier un utilisateur
 * @author Léang Stéphanie
 * @version 20070619
 */

define('REP_ROOT','../');
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
	if(isset($_POST['login_user'])) {
		$login_utilisateur = addslashes($_POST['login_user']);	
		$status = addslashes($_POST['status']);
		if(modelUser::existLoginModif($login_utilisateur, $id_utilisateur)) {
			$monster->setMessage('This connection login is already taken', Message::ERROR);		
			redirect('admin_user_modif','id=' . $id_utilisateur);
		}
	    modelUser::updateLoginStutus($id_utilisateur, $login_utilisateur,$status);	   
		$monster->setMessage('The user details has been modified');				
		redirect('admin_user_detail', 'id=' . $id_utilisateur);
	}
		
    /** SECTION AFFICHAGE *****************************************************/
	$admin_user_modif = new flyLayout(REP_TPL . 'admin/admin_user_modif.tpl');
	$admin_user_modif->start();
	$user = modelUser::getUser($id_utilisateur);
	$admin_user_modif->setVariable('login_donnee', $user->login);
	$admin_user_modif->setVariable('id_user', $id_utilisateur);
	
	$getStetatUser=modelUser::getLiStetatUser();
		foreach($getStetatUser as $key => $$stetatUser) {
		$admin_user_modif->setVariable('status',$$stetatUser->lib_etat_user);
		$admin_user_modif->setVariable('id_status',$$stetatUser->id_etat_user);
		$admin_user_modif->setVariable('selected',$user->etat_user==$$stetatUser->id_etat_user?'selected=true':'');
		$admin_user_modif->parseList('list_name_status');	
	}

	$admin_user_modif->stop();
	$monster->setIncBody($admin_user_modif);
}

$monster->display();

?>