<?php 

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
$monster->addJavaScript('main.js');
$monster->addStyleSheet('tableFilter.aggregator.css'); 
$monster->addStyleSheet('tableFilter.css'); 
	
if(acces(__FILE__)) {
	
	$proviva_language = new flyLayout(REP_TPL . 'proviva/proviva_language.tpl');
    $proviva_language->start();
    $proviva_language->setVariable('rep_img', REP_IMG . 'tableFilter/');
    
    $language = modelLanguage::getList(0);
    
    if ($language->size () > 0) {
		foreach ( $language as $key => $lang ) {
			$proviva_language->setVariable('language_name', $lang->language_name);
			$proviva_language->setVariable('language_code', $lang->language_code);
			$proviva_language->setVariable('country_code', $lang->country_code);
			$proviva_language->setVariable('visible', $lang->visible ? YES : NO);
			$proviva_language->setVariable('url_file', 'proviva_language_detail.php?id=' . $lang->id);
			
			$proviva_language->parseList('language');
		}
		$proviva_language->showBlock ('list');
	} else {
		$proviva_language->showBlock ('nothing');
	}
	
	$proviva_language->stop();
	$monster->setIncBody($proviva_language);
}

$monster->display();

?>