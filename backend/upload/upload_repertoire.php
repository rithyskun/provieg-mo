<?php 

/**
 * Permet de visualiser l'ensemble des types d'uploads (répertoires d'uploads)
 * @author Marcadet Antoine
 * @date 20070926
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
	$upload_repertoire = new flyLayout(REP_TPL . 'upload/upload_repertoire.tpl');
    $upload_repertoire->start();
    $upload_repertoire->setVariable('rep_img', REP_IMG . 'tableFilter/');
    $listRepertoire = modelUploadFolder::getList();
    if($listRepertoire->size() > 0) {
        foreach($listRepertoire as $key => $repertoire){
    		$upload_repertoire->setVariable('nom_repertoire', $repertoire->nom_repertoire);
    		$upload_repertoire->setVariable('url_repertoire', $repertoire->url_repertoire);
    		
    		$listTypeMime = modelUploadFolder::getListTypeMime($repertoire->id_repertoire);
    		$arrayTypeMime = Array();
    		foreach($listTypeMime as $key2 => $typeMime) {
                $arrayTypeMime[] = $typeMime->type_mime;
            }
    		$upload_repertoire->setVariable('list_type_mime', join(', ', $arrayTypeMime));
    		$upload_repertoire->setVariable('url_detail', 'upload_repertoire_detail.php?id=' . $repertoire->id_repertoire);
    		$upload_repertoire->parseList('repertoire');
    	}
    	$upload_repertoire->showBlock('liste');
    }
    else {
    	$upload_repertoire->showBlock('aucun');
    }
	$upload_repertoire->stop();
	$monster->setIncBody($upload_repertoire);
}

$monster->display();

?>	
