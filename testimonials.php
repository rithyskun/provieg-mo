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
$page->setTitle('Testimonials');
$page->setDescription('Testimonials');

$body = new flyLayout(REP_TPL . 'testimonials.tpl');
$body->start();
$body->setLang(REP_LANG . 'testimonials-lang.php', $_SESSION['language_code']);
$_SESSION['__PAGE__'] = PAGE_EXT;
$body->stop();
$page->setBody($body);
$page->display();

?>