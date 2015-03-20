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
$monster->addJavaScript('preview_image.js');
$monster->addStyleSheet('tableFilter.aggregator.css');
$monster->addStyleSheet('tableFilter.css');

if(acces(__FILE__)) {
	
	$product_id = $_GET['id'];
	$language_code = $_GET['language_code'];
    if(!isset($product_id) || !modelProduct::has($product_id)) {
		redirect('proviva_product');
    }
    $proviva_product_detail = new flyLayout(REP_TPL . 'proviva/proviva_product_detail.tpl');
    $proviva_product_detail->start();
    $proviva_product_detail->setVariable('rep_img', REP_IMG . 'tableFilter/');
    
	$product = modelProduct::get($product_id, $language_code);
    $proviva_product_detail->setVariable('language', $product->language_name);
    $proviva_product_detail->setVariable('visible', $product->visible ? YES : NO);
	$proviva_product_detail->setVariable('price', $product->price . ' $');
    $proviva_product_detail->setVariable('title', $product->title);
	$proviva_product_detail->setVariable('desc', $product->desc);
    
    $infodoc = new layoutInfodoc();
    $infodoc->setObjet($product);
    $proviva_product_detail->includeLayout('infodoc', $infodoc);
    
	$proviva_product_detail->includeFile('submenu', new layoutMenubar());
	
    $proviva_product_detail->stop();
    $monster->setIncBody($proviva_product_detail);
}

$monster->display();

?>