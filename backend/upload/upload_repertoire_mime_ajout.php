<?php

/**
 * Permet d'ajouter un ou plusieurs types MIME à un répertoire
 * @author Antoine Marcadet
 * @version 20070927
 */

if(acces(__FILE__)) {
    $id_repertoire = $_GET['id'];
	if(isset($_POST['submit'])) { // le formulaire est posté, la page est accédée directement			
        if(isset($_POST['id_type_mime'])) { // un élément de la liste est selectionné			     
            foreach($_POST['id_type_mime'] as $id_type_mime) {		
				modelUploadFolder::linkTypeMime($id_repertoire, $id_type_mime);
			}
			rootLayoutMonster::setMessage('Le type MIME a bien été ajouté au répertoire');
		}
	}
	
	$upload_repertoire_mime_ajout = new flyLayout(REP_TPL . 'upload/upload_repertoire_mime_ajout.tpl');
	$upload_repertoire_mime_ajout->start(); 
	
	$upload_repertoire_mime_ajout->setVariable('ajax_file', REP_AJAX . 'upload/upload_repertoire_mime_search.php');
	$upload_repertoire_mime_ajout->setVariable('url_action', 'upload_repertoire_detail.php?id='.$id_repertoire.'&choix=mime');
	$upload_repertoire_mime_ajout->setVariable('id_repertoire', $id_repertoire);
	
	$upload_repertoire_mime_ajout->stop(); 
}

?>
