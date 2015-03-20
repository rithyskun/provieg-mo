<?php

/**
 * Permet de modifier un fichier de ressource
 * @author Léang Stéphanie
 * @date 20070629
 */

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) { 
	//-- Section Vérifications -----------------------------------------------//
    if(!isset($_GET['id'])) {
	    rootLayoutMonster::setMessage('You have been redirected to this page because \n file identifier is undefined', Message::AVERT);
		redirect('upload_fichier');
	}
    $id_fichier = $_GET['id'];
    if(!modelUploadFile::exist($id_fichier)) {
        rootLayoutMonster::setMessage('The file you ask don\'t exist', Message::ERROR);
	    redirect('upload_fichier');
    }
    
	//-- Section Traitements -------------------------------------------------//
	if(isset($_POST['submit'])) {
		modelUploadFile::updateTitreDescription($id_fichier, $_POST['titre'],$_POST['balise_alt'], $_POST['description']);
	    rootLayoutMonster::setMessage('The changes have been saved', Message::INFO);
	    redirect('upload_fichier_detail', 'id='.$id_fichier);
	}


	//-- Section Affichage ---------------------------------------------------//
	$upload_fichier_modif = new flyLayout(REP_TPL . 'upload/upload_fichier_modif.tpl');
	$upload_fichier_modif->start();
	
	$fichier = modelUploadFile::getObject($id_fichier);
	$upload_fichier_modif->setVariable('titre', $fichier->titre);
	$upload_fichier_modif->setVariable('balise_alt', $fichier->balise_alt);
	$upload_fichier_modif->setVariable('description', $fichier->description);
	
	
	$upload_fichier_modif->stop();
    $monster->setIncBody($upload_fichier_modif);  
}

$monster->display();

?>
