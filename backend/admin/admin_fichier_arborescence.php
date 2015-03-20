<?php

/**
 * Liste des fichiers pere et fils d'un fichier
 * @author Léang Stéphanie
 * @date 20070621
 */

if(acces(__FILE__)) {
    
    $id_fichier = $_GET['id'];
	$admin_fichier_arborescence = new flyLayout(REP_TPL . 'admin/admin_fichier_arborescence.tpl');
    $admin_fichier_arborescence->start();

    if(acces('admin_fichier_arborescence_ajout')) {
		include('admin_fichier_arborescence_ajout.php');
		$admin_fichier_arborescence->includeFile('include_ajout', $admin_fichier_arborescence_ajout);
	}
	
    $listPere = modelFile::getPere($id_fichier);
    if($listPere->size() > 0) {
		foreach($listPere as $key => $pere) {
			$admin_fichier_arborescence->setVariable('type_ligne_pere', ($listPere->index()%2==1)?'impair':'pair');
			$admin_fichier_arborescence->setVariable('nom_fichier_pere', $pere->nom_fichier);
			$admin_fichier_arborescence->setVariable('url_fichier', 'admin_fichier_detail.php?id=' . $pere->id_fichier);
    		$admin_fichier_arborescence->setVariable('supprimer_pere', '<a href="admin_fichier_arborescence_suppr.php?id='.$id_fichier.'&amp;id_fr='.$pere->id_fr.'" class="strong">Supprimer</a>');
			$admin_fichier_arborescence->parseList('pere');
		}
		$admin_fichier_arborescence->showBlock('liste_pere');
	}
	else {
		$admin_fichier_arborescence->showBlock('aucun_pere');
	}
	
    $listFils = modelFile::getFils($id_fichier);
	if($listFils->size() > 0) {		
		foreach($listFils as $key => $fils) {
			$admin_fichier_arborescence->setVariable('type_ligne_fils', ($listFils->index()%2==1)?'impair':'pair');
			$admin_fichier_arborescence->setVariable('nom_fichier_fils', $fils->nom_fichier);
			$admin_fichier_arborescence->setVariable('url_fichier', 'admin_fichier_detail.php?id=' . $fils->id_fichier);    		
			$admin_fichier_arborescence->setVariable('supprimer_fils', '<a href="admin_fichier_arborescence_suppr.php?id='.$id_fichier.'&amp;id_fr='.$fils->id_fr.'" class="strong">Supprimer</a>');
			$admin_fichier_arborescence->parseList('fils');
		}
		$admin_fichier_arborescence->showBlock('liste_fils');
	}
	else {
		$admin_fichier_arborescence->showBlock('aucun_fils');
	}	
	$admin_fichier_arborescence->stop();	
}

?>