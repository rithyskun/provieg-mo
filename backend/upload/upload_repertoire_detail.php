<?php

/**
 * Permet de visionner le détail d'un type d'upload (répertoire)
 * @version 20070826
 * @author Marcadet Antoine
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    //-- Section vérifications -----------------------------------------------//
    if(!isset($_GET['id'])) {
        rootLayoutMonster::setMessage('You have been redirected to this page because the \n identifier of the directory is not defined', Message::AVERT);
		redirect('upload_repertoire');
    }
    $id_repertoire = $_GET['id'];
    
    if(!modelUploadFolder::exist($id_repertoire)) {
        rootLayoutMonster::setMessage('The details you ask don\'t exist ', Message::ERROR);
        redirect('upload_repertoire');
    }

    //-- Section affichage ---------------------------------------------------//    
    $upload_repertoire_detail = new flyLayout(REP_TPL . 'upload/upload_repertoire_detail.tpl');
    $upload_repertoire_detail->start();
    
    $repertoire = modelUploadFolder::getObject($id_repertoire);
    $upload_repertoire_detail->setVariable('nom_repertoire', $repertoire->nom_repertoire);
    $upload_repertoire_detail->setVariable('url_repertoire', $repertoire->url_repertoire);
    
    $infodoc = new layoutInfodoc();
    $infodoc->setObjet($repertoire);    
    $upload_repertoire_detail->includeLayout('infodoc', $infodoc);
    
    $upload_repertoire_detail->includeFile('menubar', new layoutMenubar()); 
          
    $upload_repertoire_detail->stop();
    $monster->setIncBody($upload_repertoire_detail);
}

$monster->display();

?>
