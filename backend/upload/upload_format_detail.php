<?php

/**
 * Permet de visionner le détail d'un format d'images
 * @version 20070827
 * @author Marcadet Antoine
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
    /** SECTION VERIFICATIONS
    ***********************************************************************************************/
    if(!isset($_GET['id'])) {
        rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du format est non défini', Message::AVERT);
		redirect('upload_format');
    }
    $id_format = $_GET['id'];
    
    if(!modelUploadFormat::exist($id_format)) {
        rootLayoutMonster::setMessage('Le détail que vous demandez n\'existe pas ', Message::ERROR);
        redirect('upload_format');
    }

    /** SECTION AFFICHAGE
    ***********************************************************************************************/       
    $upload_format_detail = new flyLayout(REP_TPL . 'upload/upload_format_detail.tpl');
    $upload_format_detail->start();
    
    $format = modelUploadFormat::getObject($id_format);
    $upload_format_detail->setVariable('nom_format', $format->nom_format);
    $upload_format_detail->setVariable('url_format', $format->url_format);
    $upload_format_detail->setVariable('largeur', $format->largeur);
    $upload_format_detail->setVariable('hauteur', $format->hauteur);
    
    $infodoc = new layoutInfodoc();
    $infodoc->setObjet($format);    
    $upload_format_detail->includeLayout('infodoc', $infodoc);
    
    //$upload_format_detail->includeFile('menubar', new layoutMenubar()); 
          
    $upload_format_detail->stop();
    $monster->setIncBody($upload_format_detail);
}

$monster->display();

?>
