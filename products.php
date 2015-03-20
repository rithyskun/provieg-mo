<?php

require('config.php');

if(isset($_GET['lang'])) {
	set_priority_lang($_GET['lang']);
}else {
	set_browser_lang();
}

$page = new rootLayoutHomePage();
$page->setIndex(true);
$page->setFollow(true);
$page->setTitle('Products');
$page->setDescription('Products');

$body = new flyLayout(REP_TPL . 'products.tpl');
$body->start();
$body->setLang(REP_LANG . 'products-lang.php', $_SESSION['language_code']);
$body->setVariable('language_code', !strcmp($_SESSION['language_code'], modelLanguage::DEFAULT_EN)?'':($_SESSION['language_code'].'/'));
$_SESSION['__PAGE__'] = PAGE_EXT;

$body->includeLayout('product', new layoutProduct());

$body->stop();
$page->setBody($body);
$page->display();

?>