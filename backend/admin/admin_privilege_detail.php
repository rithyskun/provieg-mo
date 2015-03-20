<?php

/**
 * Permet de visionner le détail d'un privilège
 * @author Stephanie
 * @version 20070621
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** SECTION VERIFICATIONS *********************************************************************/
    if(!isset($_GET['id'])) {
		rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du privilège est non défini', Message::AVERT);
		redirect('admin_privilege');
	}
	$id_privilege = $_GET['id'];
	if(!modelAccessRight::exist($id_privilege)) {
		rootLayoutMonster::setMessage('Le profil que vous demandez n\'existe pas', Message::ERROR);
		redirect('admin_privilege');
	}
	
	/** SECTION AFFICHAGE *************************************************************************/
	$admin_privilege_detail = new flyLayout(REP_TPL . 'admin/admin_privilege_detail.tpl');
	$admin_privilege_detail->start();		
	$privilege = modelAccessRight::getPrivilege($id_privilege);
	
	$admin_privilege_detail->setVariable('intitule_privilege', $privilege->intitule_privilege);
	//$admin_privilege_detail->setVariable('description_privilege', $privilege->description_privilege);
	$admin_privilege_detail->setVariable('lib_type_privilege', $privilege->lib_type_privilege);
			
	$infodoc = new layoutInfodoc();
    $infodoc->setObjet($privilege);    
    $admin_privilege_detail->includeLayout('infodoc', $infodoc);
    
    $admin_privilege_detail->includeFile('menubar', new layoutMenubar());       
	
	$admin_privilege_detail->stop();
	$monster->setIncBody($admin_privilege_detail);
}

$monster->display();

?>