<?php

/**
 * allow to delete lantern
 * @author sokhom,Chandy 20081217
 * @version 20080310
 */

define('REP_ROOT','../');
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
	if(!isset($id) || !modelLanguage::has($id)){
		$monster->setMessage('The language does not exist.');
		redirect('proviva_language');
	}
	
	if(isset($_POST['pass'])) {
		if(modelUser::verifPass($_POST['pass'])) {
			modelLanguage::delete($id);
			$monster->setMessage('The language has been deleted');
			redirect('proviva_language');
		}
		else {
			$monster->setMessage('Error entering your password', Message::ERROR);
			redirect('proviva_language_delete', 'id=' . $id);
		}
	}
		
	$proviva_language_detail = new flyLayout(REP_TPL . 'proviva/proviva_language_detail.tpl');
    $proviva_language_detail->start();
    $lang = modelLanguage::get($id);
    $proviva_language_detail->setVariable('visible', $lang->visible ? YES : NO);
    $proviva_language_detail->setVariable('language_name', $lang->language_name);
    $proviva_language_detail->setVariable('language_code', $lang->language_code);
    $proviva_language_detail->setVariable('country_code', $lang->country_code);
	$proviva_language_detail->stop();
	
	$proviva_product_delete = new flyLayout(REP_TPL . 'proviva/proviva_language_delete.tpl');
    $proviva_product_delete->start();	
	$proviva_product_delete->setVariable('id', $id);
	$proviva_product_delete->includeFile('detail', $proviva_language_detail);
	$proviva_product_delete->stop();
	
    $monster->setIncBody($proviva_product_delete);
    
}

$monster->display();

?>