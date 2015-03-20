<?php

/**
 * Permet de visionner les informations d'un profil de connexion
 * @author Léang Stéphanie
 * @version 20070618
 */

if(acces(__FILE__)) {
    if(!isset($_GET['id'])) {
		$monster->setMessage('You have been redirected to this page because the \n identifier of the user is undefined', Message::AVERT);
		redirect('admin_user');
	}
  	$id_user = $_GET['id'];
	if(!modelUser::exist($id_user)) {
		$monster->setMessage('The profile you ask don\'t exist', Message::ERROR);
		redirect('admin_user');
	}

    /** SECTION AFFICHAGE --------------------------**/
    $admin_user_detail_nickname = new flyLayout(REP_TPL . 'admin/admin_user_detail_nickname.tpl');
	$admin_user_detail_nickname->start();
	
		$user_info = modelUser::getUserInfo($id_user);
		$admin_user_detail_nickname->setVariable('nickname',!modelUser::existUserInfo($id_user)?'':$user_info->nickname);
		$admin_user_detail_nickname->showBlock('user');

	$admin_user_detail_nickname->stop();

}
   
?>