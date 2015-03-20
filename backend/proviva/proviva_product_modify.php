<?php

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();
$monster->addJavaScript('floala.editor.init.js');

if(acces(__FILE__)) {
	
	$product_id = $_GET['id'];
	$language_code = $_GET['language_code'];
	if(!isset($product_id) || !modelProduct::has($product_id)){ 
		redirect('proviva_product');
	}
    	
	if(isset($_POST['modify'])) {
		
		$product_id = addslashes($_POST['product_id']);
		$language_code = addslashes($_POST['language_code']);
		$visible = addslashes(isset($_POST['visible'])) ? 1 : 0;
		$price = addslashes($_POST['price']);
		$title = addslashes(trim($_POST['title']));
		$desc = addslashes(trim($_POST['desc']));
		modelProduct::update($product_id, $language_code, $visible, $price, $title, $desc);
		$monster->setMessage('The product has been modified');
		redirect('proviva_product_detail', 'id=' . $product_id . '&language_code=' . $language_code​ . '&choix=translate');
		
	}
				
	$proviva_product_modify = new flyLayout(REP_TPL . 'proviva/proviva_product_modify.tpl');
	$proviva_product_modify->start();
	
	$product = modelProduct::get($product_id, $language_code);
	$proviva_product_modify->setVariable('product_id', $product->id);
	$proviva_product_modify->setVariable('language_code', $product->language_code);
	$proviva_product_modify->setVariable('checked_visible',($product->visible?'checked':''));
	$proviva_product_modify->setVariable('language', $product->language_name);
	$proviva_product_modify->setVariable('price', $product->price);
	$proviva_product_modify->setVariable('title', $product->title);
	$proviva_product_modify->setVariable('desc', $product->desc);

	$proviva_product_modify->stop();
    $monster->setIncBody($proviva_product_modify);
        
}

$monster->display();
	
?>