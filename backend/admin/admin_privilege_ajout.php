<?php

/**
 * Permet d'ajouter un privilège
 * @author Léang Stéphanie
 * @version 20070622
 */

define('REP_ROOT','../');
require('../config.php');

$monster = new rootLayoutMonster();
    
if(acces(__FILE__)) { 

    /** SECTION TRAITEMENTS**************************************************/
	if(isset($_POST['submit'])) {	
        $intitule_privilege = normalise($_POST['intitule_privilege']);
		//$description_privilege = normalise($_POST['description_privilege']);
		$id_type_privilege = normalise($_POST['type_privilege'], 'id');
				
		$id_privilege = modelAccessRight::insert($intitule_privilege, $id_type_privilege);
		$monster->setMessage('Le privilège a correctement été ajouté');
		redirect('admin_privilege_detail', 'id=' . $id_privilege);
	}
	
    /** SECTION AFFICHAGE*******************************************/
	$admin_privilege_ajout = new flyLayout(REP_TPL . 'admin/admin_privilege_ajout.tpl');
	$admin_privilege_ajout->start();	
	$listType = modelAccessRight::getListType();
	foreach($listType as $key => $type) {	
		$admin_privilege_ajout->setVariable('id_type_privilege', $type->id_type_privilege);
		$admin_privilege_ajout->setVariable('lib_type_privilege', $type->lib_type_privilege);		
		$admin_privilege_ajout->parseList('option_privilege');
	}	
	$admin_privilege_ajout->stop();
	$monster->setIncBody($admin_privilege_ajout);
}

$monster->display();
	
?>