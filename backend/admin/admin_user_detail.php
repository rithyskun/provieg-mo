<?php

/**
 * Permet de visionner les informations d'un profil de connexion
 * @author Léang Stéphanie
 * @version 20070618
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

$monster->addJavaScript('tableFilter/jquery.cookies-packed.js');
$monster->addJavaScript('tableFilter/prototypes-packed.js'); 
$monster->addJavaScript('tableFilter/json-packed.js');
$monster->addJavaScript('tableFilter/jquery.truemouseout-packed.js');
$monster->addJavaScript('tableFilter/daemachTools-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.aggregator-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.columnStyle-packed.js');
$monster->addJavaScript('main.js');
$monster->addStyleSheet('tableFilter.aggregator.css');
$monster->addStyleSheet('tableFilter.css');
if(acces(__FILE__)) {
    if(!isset($_GET['id'])) {
		$monster->setMessage('You have been redirected to this page because the \n identifier of the user is undefined', Message::AVERT);
		redirect('admin_user');
	}
    $id_user = $_GET['id'];
	if(!modelUser::exist($id_user)) {
		$monster->setMessage('Profil you request don\'t exist', Message::ERROR);
		redirect('admin_user');
	}

    /** SECTION AFFICHAGE *****************************************************/
    $admin_user_detail = new flyLayout(REP_TPL . 'admin/admin_user_detail.tpl');
	$admin_user_detail->start();
    			
	$user = modelUser::getUser($id_user);
	$admin_user_detail->setVariable('login', $user->login);
	$admin_user_detail->setVariable('lib_etat_user', $user->lib_etat_user);
	$admin_user_detail->setVariable('id_user', $id_user);
    	if(acces('admin_user_detail_nickname')) {
		include('admin_user_detail_nickname.php');
		$admin_user_detail->includeFile('admin_user_detail_nickname', $admin_user_detail_nickname);
    }
    	
	if(acces('admin_user_detail_address')) {
		include('admin_user_detail_address.php');
		$admin_user_detail->includeFile('admin_user_detail_address', $admin_user_detail_address);
	
	$infodoc = new layoutInfodoc();	
    $infodoc->setObjet($user);    
    $admin_user_detail->includeLayout('infodoc', $infodoc);
    
	if(acces('admin_user_pass')) {
		$admin_user_detail->showBlock('block_pass');
	}
	
	$admin_user_detail->includeFile('menubar', new layoutMenubar());

	}
    
	$admin_user_detail->stop();
	$monster->setIncBody($admin_user_detail);
}

$monster->display();
   
?>