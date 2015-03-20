<?php

/**
 * Permet de visionner tous les privilèges d'un groupe
 * @author Léang Stéphanie
 * @version 20070625 
 */

if(acces(__FILE__)) {
	$id_groupe = $_GET['id'];	
	$admin_groupe_privilege = new flyLayout(REP_TPL . 'admin/admin_groupe_privilege.tpl');
	$admin_groupe_privilege->start();	

    if(acces('admin_groupe_privilege_ajout')) {
		include('admin_groupe_privilege_ajout.php');
		$admin_groupe_privilege->includeFile('include_groupe_privilege_ajout', $admin_groupe_privilege_ajout);
    }

	$listPrivilege = modelGroupe::getListPrivilege($id_groupe);
	$pagination = new layoutPagination();
    $pagination->setList($listPrivilege);
    $pagination->setDisplay(PAGINATION_MAX);
    $admin_groupe_privilege->includeLayout('pagination', $pagination);
	if($listPrivilege->size() > 0){
    	$privilege_suppr = acces('admin_groupe_suppr_privilege');	
        	foreach($listPrivilege as $key => $privilege){
        		$admin_groupe_privilege->setVariable('type_ligne', ($listPrivilege->index()%2)?'impair':'pair');
        		$admin_groupe_privilege->setVariable('intitule_privilege', $privilege->intitule_privilege);
        		$admin_groupe_privilege->setVariable('description_privilege', $privilege->description_privilege);
        		$admin_groupe_privilege->setVariable('lib_type_privilege', $privilege->lib_type_privilege);
        		if($privilege_suppr == null)
        			$admin_groupe_privilege->setVariable('url_suppr', '<a href="admin_groupe_privilege_suppr.php?id='.$id_groupe.'&id_gp='.$privilege->id_gp.'">Delete</a>');
        		$admin_groupe_privilege->setVariable('url_privilege', 'admin_privilege_detail.php?id=' . $privilege->id_privilege);
        		$admin_groupe_privilege->parseList('privilege');
        	}
    	    $admin_groupe_privilege->showBlock('liste');
	}
    else {		    
        $admin_groupe_privilege->showBlock('aucun');
    }
	$admin_groupe_privilege->stop();
}

?>