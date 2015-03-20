<?php

define('REP_ROOT', '../');
require(REP_ROOT . 'config.php');

if(isset($_POST['lang'])) {

	$lang = $_POST['lang'];
	list($language_code, $country_code) = split('_', $lang);
	$_SESSION['language_code'] = $language_code;
	
	$product_list = new flyLayout(REP_TPL_AJAX . 'product-list.tpl');
	$product_list->start();
	
	$list = modelProduct::getList();
	$sidebar_images = '';
	if($list->size() > 0) {
		$i = 1;
		foreach ($list as $key => $product) {
			$s_image = (empty($product->nom_serveur) ? 'design/no-image.png' : ($product->url_repertoire . REP_PHOTOS_LIST_AJAX . $product->nom_serveur));
			if($key <= 3) $sidebar_images .= '<a href="#' . $product->id . '"><img src="' . $s_image . '" data-toggle="tooltip" title="' . $product->title . '" class="curve-corner"></a>';
			$product_list->setVariable('style', ($i%2!=0) ? 'left' : 'right');
			$product_list->setVariable('s_image', $s_image);
			$product_list->setVariable('title', $product->title);
			$product_list->setVariable('desc', trim_text($product->desc, 250));
			$product_list->setVariable('product_id', $product->id);
			$product_list->setVariable('url_product', getURL($product->title, $product->id));
			$product_list->parseList('list');
			$i++;
		}
		$product_list->showBlock('product');
	}else {
		$product_list->showBlock('nothing');
	}
	
	$product_list->stop();
	echo json_encode(array('status' => true, 'product_list' => "$product_list", 'sidebar_images' => "$sidebar_images"));
	
}else {
	echo json_encode(array('status' => false, 'product_list' => '', 'sidebar_images' => ''));
}