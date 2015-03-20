<?php

/**
 * Permet de modifier un privilege
 * @author Léang Stéphanie
 * @version 20070621
 */

define('REP_ROOT','../');
require(REP_ROOT.'config.php');

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
	if(isset($_POST['intitule_privilege'])) {
		$intitule_privilege = normalise($_POST['intitule_privilege']);
		$description_privilege = normalise($_POST['description_privilege']);			
		$id_type_privilege = $_POST['type_privilege'];
		
		if(!modelAccessRight::existPrivilegeModif($id_privilege, $intitule_privilege, $id_type_privilege)) {
            modelAccessRight::update($id_privilege, $intitule_privilege, $id_type_privilege);
            rootLayoutMonster::setMessage('Le privilege a bien été modifié', Message::INFO);
	 	    redirect('admin_privilege_detail', 'id=' . $id_privilege);	
        }
	}
	
    /** AFFICHAGE *************************************************************************/
	$admin_privilege_modif = new flyLayout(REP_TPL . 'admin/admin_privilege_modif.tpl');
	$admin_privilege_modif->start();		
	
    $privilege = modelAccessRight::getPrivilege($id_privilege);
	$admin_privilege_modif->setVariable('intitule_privilege_donnee', $privilege->intitule_privilege);
	//$admin_privilege_modif->setVariable('description_privilege_donnee', $privilege->description_privilege);
	$admin_privilege_modif->setVariable('id_privilege', $id_privilege);
	
	$listType = modelAccessRight::getListType();
	foreach($listType as $key => $type) {
		if($type->id_type_privilege == $privilege->id_type_privilege) 
			$admin_privilege_modif->setVariable('selected', 'selected="selected"');
		else
			$admin_privilege_modif->setVariable('selected', '');
		$admin_privilege_modif->setVariable('id_type_privilege', $type->id_type_privilege);
		$admin_privilege_modif->setVariable('lib_type_privilege', $type->lib_type_privilege);		
		$admin_privilege_modif->parseList('option_privilege');
	}	
	$admin_privilege_modif->stop();
	$monster->setIncBody($admin_privilege_modif);
}

$monster->display();

?>