<?php

/**
 * Permet de visionner tous les types MIME d'un répertoire
 * @author Antoine Marcadet
 * @date 20070927
 */

/** SECTION AFFICHAGE
**********************************************************************************************/
if(acces(__FILE__)) {
    $id_repertoire = $_GET['id'];
	$upload_repertoire_mime = new flyLayout(REP_TPL . 'upload/upload_repertoire_mime.tpl');
    $upload_repertoire_mime->start();
   	
	if(acces('upload_repertoire_mime_ajout')) {
		include('upload_repertoire_mime_ajout.php');
		$upload_repertoire_mime->includeFile('include_repertoire_mime_ajout', $upload_repertoire_mime_ajout);
	}
	
	$listTypeMime = modelUploadFolder::getListTypeMime($id_repertoire);
	if($listTypeMime->size() > 0) {
    	$privilege_suppr = acces('upload_repertoire_format_suppr');
    	foreach($listTypeMime as $key => $typeMime) {
    		$upload_repertoire_mime->setVariable('type_ligne', ($listTypeMime->index()%2==1)?'impair':'pair');
    		$upload_repertoire_mime->setVariable('type_fichier', $typeMime->type_fichier);
    		$upload_repertoire_mime->setVariable('type_mime', $typeMime->type_mime);
    		if($privilege_suppr)
                $upload_repertoire_mime->setVariable('url_suppr', '<a href="upload_repertoire_mime_suppr.php?id=' . $id_repertoire . '&id_rm=' . $typeMime->id_repertoire_mime . '">Supprimer</a>');
    		$upload_repertoire_mime->parseList('mime');        		
    	}
    	$upload_repertoire_mime->showBlock('liste');        	
	}
    else {
        $upload_repertoire_mime->showBlock('aucun');
    }

    $upload_repertoire_mime->stop();
}

?>
