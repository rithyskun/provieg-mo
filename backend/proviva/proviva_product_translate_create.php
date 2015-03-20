<?php

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();
$monster->addJavaScript('floala.editor.init.js');

if(acces(__FILE__)) {
	
	if(isset($_POST['translate'])) {
		$language_code = trim($_POST['language_code']);
		$product_id = trim($_POST['product_id']);
		$product = modelProduct::get($product_id, $language_code);
	}
	
    if(isset($_POST['create'])) {
	    if(isset($_POST['title'])) {
	    	
	    	$product_id = addslashes(trim($_POST['product_id']));
	    	$language_code = addslashes(trim($_POST['language']));
	    	$title = addslashes(trim($_POST['title']));
	        $desc = addslashes(trim($_POST['desc']));
	        
	    	if(!modelProduct::exist($title, $language_code)) {
	        	modelProduct::insertNewLanguage($product_id, $language_code, $title, $desc);
	    		$monster->setMessage('The traslate of the product has been created');
	    		redirect('proviva_product_detail','id=' . $product_id . '&language_code=' . $language_code . '&choix=translate');
	    	} 
        	else {
    			rootLayoutMonster::setMessage('The traslate of the product was existed', Message::ERROR);
    			redirect('proviva_product_detail','id=' . $product_id . '&language_code=' . modelLanguage::DEFAULT_EN . '&choix=translate');
    		}
    		
	    }
    }
    
	$proviva_product_translate_create = new flyLayout(REP_TPL . 'proviva/proviva_product_translate_create.tpl');	
	$proviva_product_translate_create->start();
	
	if($product) {
		$proviva_product_translate_create->setVariable('title', $product->title);
		$proviva_product_translate_create->setVariable('desc', $product->desc);
		$proviva_product_translate_create->setVariable('product_id', $product->id);
		$list = modelLanguage::getAvaiableLanguage($product_id);
		if($list->size() > 0) {
			foreach ($list as $key => $language) {
				$proviva_product_translate_create->setVariable('selected', $language->language_code == $language_code ? 'selected' : '');
				$proviva_product_translate_create->setVariable('language_code', $language->language_code);
				$proviva_product_translate_create->setVariable('language_name', $language->language_name);
				$proviva_product_translate_create->parseList('language');
			}
		}
	}
	
	$proviva_product_translate_create->stop();
	
    $monster->setIncBody($proviva_product_translate_create);  
}

$monster->display();

?>