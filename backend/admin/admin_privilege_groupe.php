<?php

/**
 * Permet de visionner les groupes d'un privilege
 * @author Léang Stéphanie
 * @version 20070621
 */

if(acces(__FILE__)) {
	$id_privilege = $_GET['id'];
	
	$admin_privilege_groupe = new flyLayout(REP_TPL . 'admin/admin_privilege_groupe.tpl');
	$admin_privilege_groupe->start();
	
	if (acces('admin_privilege_groupe_ajout')){	
		include('admin_privilege_groupe_ajout.php');
		$admin_privilege_groupe->includeFile('include_ajout', $admin_privilege_groupe_ajout);
    }
    
    $listgroupe = modelAccessRight::getGroupe($id_privilege);
    if($listgroupe->size() > 0) {	
        $groupeSuppr = acces('admin_privilege_suppr_groupe');
    	foreach($listgroupe as $key => $groupe) {
    	
    		$admin_privilege_groupe->setVariable('intitule_groupe', $groupe->intitule_groupe);
    		$admin_privilege_groupe->setVariable('description_groupe', $groupe->description_groupe);
    		$admin_privilege_groupe->setVariable('url_groupe', 'admin_groupe_detail.php?id='. $groupe->id_groupe);    		
            if($groupeSuppr == null) 
    			$admin_privilege_groupe->setVariable('delete', '<a href="admin_privilege_groupe_suppr.php?id='. $id_privilege.'&idgp='.$groupe->idgp.'">Delete</a>');
    		$admin_privilege_groupe->parseList('groupe');
    	}
    	$admin_privilege_groupe->showBlock('liste');
	}
	else {
		$admin_privilege_groupe->showBlock('aucun');
	}	
	$admin_privilege_groupe->stop();
}

?>