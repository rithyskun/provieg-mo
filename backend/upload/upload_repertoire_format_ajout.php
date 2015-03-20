<?php

/**
 * Permet d'ajouter un ou plusieurs format à un répertoire
 * @author Antoine Marcadet
 * @version 20070927
 * Lorsque l'on ajoute un format de redimensionnement à un répertoire, le répertoire des miniatures est automatiquement créé
 * Lors de la suppression d'un format pour un répertoire, le dossier n'est pas supprimé   
 */

if(acces(__FILE__)) {
    $id_repertoire = $_GET['id'];
	if(isset($_POST['submit'])) { // le formulaire est posté, la page est accédée directement			
        if(isset($_POST['id_format'])) { // un élément de la liste est selectionné			     
            $directory = array();
            $tabErreur = array();
            $repertoire = modelUploadFolder::getObject($id_repertoire);
            $dir_repertoire = REP_FRONT . $repertoire->url_repertoire;
            $dir_original = $dir_repertoire . REP_ORIGINAL;
            if(!is_dir($dir_repertoire)) {
            	mkdir($dir_repertoire, 0777);
            }
            if(!is_dir($dir_original)) {
            	mkdir($dir_original, 0777);
            }
            foreach($_POST['id_format'] as $id_format) {
                $format = modelUploadFormat::getObject($id_format);
                $dir_format = $dir_repertoire . $format->url_format;
                if(!is_dir($dir_format)) { // le répertoire n'existe pas
                    if(mkdir($dir_format))
                        modelUploadFolder::linkFormat($id_repertoire, $id_format);
                    else
                        $tabErreur[] = $format->nom_format;
                }
                else { // dans le cas ou le répertoire a deja été créé puis le lien avec le format supprimé
                    modelUploadFolder::linkFormat($id_repertoire, $id_format);
                }
			}
			
			if(count($tabErreur) == 0)
                rootLayoutMonster::setMessage('The format has been added to the directory', Message::INFO);
            else 
                rootLayoutMonster::setMessage('The following directories could not be created ' . join(', ',$tabErreur), Message::ERROR);
		}
	}
	
	$upload_repertoire_format_ajout = new flyLayout(REP_TPL . 'upload/upload_repertoire_format_ajout.tpl');
	$upload_repertoire_format_ajout->start(); 
	
	$upload_repertoire_format_ajout->setVariable('ajax_file', REP_AJAX . 'upload/upload_repertoire_format_search.php');
	$upload_repertoire_format_ajout->setVariable('url_action', 'upload_repertoire_detail.php?id='.$id_repertoire.'&choix=format');
	$upload_repertoire_format_ajout->setVariable('id_repertoire', $id_repertoire);
	
	$upload_repertoire_format_ajout->stop(); 
}

?>
