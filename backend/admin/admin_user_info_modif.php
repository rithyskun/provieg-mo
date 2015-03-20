<?php

define ( 'REP_ROOT', '../' );
require (REP_ROOT . 'config.php');
$monster = new rootLayoutMonster ();

if (acces ( __FILE__ )) {
	
	if (! isset ( $_GET ['id'] )) {
		rootLayoutMonster::setMessage ( 'You have been redirected to this page because the \n identifier of the user is undefined', Message::AVERT );
		redirect ( 'admin_user' );
	}
	$id_user = $_GET ['id'];
	if (! modelUser::exist ( $id_user )) {
		rootLayoutMonster::setMessage ( 'The profile you ask don\'t exist', Message::ERROR );
		redirect ( 'admin_user' );
	}
	
	if (isset ( $_POST ['submit'] )) {
		
		$nickname = $_POST ['nickname'];
		$first_name = $_POST ['first_name'];
		$last_name = $_POST ['last_name'];
		$city = $_POST ['city'];
		$zip_code = $_POST ['zip_code'];
		$id_country = $_POST ['id_country'];
		$address1 = $_POST ['address1'];
		$address2 = $_POST ['address2'];
		
		if (! modelUser::existUserInfo ( $id_user )) {
			modelUser::insertUserinfos ( $id_user, $nickname, $first_name, $last_name, $city, $id_country, $zip_code, $address1, $address2 );
			$monster->setMessage ( 'The user details has been inserted' );
			redirect ( 'admin_user_detail', 'id=' . $id_user );
		} else {
			modelUser::updateUserInfos ( $id_user, $nickname, $first_name, $last_name, $city, $id_country, $zip_code, $address1, $address2 );
			$monster->setMessage ( 'The user details has been modified' );
			redirect ( 'admin_user_detail', 'id=' . $id_user );
		}
	}
	
	$admin_user_info_modif = new flyLayout ( REP_TPL . 'admin/admin_user_info_modif.tpl' );
	$admin_user_info_modif->start ();
	
	$admin_user_info_modif->setVariable ( 'id_user', $id_user );
	$user_info = null;
	if (modelUser::existUserInfo( $id_user)) {
		$user_info = modelUser::getUserInfo ( $id_user );
		$admin_user_info_modif->setVariable ( 'nickname', $user_info->nickname );
		$admin_user_info_modif->setVariable ( 'first_name', $user_info->first_name );
		$admin_user_info_modif->setVariable ( 'last_name', $user_info->last_name );
		$admin_user_info_modif->setVariable ( 'city', $user_info->city );
		$admin_user_info_modif->setVariable ( 'zip_code', $user_info->zip_code );
		$admin_user_info_modif->setVariable ( 'address1', $user_info->address1 );
		$admin_user_info_modif->setVariable ( 'address2', $user_info->address2 );
	}
	
	$listCountry = modelCountry::getList ();
	foreach ( $listCountry as $key => $country ) {
		$admin_user_info_modif->setVariable ( 'country', $country->country );
		$admin_user_info_modif->setVariable ( 'id_country', $country->id_country );
		$admin_user_info_modif->setVariable ( 'selected', ($user_info != null ? ($user_info->id_country == $country->id_country ? 'selected=true' : '') : '') );
		$admin_user_info_modif->parseList ( 'countries' );
	}
	
	$admin_user_info_modif->stop ();
	$monster->setIncBody ( $admin_user_info_modif );
}

$monster->display ();

?>