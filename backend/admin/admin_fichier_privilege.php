<?php

/**
 * Permet de visionner les privileges d'un fichier
 * @author Léang Stéphanie
 * @version 20070621
 */


if(acces(__FILE__)) {
	$id_fichier = $_GET['id'];
	
	$admin_fichier_privilege = new flyLayout(REP_TPL . 'admin/admin_fichier_privilege.tpl');
	$admin_fichier_privilege->start();
	
	if (acces('admin_fichier_privilege_ajout')){	
		include('admin_fichier_privilege_ajout.php');
		$admin_fichier_privilege->includeFile('include_ajout', $admin_fichier_privilege_ajout);
    }
    
    $listPrivilege = modelFile::getPrivilege($id_fichier);
    if($listPrivilege->size() > 0) {	
        $privilegeSuppr = acces('admin_fichier_suppr_privilege');
    	foreach($listPrivilege as $key => $privilege) {
    		$admin_fichier_privilege->setVariable('type_ligne', ($listPrivilege->index()%2==1)?'impair':'pair');
    		$admin_fichier_privilege->setVariable('lib_type_privilege', $privilege->lib_type_privilege);
    		$admin_fichier_privilege->setVariable('intitule_privilege', $privilege->intitule_privilege);
    		$admin_fichier_privilege->setVariable('description_privilege', $privilege->description_privilege);
    		$admin_fichier_privilege->setVariable('url_privilege', 'admin_privilege_detail.php?id=' . $privilege->id_privilege);    		
            if($privilegeSuppr == null) 
    			$admin_fichier_privilege->setVariable('supprimer', '<a href="admin_fichier_privilege_suppr.php?id=' . $id_fichier . '&idfp='.$privilege->idfp .'">Delete</a>');
    		$admin_fichier_privilege->parseList('privilege');
    	}
    	$admin_fichier_privilege->showBlock('liste');
	}
	else {
		$admin_fichier_privilege->showBlock('aucun');
	}	
	$admin_fichier_privilege->stop();
}

?>