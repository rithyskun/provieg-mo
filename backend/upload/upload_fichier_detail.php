<?php

/**
 * Permet de visionner le détail d'un fichier de ressource
 * @author Léang Stéphanie
 * @version 20070629
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
	//-- Section Vérifications -----------------------------------------------//
    if(!isset($_GET['id'])) {
        rootLayoutMonster::setMessage('You have been redirected to this page because the \nidentifier of the resource type is undefined', Message::AVERT);
		redirect('upload_fichier');
    }
    $id_fichier = $_GET['id'];
    if(!modelUploadFile::exist($id_fichier)) {
        rootLayoutMonster::setMessage('The file you ask don\'t exist', Message::ERROR);
	    redirect('upload_fichier');
    }
   
    //-- Section Affichage ---------------------------------------------------//
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
    
    $infodoc = new layoutInfodoc();
    $infodoc->setObjet($fichier);    
    $upload_fichier_detail->includeLayout('infodoc', $infodoc);
    
    $upload_fichier_detail->includeFile('menubar', new layoutMenubar());
    
    $upload_fichier_detail->stop();
    $monster->setIncBody($upload_fichier_detail);

}

$monster->display();

?>
