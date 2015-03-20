<?php

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();
$monster->addJavaScript('floala.editor.init.js');

if(acces(__FILE__)) {
	
	if(isset($_GET['product_id']) && isset($_GET['language_code'])) {
		$language_code = trim($_GET['language_code']);
		$product_id = trim($_GET['product_id']);
		$product = modelProduct::get($product_id, $language_code);
	}
	
    if(isset($_POST['modify'])) {
	    if(isset($_POST['title'])) {
	    	
	    	$product_id = addslashes(trim($_POST['product_id']));
	    	$language_code = addslashes(trim($_POST['language_code']));
	    	$title = addslashes(trim($_POST['title']));
	        $desc = addslashes(trim($_POST['desc']));
	        
	    	if(modelProduct::hasLang($product_id, $language_code)) {
	        	modelProduct::updateLanguage($product_id, $language_code, $title, $desc);
	    		$monster->setMessage('The traslate of the product has been modified');
	    		redirect('proviva_product_detail','id=' . $product_id . '&language_code=' . $language_code . '&choix=translate');
	    	} 
        	else {
    			rootLayoutMonster::setMessage('The traslate of the product deos not existed', Message::ERROR);
    			redirect('proviva_product_detail','id=' . $product_id . '&language_code=' . modelLanguage::DEFAULT_EN . '&choix=translate');
    		}
    		
	    }
    }
    
	$proviva_product_translate_modify = new flyLayout(REP_TPL . 'proviva/proviva_product_translate_modify.tpl');	
	$proviva_product_translate_modify->start();
	
	if($product) {
		$proviva_product_translate_modify->setVariable('language', $product->language_name);
		$proviva_product_translate_modify->setVariable('title', $product->title);
		$proviva_product_translate_modify->setVariable('desc', $product->desc);
		$proviva_product_translate_modify->setVariable('product_id', $product_id);
		$proviva_product_translate_modify->setVariable('language_code', $product->language_code);
	}
	
	$proviva_product_translate_modify->stop();
	
    $monster->setIncBody($proviva_product_translate_modify);
}

$monster->display();

?>