<?php

require('config.php');

if(isset($_GET['lang'])) {
	set_priority_lang($_GET['lang']);
}else {
	set_browser_lang();
}

$page = new rootLayoutHomePage();
$page->addJavaScript('froala_editor.min.js');
$page->addStyleSheet('froala_editor.min.css');

$page->setIndex(true);
$page->setFollow(true);
$page->setTitle('Product detail');
$page->setDescription('Product detail');

$body = new flyLayout(REP_TPL . 'product-detail.tpl');
$body->start();
$body->setLang(REP_LANG . 'products-lang.php', $_SESSION['language_code']);

if(isset($_GET['id'])) {
	
	$product_id = $_GET['id'];
	if(preg_match('/\d+/', $product_id)) {
		if(modelProduct::has($product_id)) {
			$product = modelProduct::get($product_id);
			if($product != null) {
				$s_image = (!trim($product->nom_serveur) ? 'no-image.png' : ($product->url_repertoire . REP_PHOTOS_DETAIL . $product->nom_serveur));
				$body->setVariable('s_image', $s_image);
				$body->setVariable('title', $product->title);
				$body->setVariable('desc', $product->desc);
				$body->showBlock('product');
			}else {
				$body->showBlock('nothing');
			}
		}else {
			$body->showBlock('nothing');
		}
	}else if(preg_match('/tester/', $product_id)) {
		$body->showBlock('product-tester');
	}

}

$body->stop();
$page->setBody($body);
$page->display();

?>