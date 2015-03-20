<?php

/**
 * Permet de visionner le détail d'un fichier
 * @author Stephanie Léang
 * @version 20070621
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {    
    /** SECTION VERIFICATIONS********************************************/
    if(!isset($_GET['id'])) {
        rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du fichier est non défini', Message::AVERT);
		redirect('admin_fichier');
    }
    $id_fichier = $_GET['id'];
    
    if(!modelFile::exist($id_fichier)) {
        rootLayoutMonster::setMessage('Le détail que vous demandez n\'existe pas ', Message::ERROR);
        redirect('admin_fichier');
    }

    /** SECTION AFFICHAGE********************************************/       
    $admin_fichier_detail = new flyLayout(REP_TPL . 'admin/admin_fichier_detail.tpl');
    $admin_fichier_detail->start();
    
    $fichier = modelFile::getFichier($id_fichier);
    $admin_fichier_detail->setVariable('nom_fichier', $fichier->nom_fichier);
    $admin_fichier_detail->setVariable('description_fichier', affiche($fichier->description_fichier, 'complet'));
    $admin_fichier_detail->setVariable('intitule_fichier', $fichier->intitule_fichier);
    $admin_fichier_detail->setVariable('dossier_fichier', $fichier->url_dossier);
    $admin_fichier_detail->setVariable('lib_type_fichier', $fichier->lib_type_fichier);
    
    $infodoc = new layoutInfodoc();
    $infodoc->setObjet($fichier);    
    $admin_fichier_detail->includeLayout('infodoc', $infodoc);
    
    $admin_fichier_detail->includeFile('menubar', new layoutMenubar()); 
          
    $admin_fichier_detail->stop();
    $monster->setIncBody($admin_fichier_detail);
}

$monster->display();

?>