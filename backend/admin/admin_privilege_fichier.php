<?php

/**
 * Show access right for a file
 * @author Léang Stéphanie, modify by Christophe D
 * @version 20070621 , 20080312
 */

if(acces(__FILE__)) {
	$id_privilege = $_GET['id'];
	$admin_privilege_fichier = new flyLayout(REP_TPL . 'admin/admin_privilege_fichier.tpl');
	$admin_privilege_fichier->start();
	
	if(acces('admin_privilege_fichier_ajout')) {
		include('admin_privilege_fichier_ajout.php');
		$admin_privilege_fichier->includeFile('include_privilege_fichier_ajout', $admin_privilege_fichier_ajout);
	}
	
	$listFichier = modelAccessRight::getListFichier($id_privilege);
    if($listFichier->size() > 0) {
        $privilegeSuppr = acces('admin_privilege_suppr_fichier');
        foreach($listFichier as $key => $fichier){
    		$admin_privilege_fichier->setVariable('type_ligne', ($listFichier->index()%2==1)?'impair':'pair');
    		$admin_privilege_fichier->setVariable('nom_fichier', $fichier->nom_fichier);
    		$admin_privilege_fichier->setVariable('description_fichier', affiche($fichier->description_fichier, 'complet'));
    		
    		$admin_privilege_fichier->setVariable('url_fichier', 'admin_fichier_detail.php?id=' . $fichier->id_fichier);
    		if($privilegeSuppr == null)
    			$admin_privilege_fichier->setVariable('supprimer', '<a href="admin_privilege_fichier_suppr.php?id=' . $id_privilege . '&idpf='.$fichier->id.'">Delete</a>');
    		$admin_privilege_fichier->parseList('fichier');
    	}
        $admin_privilege_fichier->showBlock('liste');
    }
    else {
        $admin_privilege_fichier->showBlock('nothing');
    }
	$admin_privilege_fichier->stop();
}

?>