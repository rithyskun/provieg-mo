<?php

define('REP_ROOT','../');
require(REP_ROOT . 'config.php');

$monster = new rootLayoutMonster();

if(acces(__FILE__)) {
	
	$id = $_GET['id'];
	if(!isset($id) || !modelLanguage::has($id)){
		redirect('proviva_language');
	}

	if(isset($_POST['modify'])) {
		
		$visible = addslashes(isset($_POST['visible'])) ? 1 : 0;
		$language_name = addslashes($_POST['language_name']);
		$language_code = addslashes(trim($_POST['language_code']));
		$country_code = addslashes(trim($_POST['country_code']));
		//if(!modelLanguage::exist($language_name)) {
			modelLanguage::update($id, $visible, $language_name, $language_code, $country_code);
			$monster->setMessage('The language has been modified');
			redirect('proviva_language_detail', 'id=' . $id);
		/* }else {
			$monster->setMessage('The language already existed.');
			redirect('proviva_language_modify', 'id=' . $id);
		} */
	
	}
				
	$proviva_language_modify = new flyLayout(REP_TPL . 'proviva/proviva_language_modify.tpl');
	$proviva_language_modify->start();
	
	$lang = modelLanguage::get($id);
	$proviva_language_modify->setVariable('id', $lang->id);
	$proviva_language_modify->setVariable('checked',($lang->visible?'checked':''));
	$proviva_language_modify->setVariable('language_name', $lang->language_name);
	$proviva_language_modify->setVariable('language_code', $lang->language_code);
	$proviva_language_modify->setVariable('country_code', $lang->country_code);

	$proviva_language_modify->stop();
    $monster->setIncBody($proviva_language_modify);
        
}

$monster->display();
	
?>