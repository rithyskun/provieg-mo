<?php 

/**
 * Permet de visualiser l'ensemble des formats de redimensionnement
 * @author Marcadet Antoine
 * @date 20070927
 */
 
define('REP_ROOT', '../'); 
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

$monster->addJavaScript('tableFilter/jquery.cookies-packed.js');
$monster->addJavaScript('tableFilter/prototypes-packed.js'); 
$monster->addJavaScript('tableFilter/json-packed.js');
$monster->addJavaScript('tableFilter/jquery.truemouseout-packed.js');
$monster->addJavaScript('tableFilter/daemachTools-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.aggregator-packed.js');
$monster->addJavaScript('tableFilter/jquery.tableFilter.columnStyle-packed.js');

$monster->addStyleSheet('tableFilter.aggregator.css'); 
$monster->addStyleSheet('tableFilter.css'); 
	
if(acces(__FILE__)) {
	$upload_format = new flyLayout(REP_TPL . 'upload/upload_format.tpl');
    $upload_format->start();
    $upload_format->setVariable('rep_img', REP_IMG . 'tableFilter/');
    $listFormat = modelUploadFormat::getList();
    if($listFormat->size() > 0) {
        foreach($listFormat as $key => $format){
    		$upload_format->setVariable('nom_format', $format->nom_format);
    		$upload_format->setVariable('url_format', $format->url_format);
    		$upload_format->setVariable('dimension', $format->largeur.'x'.$format->hauteur);
    		$upload_format->setVariable('url_detail', 'upload_format_detail.php?id=' . $format->id_format);
    		$upload_format->parseList('format');
    	}
    	$upload_format->showBlock('liste');
    }
    else {
    	$upload_format->showBlock('aucun');
    }
	$upload_format->stop();
	$monster->setIncBody($upload_format);
}

$monster->display();

?>	
