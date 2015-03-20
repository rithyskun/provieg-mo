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

    /** SECTION AFFICHAGE *****************************************************/
    $admin_user_detail_address = new flyLayout(REP_TPL . 'admin/admin_user_detail_address.tpl');
	$admin_user_detail_address->start();
	

	if(!modelUser::existUserInfo($id_user)) {
		$admin_user_detail_address->showBlock('user');
		
	}else{
	    $user_info = modelUser::getUserInfo($id_user);
		$admin_user_detail_address->setVariable('first_name', $user_info->first_name);
		$admin_user_detail_address->setVariable('last_name', $user_info->last_name);
		$admin_user_detail_address->setVariable('city', $user_info->city);
		$admin_user_detail_address->setVariable('country', $user_info->country);
		$admin_user_detail_address->setVariable('zip_code', $user_info->zip_code);
		$admin_user_detail_address->setVariable('address1', $user_info->address1);
		$admin_user_detail_address->setVariable('address2', $user_info->address2);
		$admin_user_detail_address->showBlock('user');
	}
	
	$admin_user_detail_address->stop();

}
   
?>