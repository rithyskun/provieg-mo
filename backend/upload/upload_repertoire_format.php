<?php

/**
 * Permet de visionner tous les formats d'un répertoire
 * @author Antoine Marcadet
 * @date 20070927
 */

if(acces(__FILE__)) {
    //-- Section affichage ---------------------------------------------------//
    $id_repertoire = $_GET['id'];
	$upload_repertoire_format = new flyLayout(REP_TPL . 'upload/upload_repertoire_format.tpl');
    $upload_repertoire_format->start();
   	
	if(acces('upload_repertoire_format_ajout')) {
		include('upload_repertoire_format_ajout.php');
		$upload_repertoire_format->includeFile('include_repertoire_format_ajout', $upload_repertoire_format_ajout);
	}
	
	$listFormat = modelUploadFolder::getListFormat($id_repertoire);
	if($listFormat->size() > 0) {
    	$privilege_suppr = acces('upload_repertoire_format_suppr');
    	$privilege_recerate = acces('upload_repertoire_format_recreate');
    	foreach($listFormat as $key => $format) {
    		$upload_repertoire_format->setVariable('type_ligne', ($listFormat->index()%2==1)?'impair':'pair');
    		$upload_repertoire_format->setVariable('nom_format', $format->nom_format);
    		$upload_repertoire_format->setVariable('url_format', $format->url_format);
    		$upload_repertoire_format->setVariable('largeur', $format->largeur);
    		$upload_repertoire_format->setVariable('hauteur', $format->hauteur);
    		if($privilege_recerate)
                $upload_repertoire_format->setVariable('url_recreate', '<a href="upload_repertoire_format_recreate.php?id_rf=' . $format->id_repertoire_format . '">Recréer les miniatures</a>');
    		if($privilege_suppr)
                $upload_repertoire_format->setVariable('url_suppr', '<a href="upload_repertoire_format_suppr.php?id=' . $id_repertoire . '&id_rf=' . $format->id_repertoire_format . '">Supprimer</a>');
    		$upload_repertoire_format->setVariable('url_detail', 'upload_format_detail.php?id=' . $format->id_format);
    		$upload_repertoire_format->parseList('format');        		
    	}
    	$upload_repertoire_format->showBlock('liste');        	
	}
    else {
        $upload_repertoire_format->showBlock('aucun');
    }

    $upload_repertoire_format->stop();
}

?>
