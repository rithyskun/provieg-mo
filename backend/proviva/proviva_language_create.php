<?php

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
	
    if(isset($_POST['create'])) {
	    if(isset($_POST['language_name'])) {
	    	
	        $visible = (isset($_POST['visible']))?1:0;
	    	$language_name = addslashes(trim($_POST['language_name']));
	    	$language_code = addslashes(strtolower(trim($_POST['language_code'])));
	        $country_code = addslashes(strtoupper(trim($_POST['country_code'])));
	        
	    	if(!modelLanguage::exist($language_name)) {
	        	$id = modelLanguage::insert($visible, $language_name, $language_code, $country_code);
	        	$filename = 'Messages_' . $language_code . '_' . $country_code . '.properties';
	        	$source = REP_FRONT . 'bundle/Messages_en_US.properties';
	        	$dest = REP_FRONT . 'bundle/' . $filename;
	        	if(!file_exists($dest)) {
	        		if(!copy($source, $dest)) {
	        			$msg = 'The ' . $filename . ' can not be generated.';
	        		}else {
	        			$msg = 'The ' . $filename . ' was generated.';
	        		}
	        	}
	    		$monster->setMessage('The language has been created.<br>' . $msg);
	    		redirect('proviva_language_detail','id=' . $id);
	    	} 
        	else {
    			rootLayoutMonster::setMessage('The language was existed', Message::ERROR);
    		}
	    }
    }
    
	$proviva_language_create = new flyLayout(REP_TPL . 'proviva/proviva_language_create.tpl');
	$proviva_language_create->start();
	
	$proviva_language_create->stop();
	
    $monster->setIncBody($proviva_language_create);
}

$monster->display();

?>