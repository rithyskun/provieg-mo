<?php
	
 if(acces(__FILE__)) {
 	
	$proviva_product_translate = new flyLayout(REP_TPL . 'proviva/proviva_product_translate.tpl');
	$proviva_product_translate->start();
	
	$product_id = $_GET['id'];
	
	$listTranslate = modelProduct::getTranslate($product_id);
    if($listTranslate->size() > 0) {
    	
    	$list = modelLanguage::getAvaiableLanguage($product_id);
    	if($list->size() > 0) {
    		foreach ($list as $key => $language) {
    			$proviva_product_translate->setVariable('language_code', $language->language_code);
    			$proviva_product_translate->setVariable('language_name', $language->language_name);
    			$proviva_product_translate->setVariable('product_id', $product_id);
    			$proviva_product_translate->parseList('lang');
    		}
    	}
    	
        foreach($listTranslate as $key => $translate){
        	
			$proviva_product_translate->setVariable('title', $translate->title);
    		$proviva_product_translate->setVariable('language', $translate->language_name);
    		$proviva_product_translate->setVariable('type_ligne', ($listTranslate->index()%2==1)?'impair':'pair');
    		
    		$proviva_product_translate->setVariable('url_fichier', REP_ROOT . 'proviva/proviva_product_detail.php?id=' . $translate->product_id . '&language_code=' . $translate->language_code . '&choix=translate');
    		if(acces('proviva_product_translate_delete')){
    			if($translate->language_code != modelLanguage::DEFAULT_EN) {
    				$proviva_product_translate->setVariable('delete', REP_ROOT . 'proviva/proviva_product_translate_delete.php?product_id=' . $product_id . '&language_code=' . $translate->language_code);	
					$proviva_product_translate->showBlock('blockDelete');    				
    			}
    		}
    		if(acces('proviva_product_translate_modify')){
    			$proviva_product_translate->setVariable('modify', REP_ROOT . 'proviva/proviva_product_translate_modify.php?product_id=' . $product_id . '&language_code=' . $translate->language_code);
    		}
    		if(acces('proviva_product_translate_create')){
    			if($list->size() > 0) {
    				$proviva_product_translate->setVariable('product_id', $product_id);
    				$proviva_product_translate->setVariable('language_code', modelLanguage::DEFAULT_EN);
    				$proviva_product_translate->showBlock('bTranslate');
    			}else {
    				$proviva_product_translate->hideBlock('bTranslate');
    			}
    		}
    		
    		$proviva_product_translate->parseList('translate');
    	}
    	$proviva_product_translate->showBlock('list');
    }else {
        $proviva_product_translate->showBlock('nothing');
    }
	
	$proviva_product_translate->stop();
	
}

?>