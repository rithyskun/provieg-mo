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
	
	if(isset($_POST['number_order'])){
		$products = modelProduct::getList();
		foreach($products as $key => $product) {
			if(isset($_POST[$product->id])){
				$pos = $_POST[$product->id];
				$idx = $product->id;
				$order[$idx] = $pos;
			}
		}
		modelProduct::updatePosition($order);
		$monster->setMessage('The product have been order by number');
		redirect('proviva_product');
	}
	if(isset($_POST['alphabet_order'])){
		$products = modelProduct::getAlphabetOrder();
		$pos = 0;
		foreach($products as $key => $product) {
			$pos += 10;
			$idx = $product->id;
			$order[$idx] = $pos;
		}
		modelProduct::updatePosition($order);
		$monster->setMessage('The product have been order by alphabet letter');
		redirect('proviva_product');
	}
	
	$proviva_product = new flyLayout(REP_TPL . 'proviva/proviva_product.tpl');
    $proviva_product->start();
    $proviva_product->setVariable('rep_img', REP_IMG . 'tableFilter/');
    
    $products = modelProduct::getList(modelLanguage::DEFAULT_EN);
    
    if ($products->size () > 0) {
		foreach ( $products as $key => $product ) {
			if ($product->nom_serveur) {
				$mini_admin = REP_FRONT_PHOTOS. FORMAT_MINI_ADMIN . $product->nom_serveur;
				$preview_admin = REP_FRONT_PHOTOS . FORMAT_PREVIEW_ADMIN . $product->nom_serveur;
			} else {
				$mini_admin = REP_FRONT_DESIGN . 'no-image.png';
				$preview_admin = REP_FRONT_DESIGN . 'no-image.png';
			}
			$proviva_product->setVariable('mini_admin', $mini_admin);
			$proviva_product->setVariable('preview_admin', $preview_admin);
			$proviva_product->setVariable('visible', $product->visible != 0 ? YES : NO);
			$proviva_product->setVariable('price', $product->price . ' $');
			$proviva_product->setVariable('title', $product->title);
			$proviva_product->setVariable('language', $product->language_name);
			$proviva_product->setVariable('number', $product->number);
			$proviva_product->setVariable('id', $product->id);
			$proviva_product->setVariable('url_fichier', 'proviva_product_detail.php?id=' . $product->id . '&language_code=' . $product->language_code);
			
			$proviva_product->parseList('products');
		}
		unset($products);
		$proviva_product->showBlock ('list');
	} else {
		$proviva_product->showBlock ('nothing');
	}
	
	$proviva_product->stop();
	$monster->setIncBody($proviva_product);
}

$monster->display();

?>