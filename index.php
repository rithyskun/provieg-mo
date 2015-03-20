<?php

require('config.php');

if(isset($_GET['lang'])) {
	set_priority_lang($_GET['lang']);
}else {
	set_browser_lang();
}

$page = new rootLayoutHomePage();
$page->setIndex(false);
$page->setFollow(false);
$page->setTitle(MAIL_SITENAME . ' - Home page');
$page->setDescription(MAIL_SITENAME . ' - Home page');
$page->addJavaScript('threesixty.js');
$page->addStyleSheet('threesixty.css');

$body = new flyLayout(REP_TPL . 'index.tpl');
$body->setLang(REP_LANG . 'index-lang.php', $_SESSION['language_code']);
$body->start();

$_SESSION['__PAGE__'] = PAGE_EXT;

$list = modelProduct::getList();
foreach ($list as $key => $product) {
	if($key > 3) break;
	$body->setVariable('product_id', $product->id);
	$url_image = (empty($product->nom_serveur) ? 'design/no-image.png' : ($product->url_repertoire . REP_PHOTOS_LIST . $product->nom_serveur));
	$body->setVariable('title', $product->title);
	$body->setVariable('url_image', $url_image);
	$body->parseList('sizebar-image');
}

$body->includeLayout('product', new layoutProduct());

$body->stop();
$page->setBody($body);
$page->display();

?>