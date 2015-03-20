<?php

/**
 * Permet de supprimer un fichier uploadé
 * @author Stéphanie Léang
 * @date 20070702
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
	
    if(!isset($_GET['id'])) {
	 	rootLayoutMonster::setMessage('You have been redirected to this page because the \nidentifier of the resource type is undefined', Message::AVERT);
		redirect('upload_fichier');
	}
	
    $id_fichier = $_GET['id'];
	/** SECTION TRAITEMENTS ***********************************************************************************************/
	if(modelUploadFile::exist($id_fichier)) {
		if(isset($_POST['pass'])) {
			if(modelUser::verifPass($_POST['pass'])) {	// le mot de passe est correct
                $fichier = modelUploadFile::getObject($id_fichier);
                $path = pathinfo($fichier->nom_initial);
                $key_unique = time() . rand(10000000, 99999999);
                $chemin = REP_FRONT . $fichier->url_repertoire;
                rename($chemin.$fichier->nom_serveur, $chemin.REP_ARCHIVE.$key_unique.'.'.$path['extension']);                
                modelUploadFile::delete($id_fichier);   				
                rootLayoutMonster::setMessage('The resource file has been deleted');
    			redirect('upload_fichier');
			}
			else {				
				rootLayoutMonster::setMessage('Error entering your password', Message::ERROR);
				redirect('upload_fichier_suppr', 'id=' . $id_fichier);
			}
		}
	}
	else {
		rootLayoutMonster::setMessage('The type of resource you ask don\'t exist', Message::AVERT);
		redirect('upload_type');
	}
	
    /** SECTION AFFICHAGE ***********************************************************************************************/
    $upload_fichier_detail = new flyLayout(REP_TPL . 'upload/upload_fichier_detail.tpl');
    $upload_fichier_detail->start();
    
    $fichier = modelUploadFile::getImageDetail($id_fichier);
    $upload_fichier_detail->setVariable('nom_initial', $fichier->nom_initial);
    $upload_fichier_detail->setVariable('nom_serveur', $fichier->nom_serveur);
    $upload_fichier_detail->setVariable('nom_telechargement', $fichier->nom_telechargement);
    $upload_fichier_detail->setVariable('taille_fichier', (round($fichier->taille_fichier/1000)==0)?'1':round($fichier->taille_fichier/1000));
    $upload_fichier_detail->setVariable('url_repertoire', $fichier->url_repertoire);
    $upload_fichier_detail->setVariable('type_mime', $fichier->type_mime);
    $upload_fichier_detail->setVariable('balise_alt', ($fichier->balise_alt != '')?$fichier->balise_alt:'Unknown');
    
    $upload_fichier_detail->setVariable('titre', ($fichier->titre)?$fichier->titre:'(No title)');
    $upload_fichier_detail->setVariable('description', ($fichier->description)?$fichier->description:'(No description)');
    /* $upload_fichier_detail->setVariable('etat_fichier', $fichier->etat_fichier); */
    
    $upload_fichier_detail->stop();  
    
    $upload_fichier_suppr = new flyLayout(REP_TPL . 'upload/upload_fichier_suppr.tpl');
    $upload_fichier_suppr->start();		
	$upload_fichier_suppr->setVariable('id_fichier', $id_fichier);		
	$upload_fichier_suppr->includeFile('detail', $upload_fichier_detail);
	$upload_fichier_suppr->stop();
    	    
    $monster->setIncBody($upload_fichier_suppr);
}

$monster->display();

?>
