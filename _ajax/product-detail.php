<?php

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if(isset($_POST['id']) && isset($_POST['lang'])) {

$product_detail = new flyLayout(REP_TPL_AJAX . 'product-detail.tpl');
$product_detail->start();

	$product_id = $_POST['id'];
	$lang = $_POST['lang'];
	list($language_code, $country_code) = split('_', $lang);
	$_SESSION['language_code'] = $language_code;
	
	if(preg_match('/\d+/', $product_id)) {
		if(modelProduct::has($product_id)) {
			$product = modelProduct::get($product_id);
			if($product != null) {
				$s_image = (!trim($product->nom_serveur) ? 'design/no-image.png' : ($product->url_repertoire . REP_PHOTOS_DETAIL_AJAX . $product->nom_serveur));
				$product_detail->setVariable('s_image', $s_image);
				$product_detail->setVariable('title', $product->title);
				$product_detail->setVariable('desc', $product->desc);
				$product_detail->showBlock('product');
			}else {
				$product_detail->showBlock('nothing');
			}
		}else {
			$product_detail->showBlock('nothing');
		}
	}else if(preg_match('/tester/', $product_id)) {
		$product_detail->showBlock('product-tester');
	}

	$product_detail->stop();
	echo json_encode(array('status' => true, 'product_detail' => "$product_detail"));

}else {
	echo json_encode(array('status' => false, 'product_detail' => ''));
}

?>