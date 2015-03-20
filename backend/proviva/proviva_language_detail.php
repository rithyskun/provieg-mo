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
$monster->addStyleSheet('tableFilter.aggregator.css');
$monster->addStyleSheet('tableFilter.css');

if(acces(__FILE__)) {
	
	$id = $_GET['id'];
    if(!isset($id) || !modelLanguage::has($id)) {
		redirect('proviva_language');
    }
    $proviva_language_detail = new flyLayout(REP_TPL . 'proviva/proviva_language_detail.tpl');
    $proviva_language_detail->start();
    $proviva_language_detail->setVariable('rep_img', REP_IMG . 'tableFilter/');
    
	$language = modelLanguage::get($id);
    $proviva_language_detail->setVariable('visible', $language->visible ? YES : NO);
    $proviva_language_detail->setVariable('language_name', $language->language_name);
	$proviva_language_detail->setVariable('language_code', $language->language_code);
    $proviva_language_detail->setVariable('country_code', $language->country_code);
    
    
    
    $infodoc = new layoutInfodoc();
    $infodoc->setObjet($language);
    $proviva_language_detail->includeLayout('infodoc', $infodoc);
    
	$proviva_language_detail->includeFile('submenu', new layoutMenubar());
	
    $proviva_language_detail->stop();
    $monster->setIncBody($proviva_language_detail);
}

$monster->display();

?>