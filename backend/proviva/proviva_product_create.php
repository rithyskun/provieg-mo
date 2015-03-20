<?php

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();
$monster->addJavaScript('floala.editor.init.js');

if(acces(__FILE__)) {
	
    if(isset($_POST['submit'])) {
	    if(isset($_POST['title'])) {
	    	
	        $visible = (isset($_POST['visible']))?1:0;
	    	$price = addslashes($_POST['price']);
	    	$title = addslashes(trim($_POST['title']));
	        $desc = addslashes(trim($_POST['desc']));
	        
	    	if(!modelProduct::exist($title, modelLanguage::DEFAULT_EN)) {
	        	$product_id = modelProduct::insert($visible, $price, $title, $desc);
	    		$monster->setMessage('The product has been created');
	    		redirect('proviva_product_detail','id=' . $product_id . '&choix=photo');
	    	} 
        	else {
    			rootLayoutMonster::setMessage('The product was existed', Message::ERROR);
    		}
	    }
    }
    
	$proviva_product_create = new flyLayout(REP_TPL . 'proviva/proviva_product_create.tpl');	
	$proviva_product_create->start();
	
	$proviva_product_create->stop();
	
    $monster->setIncBody($proviva_product_create);  
}

$monster->display();

?>