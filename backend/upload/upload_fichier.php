<?php 

/**
 * Permet de visualiser l'ensemble des types de fichiers ressources
 * @author Marcadet Antoine
 * @date 20070628
 */
 
define('REP_ROOT', '../'); 
require(REP_ROOT . 'config.php');
$format = Annuaire::lookup(KEY_FORMAT);

$monster = new rootLayoutMonster();

$monster->addJavaScript('tableFilter/jquery.cookies-packed.js');
$monster->addJavaScript('tableFilter/prototypes-packed.js'); 
$monster->addJavaScript('tableFilter/json-packed.js');
$monster->addJavaScript('tableFilter/jquery.truemouseout-packed.js');
$monster->addJavaScript('tableFilter/daemachTools-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.aggregator-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.columnStyle-packed.js');
$monster->addJavaScript('main.js');

$monster->addStyleSheet('tableFilter.aggregator.css'); 
$monster->addStyleSheet('tableFilter.css'); 

if(acces(__FILE__)) {		
	$upload_fichier = new flyLayout(REP_TPL . 'upload/upload_fichier.tpl');
    $upload_fichier->start();
    $upload_fichier->setVariable('rep_img', REP_IMG . 'tableFilter/');
    $listUpload = modelUploadFile::getList();
    if($listUpload->size() > 0) {
    	foreach($listUpload as $key => $fichier) {
			$upload_fichier->setVariable('min_admin', REP_FRONT.$fichier->url_repertoire.FORMAT_MINI_ADMIN.$fichier->nom_serveur);
			$upload_fichier->setVariable('preview_admin', REP_FRONT.$fichier->url_repertoire.FORMAT_PREVIEW_ADMIN.$fichier->nom_serveur);
    		$upload_fichier->setVariable('date_upload', $format->out($fichier->date_creation, Format::DATE_TIME));
    		$upload_fichier->setVariable('login_createur', $fichier->login_createur);
    		$upload_fichier->setVariable('nom_initial', $fichier->nom_initial);
    		$upload_fichier->setVariable('nom_serveur', $fichier->nom_serveur);
    		$upload_fichier->setVariable('url_repertoire', $fichier->url_repertoire);
    		$upload_fichier->setVariable('type_mime', $fichier->type_mime);
    		$upload_fichier->setVariable('url_fichier', 'upload_fichier_detail.php?id=' . $fichier->id_fichier);
    		$upload_fichier->parseList('fichier');
    	}
    	$upload_fichier->showBlock('liste');
    }
    else {
    	$upload_fichier->showBlock('aucun');
    }
	
	$upload_fichier->stop();
	$monster->setIncBody($upload_fichier);
}

$monster->display();

?>