<?php

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
	
	$product_id = $_GET['id'];
	if(!isset($product_id) || !modelProduct::has($product_id)){
		redirect('proviva_product');
		$monster->setMessage('The product does not exist.');
	}
	
	if(isset($_POST['pass'])) {
		if(modelUser::verifPass($_POST['pass'])) {
			$listPhotos = modelProduct::getListPhoto($product_id);
			if($listPhotos->size()>0){
				foreach($listPhotos as $key => $photo){
					modelProduct::unlinkPhoto($product_id, $photo->id_fichier);
				}
			}
			modelProduct::delete($product_id);
			$monster->setMessage('The product has been deleted');
			redirect('proviva_product');
		}
		else {
			$monster->setMessage('Error entering your password', Message::ERROR);
			redirect('proviva_product_delete', 'id=' . $product_id);
		}
	}
		
	$proviva_product_detail = new flyLayout(REP_TPL . 'proviva/proviva_product_detail.tpl');
    $proviva_product_detail->start();
    $product = modelProduct::get($product_id);
    $proviva_product_detail->setVariable('visible', $product->visible ? YES : NO);
    $proviva_product_detail->setVariable('price', $product->price . ' $');
    $proviva_product_detail->setVariable('title', $product->desc);
    $proviva_product_detail->setVariable('desc', $product->desc);
	$proviva_product_detail->stop();
	
	$proviva_product_delete = new flyLayout(REP_TPL . 'proviva/proviva_product_delete.tpl');
    $proviva_product_delete->start();	
	$proviva_product_delete->setVariable('product_id', $product_id);
	$proviva_product_delete->includeFile('detail', $proviva_product_detail);
	$proviva_product_delete->stop();
	
    $monster->setIncBody($proviva_product_delete);
    
}

$monster->display();

?>