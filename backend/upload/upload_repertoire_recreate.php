<?php

/**
 * Page de recréation des miniatures d'un répertoire
 * @author Antoine Marcadet
 * @version 20080116
 */

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();
$monster->addJavaScript('upload_repertoire_recreate.js');

if(acces(__FILE__)) {
    //-- Section vérifications -----------------------------------------------//
    if(!isset($_GET['id'])) {
        rootLayoutMonster::setMessage('Vous avez été redirigé sur cette page car l\'identifiant du répertoire est non défini', Message::AVERT);
		redirect('upload_repertoire');
    }
    $id_repertoire = $_GET['id'];

    if(!modelUploadFolder::exist($id_repertoire)) {
        rootLayoutMonster::setMessage('Le détail que vous demandez n\'existe pas ', Message::ERROR);
        redirect('upload_repertoire');
    }
    
    //-- Section affichage ---------------------------------------------------//
	$upload_repertoire_recreate = new flyLayout(REP_TPL.'upload/upload_repertoire_recreate.tpl');
	$upload_repertoire_recreate->start();
	
	$listFormat = modelUploadFolder::getListFormat($id_repertoire);
	if($listFormat->size() > 0) {
    	foreach($listFormat as $key => $format) {
    		$upload_repertoire_recreate->setVariable('i_format', $listFormat->index());
    		$upload_repertoire_recreate->setVariable('id_format', $format->id_format);
    		$upload_repertoire_recreate->setVariable('nom_format', $format->nom_format);
    		$upload_repertoire_recreate->setVariable('largeur', $format->largeur);
    		$upload_repertoire_recreate->setVariable('hauteur', $format->hauteur);
    		$upload_repertoire_recreate->parseList('list_format');
    	}
    	$upload_repertoire_recreate->setVariable('nb_format', $listFormat->size());
	}
	
	$repertoire = modelUploadFolder::getObject($id_repertoire);
	$url_repertoire = REP_FRONT.$repertoire->url_repertoire;
	$i = 0;
    $rep = opendir($url_repertoire);
    while($filename = readdir($rep)) {
        // solution brutale pour déterminer si il s'agit d'une image et la redimensionner
    	if(@getimagesize($url_repertoire.$filename)) {
		    $upload_repertoire_recreate->setVariable('nom_fichier', $filename);
		    $upload_repertoire_recreate->setVariable('i_fichier', $i);
		    $upload_repertoire_recreate->parseList('input_hidden');
			$i++;
		}
    }
    closedir($rep);
    //echo($i);
    $upload_repertoire_recreate->setVariable('nb_fichier', $i);
	$upload_repertoire_recreate->setVariable('id_repertoire', $repertoire->id_repertoire);
    $upload_repertoire_recreate->setVariable('REP_AJAX', REP_AJAX.'upload/');
	
	$upload_repertoire_recreate->stop();
	$monster->setIncBody($upload_repertoire_recreate);

}

$monster->display();

?>
